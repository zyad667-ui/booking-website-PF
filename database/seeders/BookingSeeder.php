<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Listing;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = User::where('email', 'kiki.client@test.com')->first();
        $listings = Listing::all();
        if (!$client || $listings->isEmpty()) return;

        $i = 0;
        foreach ($listings as $listing) {
            Booking::create([
                'user_id' => $client->id,
                'listing_id' => $listing->id,
                'date_debut' => now()->addDays($i * 7)->toDateString(),
                'date_fin' => now()->addDays($i * 7 + 3)->toDateString(),
                'statut' => 'confirmee',
                'prix_total' => $listing->prix * 3,
            ]);
            $i++;
        }
    }
}
