<?php

namespace App\Livewire\Admin\Plan;

use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.admin')]

class Index extends Component
{
    public $plans;
    public $showDeleteModal = false;
    public $planIdToDelete;
    
    public function mount()
    {
        $this->loadPlans();
    }
    
    public function loadPlans()
    {
        $plans = Plan::with('planUsers')
            ->withCount('users')
            ->orderBy('amount')
            ->get();
            
        foreach($plans as $plan) {
            // Calculate payment progress metrics
            $totalRequired = $plan->planUsers->sum('total_required');
            $totalPaid = $plan->planUsers->sum('amount_paid');
            $totalOutstanding = $plan->planUsers->sum('amount_remaining');
            
            $plan->total_required = $totalRequired;
            $plan->total_paid = $totalPaid;
            $plan->total_outstanding = $totalOutstanding;
            $plan->payment_progress = $totalRequired > 0 ? min(100, round(($totalPaid / $totalRequired) * 100)) : 0;
        }
        
        $this->plans = $plans;
    }
    
    public function togglePlanStatus($planId)
    {
        $plan = Plan::findOrFail($planId);
        $plan->update(['is_active' => !$plan->is_active]);
        
        $this->loadPlans();
    }
    
    public function confirmDelete($planId)
    {
        $this->planIdToDelete = $planId;
        $this->showDeleteModal = true;
    }
    
    public function deletePlan()
    {
        $plan = Plan::findOrFail($this->planIdToDelete);
        
        // Only delete if there are no users attached
        if ($plan->users()->count() == 0) {
            $plan->delete();
            session()->flash('message', 'Plan deleted successfully.');
        } else {
            session()->flash('error', 'Cannot delete plan with active users.');
        }
        
        $this->showDeleteModal = false;
        $this->planIdToDelete = null;
        $this->loadPlans();
    }
    
    public function render()
    {
        return view('livewire.admin.plan.index');
    }
}
