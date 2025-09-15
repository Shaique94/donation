<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Run the Plan seeder
        $this->call(PlanSeeder::class);
        
        // Run the User-Plan seeder
        $this->call(UserPlanSeeder::class);
        
        // Run the Donation seeder
        $this->call(DonationSeeder::class);
    }
}
