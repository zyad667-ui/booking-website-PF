<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ✅ Admin
        $admin = User::create([
            'name' => 'admin Principal',
            'email' => 'admin@placezo.com',
            'password' => Hash::make('AdminPlacezo2024!'),
            'email_verified_at' => now(),
            'role' => 'admin'
        ]);
       
        // ✅ Hôte
        $host = User::create([
            'name' => 'Marie Dubois',
            'email' => 'marie.host@test.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
             'role' => 'user'
            
        ]);
     

        // ✅ Client
        $client = User::create([
            'name' => 'kiki',
            'email' => 'kiki@test.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
             'role' => 'zaml'
        ]);
       
    }
}
