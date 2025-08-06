<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@placezo.com'],
            [
                'name' => 'Admin Principal',
                'password' => Hash::make('AdminPlacezo2024!'),
            ]
        );
        $admin->assignRole('admin');

        // Hôte
        $host = User::firstOrCreate(
            ['email' => 'marie.host@test.com'],
            [
                'name' => 'Marie Dubois',
                'password' => Hash::make('password123'),
            ]
        );
        $host->assignRole('host');

        // Client
        $client = User::firstOrCreate(
            ['email' => 'kiki.client@test.com'],
            [
                'name' => 'Kiki Client',
                'password' => Hash::make('password123'),
            ]
        );
        $client->assignRole('client');
    }
}
