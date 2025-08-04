<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed les rôles
        $this->call(RolesSeeder::class);

        // 2. Seed les utilisateurs (admin, host, client)
        $this->call(AdminSeeder::class);

        // 3. Facultatif : utilisateur de test
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
             'role' => 'admin'
        ]);
    }
}
