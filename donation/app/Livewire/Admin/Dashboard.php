<?php

namespace App\Livewire\Admin;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.admin')]

class Dashboard extends Component
{
    public $users;
    public $plans;

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
