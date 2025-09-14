<?php

namespace App\Livewire\Admin\Plan;

use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.admin')]

class Index extends Component
{
    public $plans;
    public function mount(){
        $this->plans = Plan::where('is_active',1)->get();
    }
    public function render()
    {
        return view('livewire.admin.plan.index');
    }
}
