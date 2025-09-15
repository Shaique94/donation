<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create User 1
        $user1 = User::create([
            'name' => 'Member 1',
            'email' => 'member1@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Create User 2
        $user2 = User::create([
            'name' => 'Member 2',
            'email' => 'member2@example.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Get the first plan (Basic Plan)
        $plan = Plan::where('name', 'Basic Plan')->first();
        
        if ($plan) {
            // Current date
            $now = Carbon::now();
            
            // Attach User 1 to the Basic Plan
            $user1->plans()->attach($plan->id, [
                'start_date' => $now->toDateString(),
                'end_date' => $now->copy()->addYear()->toDateString(),
                'total_required' => $plan->amount,
                'amount_paid' => $plan->amount / 2, // 50% paid
                'status' => 'active',
            ]);
            
            // Attach User 2 to the Basic Plan
            $user2->plans()->attach($plan->id, [
                'start_date' => $now->toDateString(),
                'end_date' => $now->copy()->addYear()->toDateString(),
                'total_required' => $plan->amount,
                'amount_paid' => $plan->amount / 4, // 25% paid
                'status' => 'active',
            ]);
        }
    }
}