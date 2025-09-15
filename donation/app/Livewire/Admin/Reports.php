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

        // Plan Distribution
        $this->planDistribution = Plan::withCount('users')
            ->withSum('donations', 'amount')
            ->get();

        // Member Statistics
        $this->totalMembers = User::where('role', 'user')->count();
        $this->activePlans = DB::table('plan_users')->where('status', 'active')->count();
        $this->expiredPlans = DB::table('plan_users')->where('status', 'expired')->count();
        $totalPlanUsers = $this->activePlans + $this->expiredPlans;
        $this->renewalRate = $totalPlanUsers > 0 ? round(($this->activePlans / $totalPlanUsers) * 100) : 0;

        // Top Contributors
        $this->topContributors = User::withSum('donations', 'amount')
            ->orderBy('donations_sum_amount', 'desc')
            ->limit(3)
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