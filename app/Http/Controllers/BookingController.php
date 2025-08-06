<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listing;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        
        if ($user->hasRole('admin')) {
            $bookings = Booking::with(['user', 'listing'])->get();
        } elseif ($user->hasRole('host')) {
            $bookings = Booking::whereHas('listing', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with(['user', 'listing'])->get();
        } else {
            $bookings = $user->bookings()->with('listing')->get();
        }
        
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listings = Listing::where('statut', 'publie')->get();
        return view('bookings.create', compact('listings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'date_debut' => 'required|date|after:today',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $listing = Listing::findOrFail($validated['listing_id']);
        $jours = \Carbon\Carbon::parse($validated['date_debut'])->diffInDays($validated['date_fin']);
        $prix_total = $listing->prix * $jours;

        $validated['user_id'] = auth()->id();
        $validated['prix_total'] = $prix_total;
        $validated['statut'] = 'en_attente';

        Booking::create($validated);

        return redirect()->route('bookings.index')->with('success', 'Réservation créée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with(['user', 'listing'])->findOrFail($id);
        
        // Vérifier les permissions
        $user = auth()->user();
        if (!$user->hasRole('admin') && $booking->user_id !== $user->id && $booking->listing->user_id !== $user->id) {
            abort(403);
        }
        
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Vérifier les permissions
        $user = auth()->user();
        if (!$user->hasRole('admin') && $booking->user_id !== $user->id) {
            abort(403);
        }
        
        $listings = Listing::where('statut', 'publie')->get();
        return view('bookings.edit', compact('booking', 'listings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Vérifier les permissions
        $user = auth()->user();
        if (!$user->hasRole('admin') && $booking->user_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $listing = Listing::findOrFail($validated['listing_id']);
        $jours = \Carbon\Carbon::parse($validated['date_debut'])->diffInDays($validated['date_fin']);
        $validated['prix_total'] = $listing->prix * $jours;

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Réservation mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Vérifier les permissions
        $user = auth()->user();
        if (!$user->hasRole('admin') && $booking->user_id !== $user->id) {
            abort(403);
        }

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Réservation supprimée avec succès !');
    }
}
