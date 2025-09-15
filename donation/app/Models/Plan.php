<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'amount',
        'is_active'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'plan_users')
                    ->using(PlanUser::class)
                    ->withPivot(['start_date', 'end_date', 'total_required', 'amount_paid', 'amount_remaining', 'status'])
                    ->withTimestamps();
    }

    public function planUsers()
    {
        return $this->hasMany(PlanUser::class, 'plan_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
    
    // Get count of users on this plan
    public function getUserCountAttribute()
    {
        return $this->users()->count();
    }
}
