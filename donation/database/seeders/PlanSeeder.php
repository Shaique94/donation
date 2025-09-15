<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 3 plans
        $plans = [
            [
                'name' => 'Basic Plan',
                'description' => 'Basic membership plan for new members',
                'amount' => 1000,
                'is_active' => true,
            ],
            [
                'name' => 'Standard Plan',
                'description' => 'Standard plan with additional benefits',
                'amount' => 5000,
                'is_active' => true,
            ],
            [
                'name' => 'Premium Plan',
                'description' => 'Premium plan with all benefits',
                'amount' => 10000,
                'is_active' => true,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}