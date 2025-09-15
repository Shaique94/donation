<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layout.admin')]

class Index extends Component
{
    public $users;
    public function mount() {
        $this->users = User::with([
            'plans' => function($query) {
                $query->withPivot(['start_date', 'end_date', 'total_required', 'amount_paid', 'amount_remaining', 'status']);
            },
            'donations' => function($query) {
                $query->orderBy('donation_date', 'desc');
            }
        ])->get();
    }
    public function render()
    {
        return view('livewire.admin.users.index');
    }
}
