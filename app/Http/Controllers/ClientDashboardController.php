<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listing;
use Illuminate\Http\Request;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $roles = auth()->user()->getRoleNames();
        $user = auth()->user();
        
        // Statistiques spécifiques au client
        $stats = [
            'total_bookings' => $user->bookings()->count(),
            'confirmed_bookings' => $user->bookings()->where('statut', 'confirmee')->count(),
            'pending_bookings' => $user->bookings()->where('statut', 'en_attente')->count(),
            'total_listings_available' => Listing::where('statut', 'publie')->count(),
            'recent_bookings' => $user->bookings()->with(['listing'])->latest()->take(5)->get(),
            'available_listings' => Listing::where('statut', 'publie')->latest()->take(5)->get(),
        ];

        return view('client.dashboard', compact('roles', 'stats'));
    }
}