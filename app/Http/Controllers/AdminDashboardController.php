<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $roles = auth()->user()->getRoleNames();
        
        // Statistiques réelles
        $stats = [
            'total_users' => User::count(),
            'total_listings' => Listing::count(),
            'total_bookings' => Booking::count(),
            'total_payments' => Payment::count(),
            'pending_listings' => Listing::where('statut', 'en_attente')->count(),
            'confirmed_bookings' => Booking::where('statut', 'confirmee')->count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_listings' => Listing::with('user')->latest()->take(5)->get(),
            'recent_bookings' => Booking::with(['user', 'listing'])->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('roles', 'stats'));
    }
}