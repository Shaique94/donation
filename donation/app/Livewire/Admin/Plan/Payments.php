<?php

namespace App\Livewire\Admin\Plan;

use App\Models\Plan;
use App\Models\User;
use App\Models\PlanUser;
use App\Models\Donation;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layout.admin')]
class Payments extends Component
{
    public $plan;
    public $user;
    public $planUser;
    public $donations;
    public $monthlyPayment;
    public $paymentProgress;
    
    // Form fields
    public $paymentAmount;
    public $paymentMethod;
    public $paymentDate;
    public $paymentNotes;
    
    public function mount($planId, $userId)
    {
        $this->plan = Plan::findOrFail($planId);
        $this->user = User::findOrFail($userId);
        
        $this->planUser = PlanUser::where('plan_id', $planId)
            ->where('user_id', $userId)
            ->where('status', 'active')
            ->firstOrFail();
            
        $this->loadPaymentData();
    }
    
    public function loadPaymentData()
    {
        // Calculate monthly payment
        $startDate = Carbon::parse($this->planUser->start_date);
        $endDate = Carbon::parse($this->planUser->end_date ?? $startDate->copy()->addYear());
        $months = $startDate->diffInMonths($endDate) ?: 1;
        $this->monthlyPayment = $this->planUser->total_required / $months;
        
        // Calculate payment progress
        $this->paymentProgress = $this->planUser->total_required > 0 
            ? min(100, round(($this->planUser->amount_paid / $this->planUser->total_required) * 100)) 
            : 0;
            
        // Load all donations for this plan-user
        $this->donations = Donation::where('user_id', $this->user->id)
            ->where('plan_id', $this->plan->id)
            ->where('donation_date', '>=', $this->planUser->start_date)
            ->orderByDesc('donation_date')
            ->get();
            
        // Set default payment date to today
        $this->paymentDate = Carbon::now()->format('Y-m-d');
    }
    
    public function addPayment()
    {
        $this->validate([
            'paymentAmount' => 'required|numeric|min:1',
            'paymentMethod' => 'required|string',
            'paymentDate' => 'required|date',
        ]);
        
        // Create the donation record
        Donation::create([
            'user_id' => $this->user->id,
            'plan_id' => $this->plan->id,
            'amount' => $this->paymentAmount,
            'payment_method' => $this->paymentMethod,
            'donation_date' => $this->paymentDate,
            'notes' => $this->paymentNotes,
            'is_plan_payment' => true
        ]);
        
        // Update the plan_user record
        $this->planUser->amount_paid += $this->paymentAmount;
        $this->planUser->save();
        
        // Reset form fields
        $this->reset(['paymentAmount', 'paymentMethod', 'paymentNotes']);
        $this->paymentDate = Carbon::now()->format('Y-m-d');
        
        // Reload payment data
        $this->loadPaymentData();
        
        // Show success message
        session()->flash('message', 'Payment recorded successfully.');
    }
    
    public function render()
    {
        return view('livewire.admin.plan.payments');
    }
}