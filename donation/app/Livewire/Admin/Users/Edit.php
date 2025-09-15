<?php

namespace App\Livewire\Admin\Users;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.admin')]

class Edit extends Component
{
    public $name;
    public $email;
    public $plan_id;
    public $role;
    public $plans = [];
    public $activePlan;
    public $userId;

    protected $rules = [
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'plan_id'  => 'nullable|exists:plans,id',
        'role'     => 'required|in:admin,member,user',
    ];

    public function mount(User $user){
        $this->userId = $user->id;
        // dd($userId);
        $this->name = $user->name;
        $this->email = $user->email;
        // $this->password = $user->password;
        // $this->plan_id = $user->plan_id;
        $this->role = $user->role;

        // Get the first assigned plan
        $this->activePlan = $user->plans->firstWhere('pivot.status', 'active');
        $this->plan_id = $this->activePlan?->id;
    // Load all plans for the dropdown
    $this->plans = Plan::all();
    }

    public function updateUser()
    {
        $this->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email',
            'role'  => 'required|string',
            'plan_id' => 'nullable|exists:plans,id',
        ]);

        DB::transaction(function () {
            $user = User::findOrFail($this->userId);

            // Update user basic info
            $user->update([
                'name'  => $this->name,
                'email' => $this->email,
                'role'  => $this->role,
            ]);

            if ($this->plan_id) {
                $plan = Plan::find($this->plan_id);
            
                // Check if the user already has this plan attached
                if ($user->plans->contains($this->plan_id)) {
                    // Update existing pivot data
                    $user->plans()->updateExistingPivot($this->plan_id, [
                        'total_required' => $plan->amount_required,
                    ]);
                } else {
                    // Detach any old plan and attach the new one
                    if ($this->activePlan) {
                        $user->plans()->detach($this->activePlan->id);
                    }
            
                    $user->plans()->attach($plan->id, [
                        // 'start_date'     => now(),
                        // 'end_date'       => now()->addDays($plan->duration ?? 30),
                        'total_required' => $plan->amount_required,
                        // 'amount_paid'    => 0,
                        'status'         => 'active',
                    ]);
                }
            }
        });

        session()->flash('success', 'User updated successfully!');
    }
    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}
