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

    public function mount()
    {
        $this->loadDashboardData();
    }

    public function loadDashboardData()
    {
        $this->users = User::with(['plans'])->get();
        $this->plans = Plan::all();

        $this->totalUsers   = $this->users->count();
        $this->activePlans  = DB::table('plan_users')->where('status', 'active')->count();
        $this->expiredPlans = DB::table('plan_users')->where('status', 'expired')->count();
        $this->revenue      = DB::table('plan_users')->sum('amount_paid');
        
        // Calculate donation metrics
        // Assuming Donation model exists or will be created
        $this->totalDonations = DB::table('donations')->sum('amount');
        $this->recentDonations = DB::table('donations')
            ->join('users', 'donations.user_id', '=', 'users.id')
            ->select('donations.*', 'users.name')
            ->orderBy('donations.created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Calculate expense metrics
        // Assuming Expense model exists or will be created
        $this->totalExpenses = DB::table('expenses')->sum('amount');
        $this->recentExpenses = DB::table('expenses')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Calculate net balance (donations - expenses)
        $this->netBalance = $this->totalDonations - $this->totalExpenses;
    }

   

    public function editUser($id)
    {
        $user = User::with('plans')->findOrFail($id);
        $this->userId = $user->id;
        $this->name   = $user->name;
        $this->email  = $user->email;
        $this->role   = $user->role;
        $this->plan_id = $user->plans->first()?->id ?? null;

    }

    
    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
