<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layout.admin')]

class Index extends Component
{
    public $users;
    public function mount(){
        $this->users = User::all();
    }
    public function render()
    {
        return view('livewire.admin.users.index');
    }
}
