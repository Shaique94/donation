<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PlanUser extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'plan_users';
    
    protected $guarded = [];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_required' => 'decimal:2',
        'amount_paid' => 'decimal:2',
        'amount_remaining' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function plan()
    {
        return $this->belongsTo(\App\Models\Plan::class);
    }
    
    public function donations()
    {
        return $this->hasMany(\App\Models\Donation::class, 'plan_id', 'plan_id')
                    ->where('user_id', $this->user_id)
                    ->where('donation_date', '>=', $this->start_date)
                    ->where(function($query) {
                        $query->whereNull('plan_id')
                              ->orWhere('plan_id', $this->plan_id);
                    });
    }
    
    // Monthly payment calculation - how much should be paid per month
    public function getMonthlyPaymentAttribute()
    {
        if (!$this->end_date || !$this->start_date) {
            return 0;
        }
        
        $startDate = Carbon::parse($this->start_date);
        $endDate = Carbon::parse($this->end_date);
        $months = $startDate->diffInMonths($endDate) ?: 1;
        
        return $this->total_required / $months;
    }
    
    // Get current month's payment
    public function getCurrentMonthPaymentAttribute()
    {
        $now = Carbon::now();
        
        // Check if the donations relationship has been loaded
        if (!$this->relationLoaded('donations')) {
            // If not, manually run the query
            return \App\Models\Donation::where('user_id', $this->user_id)
                ->where(function($query) {
                    $query->whereNull('plan_id')
                          ->orWhere('plan_id', $this->plan_id);
                })
                ->where('donation_date', '>=', $this->start_date)
                ->whereYear('donation_date', $now->year)
                ->whereMonth('donation_date', $now->month)
                ->sum('amount');
        }
        
        // If donations are loaded, filter them in memory
        return $this->donations
            ->filter(function($donation) use ($now) {
                return $donation->donation_date 
                    && $donation->donation_date->year === $now->year 
                    && $donation->donation_date->month === $now->month;
            })
            ->sum('amount');
    }
    
    // Get outstanding amount as of now
    public function getOutstandingAmountAttribute()
    {
        return $this->amount_remaining;
    }
    
    // Get payment progress percentage
    public function getPaymentProgressAttribute()
    {
        if ($this->total_required <= 0) {
            return 100;
        }
        
        return min(100, round(($this->amount_paid / $this->total_required) * 100));
    }
    
    // Get monthly payment status
    public function getMonthlyPaymentStatusAttribute()
    {
        $currentMonthPayment = $this->current_month_payment;
        $monthlyPayment = $this->monthly_payment;
        
        if ($currentMonthPayment >= $monthlyPayment) {
            return 'completed';
        } elseif ($currentMonthPayment > 0) {
            return 'partial';
        } else {
            return 'pending';
        }
    }
}
