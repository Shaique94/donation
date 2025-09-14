<?php

namespace App\Livewire\Admin\Plan;

use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.admin')]

class Edit extends Component
{
    public $planId; // for edit mode
    public $plan_name;
    public $description;
    public $price;
    public $duration;
    public $status;

    protected $rules = [
        'plan_name'   => 'required|string|max:255',
        'description'=> 'nullable|string|max:500',
        'price'      => 'required|numeric|min:0',
        'duration'   => 'required|integer|min:1',
        'status'     => 'required',
    ];

    public function mount($planId = null)
    {
        if ($planId) {
            $plan = Plan::findOrFail($planId);
            $this->planId     = $plan->id;
            $this->plan_name   = $plan->name;
            $this->description= $plan->description;
            $this->price      = $plan->amount_required;
            $this->duration   = $plan->duration_months;
            $this->status     = $plan->is_active;
        }
    }

    public function savePlan()
    {
        $this->validate();

        
            // Edit mode
            $plan = Plan::find($this->planId);
            $plan->update([
                'name'   => $this->plan_name,
                'description' => $this->description,
                'amount_required' => $this->price,
                'duration_months'    => $this->duration,
                'is_active'      => $this->status,
            ]);

            session()->flash('success', 'Plan updated successfully!');

            $this->reset(['plan_name','description','price','duration','status']);

            return redirect()->route('admin.plan.index');
        }

    
    public function render()
    {
        return view('livewire.admin.plan.edit');
    }
}
