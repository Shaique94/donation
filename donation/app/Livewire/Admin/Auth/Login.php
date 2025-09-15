<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.app')]
class Login extends Component
{
    public $email;
    public $password;
    // public $remember = false;

    protected $rules = [
        'email'    => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt([
            'email' => $this->email,
            'password' => $this->password,
        ])) {

            session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('/');
        }

        $this->addError('email', 'Invalid email or password.');
    }
    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
