<?php

namespace App\Livewire\Admin\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.app')]
class Login extends Component
{
    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
