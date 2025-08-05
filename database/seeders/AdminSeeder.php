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
            'name' => 'Admin Principal',
            'email' => 'admin@placezo.com',
            'password' => Hash::make('AdminPlacezo2024!'),
            'email_verified_at' => now(),
            'role' => 'admin', // Colonne role classique
        ]);
        $admin->assignRole('admin'); // Système Spatie

        // ✅ Hôte
        $host = User::create([
            'name' => 'Marie Dubois',
            'email' => 'marie.host@test.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role' => 'host', // Colonne role classique
        ]);
        $host->assignRole('host'); // Système Spatie

        // ✅ Client
        $client = User::create([
            'name' => 'Jean Client',
            'email' => 'jean.client@test.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
            'role' => 'client', // Colonne role classique
        ]);
        $client->assignRole('client'); // Système Spatie
    }
}
