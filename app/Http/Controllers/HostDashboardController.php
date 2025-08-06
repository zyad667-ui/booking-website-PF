<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Booking;
use Illuminate\Http\Request;

class HostDashboardController extends Controller
{
    public function index()
    {
        $roles = auth()->user()->getRoleNames();
        $user = auth()->user();
        
        // Statistiques spécifiques à l'hôte
        $stats = [
            'total_listings' => $user->listings()->count(),
            'published_listings' => $user->listings()->where('statut', 'publie')->count(),
            'pending_listings' => $user->listings()->where('statut', 'en_attente')->count(),
            'total_bookings' => Booking::whereHas('listing', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->count(),
            'confirmed_bookings' => Booking::whereHas('listing', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->where('statut', 'confirmee')->count(),
            'recent_listings' => $user->listings()->latest()->take(5)->get(),
            'recent_bookings' => Booking::whereHas('listing', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['user', 'listing'])->latest()->take(5)->get(),
        ];

        return view('host.dashboard', compact('roles', 'stats'));
    }
}