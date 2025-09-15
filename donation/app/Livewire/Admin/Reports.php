<?php

namespace App\Livewire\Admin;

use App\Models\Donation;
use App\Models\Expense;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layout.admin')]
class Reports extends Component
{
    public $totalDonations;
    public $totalExpenses;
    public $netBalance;
    public $monthlyDonationTrends;
    public $expenseByCategory;
    public $planDistribution;
    public $totalMembers;
    public $activePlans;
    public $expiredPlans;
    public $renewalRate;
    public $topContributors;
    public $recentTransactions;

    public function mount()
    {
        $this->loadReportData();
    }

    public function loadReportData()
    {
        // Financial Highlights
        $this->totalDonations = Donation::sum('amount');
        $this->totalExpenses = Expense::sum('amount');
        $this->netBalance = $this->totalDonations - $this->totalExpenses;

        // Monthly Donation Trends (for a chart)
        $this->monthlyDonationTrends = Donation::select(
                DB::raw('SUM(amount) as total'),
                DB::raw("DATE_FORMAT(donation_date, '%b') as month")
            )
            ->whereYear('donation_date', date('Y'))
            ->groupBy('month')
            ->orderBy(DB::raw("MONTH(donation_date)"))
            ->get()
            ->pluck('total', 'month');

        // Expense by Category (for a chart)
        $this->expenseByCategory = Expense::select('category', DB::raw('SUM(amount) as total'))
            ->groupBy('category')
            ->get()
            ->pluck('total', 'category');

        // Plan Distribution with payment progress and outstanding amounts
        $this->planDistribution = Plan::withCount('users')
            ->withSum('donations', 'amount')
            ->get()
            ->map(function($plan) {
            // Calculate total required, paid amount, and outstanding for each plan
            $planUsers = \App\Models\PlanUser::where('plan_id', $plan->id)
                ->where('status', 'active')
                ->get();
                
            $totalRequired = $planUsers->sum('total_required');
            $paidAmount = $planUsers->sum('amount_paid');
            $outstandingAmount = $planUsers->sum('amount_remaining');
            
            // Calculate payment progress percentage
            $paymentProgress = $totalRequired > 0 ? min(100, round(($paidAmount / $totalRequired) * 100)) : 0;
            
            // Calculate this month's metrics
            $now = \Carbon\Carbon::now();
            $thisMonthDonations = Donation::where('plan_id', $plan->id)
                ->whereYear('donation_date', $now->year)
                ->whereMonth('donation_date', $now->month)
                ->sum('amount');
            
            // Calculate expected monthly payment (total required / 12 months)
            $expectedMonthlyPayment = $totalRequired / 12;
            $thisMonthProgress = $expectedMonthlyPayment > 0 
                ? min(100, round(($thisMonthDonations / $expectedMonthlyPayment) * 100))
                : 0;
            
            // Add the computed values to the plan object
            $plan->total_required = $totalRequired;
            $plan->paid_amount = $paidAmount;
            $plan->outstanding_amount = $outstandingAmount;
            $plan->payment_progress = $paymentProgress;
            $plan->this_month_amount = $thisMonthDonations;
            $plan->this_month_progress = $thisMonthProgress;
            
            return $plan;
        });

        // Member Statistics
        $this->totalMembers = User::where('role', 'user')->count();
        $this->activePlans = DB::table('plan_users')->where('status', 'active')->count();
        $this->expiredPlans = DB::table('plan_users')->where('status', 'expired')->count();
        $totalPlanUsers = $this->activePlans + $this->expiredPlans;
        $this->renewalRate = $totalPlanUsers > 0 ? round(($this->activePlans / $totalPlanUsers) * 100) : 0;

        // Top Contributors with plan payment progress
        $this->topContributors = User::withSum('donations', 'amount')
            ->with(['plans' => function($query) {
                $query->withPivot(['total_required', 'amount_paid', 'amount_remaining', 'status', 'start_date', 'end_date']);
            }])
            ->orderBy('donations_sum_amount', 'desc')
            ->limit(5)
            ->get();

        // Recent Transactions
        $donations = Donation::with('user')->latest()->limit(3)->get()->map(function ($item) {
            $item->type = 'Income';
            $item->description = 'Donation from ' . $item->user->name;
            $item->transaction_date = $item->donation_date;
            return $item;
        });

        $expenses = Expense::latest()->limit(3)->get()->map(function ($item) {
            $item->type = 'Expense';
            $item->transaction_date = $item->date;
            return $item;
        });

        $this->recentTransactions = $donations->concat($expenses)->sortByDesc('transaction_date')->take(5);
    }

    public function render()
    {
        return view('livewire.admin.reports');
    }
}