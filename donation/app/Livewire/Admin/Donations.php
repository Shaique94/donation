<?php

namespace App\Livewire\Admin;

use App\Models\Donation;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layout.admin')]

class Donations extends Component
{
    use WithPagination;
    
    public $showModal = false;
    public $donationId = null;
    public $user_id;
    public $amount;
    public $payment_method;
    public $receipt_number;
    public $notes;
    public $donation_date;
    public $plan_id;
    public $status;
    
    public $searchTerm = '';
    public $filterPlan = '';
    public $filterStatus = '';
    public $dateRange = '';
    
    protected $rules = [
        'user_id' => 'required|exists:users,id',
        'amount' => 'required|numeric|min:1',
        'payment_method' => 'required|string',
        'receipt_number' => 'nullable|string',
        'notes' => 'nullable|string',
        'donation_date' => 'required|date',
        'plan_id' => 'nullable|exists:plans,id',
        'status' => 'required|in:pending,completed,failed',
    ];
    
    public function render()
    {
        $donations = Donation::with(['user', 'plan'])
            ->when($this->searchTerm, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->searchTerm . '%')
                      ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
                })
                ->orWhere('receipt_number', 'like', '%' . $this->searchTerm . '%');
            })
            ->when($this->filterPlan, function ($query) {
                $query->where('plan_id', $this->filterPlan);
            })
            ->when($this->filterStatus, function ($query) {
                $query->where('status', $this->filterStatus);
            })
            ->when($this->dateRange, function ($query) {
                // Parse date range if needed
                if ($this->dateRange === 'today') {
                    $query->whereDate('donation_date', today());
                } elseif ($this->dateRange === 'week') {
                    $query->whereBetween('donation_date', [now()->startOfWeek(), now()->endOfWeek()]);
                } elseif ($this->dateRange === 'month') {
                    $query->whereMonth('donation_date', now()->month)
                          ->whereYear('donation_date', now()->year);
                } elseif ($this->dateRange === 'year') {
                    $query->whereYear('donation_date', now()->year);
                }
            })
            ->orderBy('donation_date', 'desc')
            ->paginate(10);
            
        $totalDonations = Donation::sum('amount');
        $donationsByMonth = DB::table('donations')
            ->select(DB::raw('MONTH(donation_date) as month'), DB::raw('SUM(amount) as total'))
            ->whereYear('donation_date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        $donationsByPlan = DB::table('donations')
            ->join('plans', 'donations.plan_id', '=', 'plans.id')
            ->select('plans.name', DB::raw('SUM(donations.amount) as total'))
            ->groupBy('plans.name')
            ->get();
            
        $users = User::all();
        $plans = Plan::all();
            
        return view('livewire.admin.donations', [
            'donations' => $donations,
            'totalDonations' => $totalDonations,
            'donationsByMonth' => $donationsByMonth,
            'donationsByPlan' => $donationsByPlan,
            'users' => $users,
            'plans' => $plans,
        ]);
    }
    
    public function createDonation()
    {
        $this->resetValidation();
        $this->resetExcept(['searchTerm', 'filterPlan', 'filterStatus', 'dateRange']);
        $this->showModal = true;
        $this->donation_date = now()->format('Y-m-d');
        $this->status = 'completed';
    }
    
    public function saveDonation()
    {
        $this->validate();
        
        if ($this->donationId) {
            $donation = Donation::find($this->donationId);
            $donation->update([
                'user_id' => $this->user_id,
                'amount' => $this->amount,
                'payment_method' => $this->payment_method,
                'receipt_number' => $this->receipt_number,
                'notes' => $this->notes,
                'donation_date' => $this->donation_date,
                'plan_id' => $this->plan_id,
                'status' => $this->status,
            ]);
            
            session()->flash('message', 'Donation updated successfully!');
        } else {
            Donation::create([
                'user_id' => $this->user_id,
                'amount' => $this->amount,
                'payment_method' => $this->payment_method,
                'receipt_number' => $this->receipt_number,
                'notes' => $this->notes,
                'donation_date' => $this->donation_date,
                'plan_id' => $this->plan_id,
                'status' => $this->status,
            ]);
            
            session()->flash('message', 'Donation recorded successfully!');
        }
        
        $this->showModal = false;
        $this->resetExcept(['searchTerm', 'filterPlan', 'filterStatus', 'dateRange']);
    }
    
    public function editDonation($id)
    {
        $this->donationId = $id;
        $donation = Donation::find($id);
        
        $this->user_id = $donation->user_id;
        $this->amount = $donation->amount;
        $this->payment_method = $donation->payment_method;
        $this->receipt_number = $donation->receipt_number;
        $this->notes = $donation->notes;
        $this->donation_date = $donation->donation_date->format('Y-m-d');
        $this->plan_id = $donation->plan_id;
        $this->status = $donation->status;
        
        $this->showModal = true;
    }
    
    public function deleteDonation($id)
    {
        Donation::destroy($id);
        session()->flash('message', 'Donation deleted successfully!');
    }
    
    public function closeModal()
    {
        $this->showModal = false;
        $this->resetValidation();
    }
    
    public function generateReceipt($id)
    {
        // This would connect to a receipt generation functionality
        session()->flash('message', 'Receipt generation initiated!');
    }
}