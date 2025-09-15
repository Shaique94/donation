<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'plan_users')
                    ->using(PlanUser::class)
                    ->withPivot(['start_date', 'end_date', 'total_required', 'amount_paid', 'status'])
                    ->withTimestamps();
    }

    public function planUsers()
    {
        return $this->hasMany(PlanUser::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
