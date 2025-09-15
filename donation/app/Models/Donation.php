<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'payment_method',
        'receipt_number',
        'notes',
        'donation_date',
        'plan_id',
        'status'
    ];

    protected $casts = [
        'donation_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    
    // Get the plan user record if this donation is for a plan
    public function planUser()
    {
        if (!$this->plan_id || !$this->user_id) {
            return null;
        }
        
        return PlanUser::where('plan_id', $this->plan_id)
                      ->where('user_id', $this->user_id)
                      ->where('start_date', '<=', $this->donation_date)
                      ->where(function($query) {
                          $query->where('end_date', '>=', $this->donation_date)
                                ->orWhereNull('end_date');
                      })
                      ->first();
    }
    
    // Check if donation is for the current month
    public function isCurrentMonth()
    {
        if (!$this->donation_date) {
            return false;
        }
        
        $now = Carbon::now();
        $donationDate = Carbon::parse($this->donation_date);
        
        return $donationDate->month === $now->month && 
               $donationDate->year === $now->year;
    }
    
    // Auto-update the plan user when a donation is saved
    protected static function booted()
    {
        static::saved(function ($donation) {
            if ($donation->plan_id && $donation->user_id && $donation->status === 'completed') {
                $planUser = PlanUser::where('plan_id', $donation->plan_id)
                                   ->where('user_id', $donation->user_id)
                                   ->where('status', 'active')
                                   ->first();
                
                if ($planUser) {
                    $planUser->amount_paid += $donation->amount;
                    $planUser->save();
                }
            }
        });
    }
}