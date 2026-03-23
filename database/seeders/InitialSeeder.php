<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Plan;
use Illuminate\Support\Facades\Hash;

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Superadmin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@syndicate.com',
            'password' => Hash::make('admin123'),
            'role' => 'superadmin',
        ]);

        // Create Sample Plans
        Plan::create([
            'title' => 'NCR Luxury Marriage Hall Portfolio',
            'description' => 'A cluster of 5 high-yield banquet halls in prime NCR locations with 18% historical returns.',
            'sector' => 'Marriage Halls',
            'min_investment' => 500000,
            'target_irr' => 18.50,
            'status' => 'active',
        ]);

        Plan::create([
            'title' => 'Smart Classroom Infra - Pune Hub',
            'description' => 'Developing state-of-the-art digital infrastructure for 12 private schools in Pune.',
            'sector' => 'Education',
            'min_investment' => 200000,
            'target_irr' => 15.75,
            'status' => 'active',
        ]);
        
        Plan::create([
            'title' => 'Digital Coaching Expansion Sikar',
            'description' => 'Scaling digital learning centers across Sikar & Kota districts with proven hybrid models.',
            'sector' => 'Coaching',
            'min_investment' => 100000,
            'target_irr' => 22.00,
            'status' => 'active',
        ]);
    }
}
