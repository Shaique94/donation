<?php

namespace App\Livewire\Admin\Plan;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.admin')]

class Index extends Component
{
    public function render()
    {
        return view('livewire.admin.plan.index');
    }
}
