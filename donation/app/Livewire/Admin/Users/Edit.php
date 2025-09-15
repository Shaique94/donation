<?php

namespace App\Livewire\Admin\Users;

use App\Models\Plan;
use App\Models\User;
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


    protected $rules = [
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'plan_id'  => 'nullable|exists:plans,id',
        'role'     => 'required|in:admin,member,user',
    ];

    public function mount(User $user){
        // dd($userId);
        $this->name = $user->name;
        $this->email = $user->email;
        // $this->password = $user->password;
        // $this->plan_id = $user->plan_id;
        $this->role = $user->role;

        // Get the first assigned plan
    $this->plan_id = optional($user->plans()->first())->id;

    // Load all plans for the dropdown
    $this->plans = Plan::all();
    }
    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}
