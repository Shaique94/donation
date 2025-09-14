<?php

namespace App\Livewire\Admin\Users;

use App\Models\Plan;
use App\Models\PlanUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.admin')]

class Add extends Component
{
    public $name;
    public $email;
    public $password;
    public $plan_id;
    public $role;

    protected $rules = [
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'plan_id'  => 'nullable|exists:plans,id',
        'role'     => 'required|in:admin,member,user',
    ];

    public function createUser()
    {
        $this->validate();

        $user = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'role'     => $this->role,
        ]);
        Log::info($user);

        // Attach plan with extra pivot data
        if ($this->plan_id) {
            $plan = Plan::find($this->plan_id);

            
            $planUser = PlanUser::create([
                'user_id'        => $user->id,
                'plan_id'        => $this->plan_id,
                'start_date'     => now(),
                // 'end_date'       => now()->addDays(30),
                'total_required' => $plan->amount_required ?? 0,
                'amount_paid'    => 0,
                'status'         => 'active',   
            ]);
        }


        session()->flash('success', 'User created successfully with plan!');

        $this->reset(['name', 'email', 'password', 'plan_id', 'role']);
    }
    public function render()
    {
        return view('livewire.admin.users.add', [
            'plans' => Plan::all(),
        ]);
    }
}
