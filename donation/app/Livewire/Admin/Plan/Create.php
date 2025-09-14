<?php

namespace App\Livewire\Admin\Plan;

use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.admin')]

class Create extends Component
{
    public $plan_name;
    public $description;
    public $price;
    public $duration;

    protected $rules = [
        'plan_name'   => 'required|string|max:255',
        'description'=> 'nullable|string|max:500',
        'price'      => 'required|numeric|min:0',
        'duration'   => 'required|integer|min:1',
    ];

    public function create_plan()
    {
        $this->validate();

        Plan::create([
            'name'   => $this->plan_name,
            'description' => $this->description,
            'amount_required' => $this->price,
            'duration_months'    => $this->duration,
            'is_active'      => true,
        ]);

        session()->flash('success', 'Plan created successfully!');
        
        // Optionally reset form after saving
        $this->reset(['plan_name', 'description', 'price', 'duration']);

        return redirect()->route('admin.plan.index');
    }
    
    
    
    public function render()
    {
        return view('livewire.admin.plan.create');
    }
}
