<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use App\Models\User;
use App\Models\Donation;
use App\Models\Expense;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.admin')]

class Dashboard extends Component
{
    public $users;
    public $plans;
    public $recentDonations;
    public $recentExpenses;

    public $name;
    public $email;
    public $role;
    public $plan_id;

    public $userId;
    public $showModal = false;

    public $totalUsers;
    public $activePlans;
    public $expiredPlans;
    public $revenue;
    public $totalDonations;
    public $totalExpenses;
    public $netBalance;

    public $outstandingPayments;
    public $currentMonthTransactions;
    public $monthlyPaymentStatuses = [];
    
    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        // Load users with their plans and plan_user relationship
        // We're explicitly specifying that we need pivot data to avoid any issues
        $this->users = User::with([
            'plans' => function($query) {
                $query->withPivot(['start_date', 'end_date', 'total_required', 'amount_paid', 'amount_remaining', 'status']);
            },
            'donations' => function($query) {
                $query->whereMonth('donation_date', Carbon::now()->month)
                      ->whereYear('donation_date', Carbon::now()->year);
            }
        ])->get();
        
        $this->plans = Plan::all();

        $this->totalUsers = $this->users->count();
        $this->activePlans = DB::table('plan_users')->where('status', 'active')->count();
        $this->expiredPlans = DB::table('plan_users')->where('status', 'expired')->count();
        $this->revenue = DB::table('plan_users')->sum('amount_paid');
        
        // Calculate donation metrics
        $this->totalDonations = DB::table('donations')->sum('amount');
        $this->recentDonations = DB::table('donations')
            ->join('users', 'donations.user_id', '=', 'users.id')
            ->select('donations.*', 'users.name')
            ->orderBy('donations.created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Calculate expense metrics
        $this->totalExpenses = DB::table('expenses')->sum('amount');
        $this->recentExpenses = DB::table('expenses')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Calculate net balance (donations - expenses)
        $this->netBalance = $this->totalDonations - $this->totalExpenses;
        
        // Calculate outstanding payments
        $this->outstandingPayments = DB::table('plan_users')
            ->where('status', 'active')
            ->sum('amount_remaining');
            
        // Get current month's transactions
        $now = Carbon::now();
        $this->currentMonthTransactions = Donation::whereMonth('donation_date', $now->month)
            ->whereYear('donation_date', $now->year)
            ->with(['user', 'plan'])
            ->orderBy('donation_date', 'desc')
            ->get();
            
        // Calculate monthly payment status for each active plan user
        $planUsers = \App\Models\PlanUser::with(['user', 'plan'])
            ->where('status', 'active')
            ->get();
            
        foreach ($planUsers as $planUser) {
            if ($planUser->user && $planUser->plan) {
                $this->monthlyPaymentStatuses[$planUser->user_id] = [
                    'user_name' => $planUser->user->name,
                    'plan_name' => $planUser->plan->name,
                    'monthly_payment' => $planUser->monthly_payment,
                    'current_month_payment' => $planUser->current_month_payment,
                    'outstanding_amount' => $planUser->outstanding_amount,
                    'payment_progress' => $planUser->payment_progress,
                    'status' => $planUser->monthly_payment_status
                ];
            }
        }
    }

   

    public function editUser($id)
    {
        $user = User::with('plans')->findOrFail($id);
        $this->userId = $user->id;
        $this->name   = $user->name;
        $this->email  = $user->email;
        $this->role   = $user->role ?? 'user';
        $this->plan_id = $user->plans && $user->plans->isNotEmpty() ? $user->plans->first()?->id : null;
    }

    
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
