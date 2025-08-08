<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CalendarController extends Controller
{
    /**
     * Afficher le calendrier pour un hôte
     */
    public function index()
    {
        $user = auth()->user();
        $listings = $user->listings()->with(['bookings'])->get();
        
        return view('calendar.index', compact('listings'));
    }

    /**
     * Récupérer les événements pour le calendrier (AJAX)
     */
    public function getEvents(Request $request): JsonResponse
    {
        $user = auth()->user();
        $listingId = $request->input('listing_id');
        
        $query = Booking::with(['listing', 'user']);
        
        if ($listingId) {
            $query->where('listing_id', $listingId);
        } else {
            // Tous les bookings des listings de l'hôte
            $query->whereHas('listing', function($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }
        
        $bookings = $query->get();
        
        $events = $bookings->map(function($booking) {
            $color = match($booking->statut) {
                'confirmee' => '#10B981', // green
                'en_attente' => '#F59E0B', // yellow
                'annulee' => '#EF4444', // red
                'terminee' => '#6B7280', // gray
                default => '#3B82F6' // blue
            };
            
            return [
                'id' => $booking->id,
                'title' => $booking->listing->titre . ' - ' . $booking->user->name,
                'start' => $booking->date_debut,
                'end' => $booking->date_fin,
                'backgroundColor' => $color,
                'borderColor' => $color,
                'extendedProps' => [
                    'statut' => $booking->statut,
                    'prix_total' => $booking->prix_total,
                    'client' => $booking->user->name,
                    'listing' => $booking->listing->titre
                ]
            ];
        });
        
        return response()->json($events);
    }

    /**
     * Mettre à jour le statut d'une réservation via le calendrier
     */
    public function updateBookingStatus(Request $request): JsonResponse
    {
        $booking = Booking::findOrFail($request->input('booking_id'));
        
        // Vérifier que l'utilisateur est le propriétaire du listing
        if ($booking->listing->user_id !== auth()->id()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }
        
        $booking->update(['statut' => $request->input('statut')]);
        
        return response()->json(['success' => true]);
    }

    /**
     * Bloquer/débloquer des dates
     */
    public function toggleDateAvailability(Request $request): JsonResponse
    {
        $listing = Listing::findOrFail($request->input('listing_id'));
        
        // Vérifier que l'utilisateur est le propriétaire
        if ($listing->user_id !== auth()->id()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }
        
        $date = $request->input('date');
        $action = $request->input('action'); // 'block' ou 'unblock'
        
        // Ici tu peux implémenter la logique pour bloquer/débloquer des dates
        // Pour l'instant, on retourne un succès
        
        return response()->json(['success' => true]);
    }
} 