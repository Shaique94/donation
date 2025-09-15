<?php

namespace Database\Seeders;

use App\Models\Donation;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get our two members
        $user1 = User::where('email', 'member1@example.com')->first();
        $user2 = User::where('email', 'member2@example.com')->first();
        
        // Get the Basic Plan
        $plan = Plan::where('name', 'Basic Plan')->first();
        
        if ($user1 && $user2 && $plan) {
            $now = Carbon::now();
            
            // Create donations for User 1
            Donation::create([
                'user_id' => $user1->id,
                'plan_id' => $plan->id,
                'amount' => 300,
                'payment_method' => 'Cash',
                'receipt_number' => 'REC001',
                'notes' => 'First payment',
                'donation_date' => $now->copy()->subDays(30)->toDateString(),
                'status' => 'completed'
            ]);
            
            Donation::create([
                'user_id' => $user1->id,
                'plan_id' => $plan->id,
                'amount' => 200,
                'payment_method' => 'UPI',
                'receipt_number' => 'REC002',
                'notes' => 'Second payment',
                'donation_date' => $now->toDateString(),
                'status' => 'completed'
            ]);
            
            // Create donations for User 2
            Donation::create([
                'user_id' => $user2->id,
                'plan_id' => $plan->id,
                'amount' => 250,
                'payment_method' => 'Bank Transfer',
                'receipt_number' => 'REC003',
                'notes' => 'Initial payment',
                'donation_date' => $now->toDateString(),
                'status' => 'completed'
            ]);
        }
    }
}