<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\User;

class ListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $host = User::where('email', 'marie.host@test.com')->first();
        if (!$host) return;

        Listing::create([
            'user_id' => $host->id,
            'titre' => 'Appartement cosy centre-ville',
            'description' => 'Un bel appartement lumineux au cœur de la ville, proche de toutes commodités.',
            'adresse' => '12 rue de la Paix, Paris',
            'prix' => 120.00,
            'statut' => 'publie',
        ]);

        Listing::create([
            'user_id' => $host->id,
            'titre' => 'Studio moderne avec terrasse',
            'description' => 'Studio entièrement rénové avec une grande terrasse ensoleillée.',
            'adresse' => '5 avenue des Champs, Lyon',
            'prix' => 80.00,
            'statut' => 'publie',
        ]);
    }
}
