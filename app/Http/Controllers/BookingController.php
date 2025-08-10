<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Listing;
use Illuminate\Http\Request;
use Musonza\Chat\Chat;

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

        $listing = Listing::with('user')->findOrFail($validated['listing_id']);
        $user = auth()->user();
        
        // Vérifier que l'utilisateur ne réserve pas sa propre propriété
        if ($listing->user_id === $user->id) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas réserver votre propre propriété.');
        }
        
        $jours = \Carbon\Carbon::parse($validated['date_debut'])->diffInDays($validated['date_fin']);
        $prix_total = $listing->prix * $jours;

        $validated['user_id'] = $user->id;
        $validated['prix_total'] = $prix_total;
        $validated['statut'] = 'en_attente';

        $booking = Booking::create($validated);

        // Log pour debug
        \Log::info('Nouvelle réservation créée', [
            'booking_id' => $booking->id,
            'client' => $user->name,
            'host' => $listing->user->name,
            'listing' => $listing->titre,
            'dates' => $validated['date_debut'] . ' -> ' . $validated['date_fin'],
            'total' => $prix_total
        ]);

        // Notifier l'hôte via message (méthode simplifiée)
        $notificationSent = false;
        try {
            $chat = app(Chat::class);
            
            // Essayer de créer ou récupérer la conversation
            $conversation = $chat->createConversation([$user, $listing->user]);
            
            if ($conversation) {
                $messageContent = "🏠 **NOUVELLE RÉSERVATION**\n\n";
                $messageContent .= "Propriété : {$listing->titre}\n";
                $messageContent .= "Client : {$user->name} ({$user->email})\n";
                $messageContent .= "Dates : " . \Carbon\Carbon::parse($validated['date_debut'])->format('d/m/Y') . " → " . \Carbon\Carbon::parse($validated['date_fin'])->format('d/m/Y') . "\n";
                $messageContent .= "Durée : {$jours} nuit(s)\n";
                $messageContent .= "💰 Total : " . number_format($prix_total, 2) . "€\n\n";
                $messageContent .= "Gérez cette réservation dans votre tableau de bord.";
                
                $message = $chat->message($messageContent)
                    ->from($user)
                    ->to($conversation)
                    ->send();
                
                if ($message) {
                    $notificationSent = true;
                    \Log::info('Notification envoyée avec succès à l\'hôte');
                }
            }
                
        } catch (\Exception $e) {
            \Log::error('Erreur notification hôte : ' . $e->getMessage(), [
                'booking_id' => $booking->id,
                'host_id' => $listing->user_id,
                'client_id' => $user->id
            ]);
        }

        // Message de succès adapté
        $successMessage = 'Réservation créée avec succès !';
        if ($notificationSent) {
            $successMessage .= ' L\'hôte a été notifié de votre demande.';
        } else {
            $successMessage .= ' Vous pouvez contacter l\'hôte via la messagerie.';
        }

        return redirect()->route('bookings.index')->with('success', $successMessage);
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
        $booking = Booking::with(['user', 'listing.user'])->findOrFail($id);
        
        // Vérifier les permissions
        $user = auth()->user();
        $isHost = $booking->listing->user_id === $user->id;
        $isClient = $booking->user_id === $user->id;
        $isAdmin = $user->hasRole('admin');
        
        if (!$isAdmin && !$isHost && !$isClient) {
            abort(403, 'Vous n\'avez pas les permissions pour modifier cette réservation.');
        }

        // Si c'est juste un changement de statut (hôte qui confirme/refuse)
        if ($request->has('statut') && $isHost) {
            $newStatus = $request->input('statut');
            
            if (!in_array($newStatus, ['confirmee', 'annulee'])) {
                return redirect()->back()->with('error', 'Statut invalide.');
            }
            
            $oldStatus = $booking->statut;
            $booking->statut = $newStatus;
            $booking->save();
            
            // Notifier le client du changement
            $this->notifyStatusChange($booking, $oldStatus, $newStatus);
            
            $message = $newStatus === 'confirmee' ? 
                'Réservation confirmée avec succès ! Le client a été notifié.' : 
                'Réservation refusée. Le client a été notifié.';
                
            return redirect()->back()->with('success', $message);
        }

        // Modification complète des données (admin/client)
        $validated = $request->validate([
            'listing_id' => 'sometimes|required|exists:listings,id',
            'date_debut' => 'sometimes|required|date',
            'date_fin' => 'sometimes|required|date|after:date_debut',
            'statut' => 'sometimes|in:en_attente,confirmee,annulee,terminee'
        ]);

        // Recalculer le prix si les dates changent
        if (isset($validated['date_debut']) && isset($validated['date_fin'])) {
            $listing = isset($validated['listing_id']) ? 
                Listing::findOrFail($validated['listing_id']) : 
                $booking->listing;
            
            $jours = \Carbon\Carbon::parse($validated['date_debut'])->diffInDays($validated['date_fin']);
            $validated['prix_total'] = $listing->prix * $jours;
        }

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Réservation mise à jour avec succès !');
    }

    /**
     * Notifier le client d'un changement de statut
     */
    private function notifyStatusChange($booking, $oldStatus, $newStatus)
    {
        try {
            $chat = app(Chat::class);
            $conversation = $chat->createConversation([$booking->listing->user, $booking->user]);
            
            $statusMessages = [
                'confirmee' => '✅ **RÉSERVATION CONFIRMÉE**',
                'annulee' => '❌ **RÉSERVATION REFUSÉE**'
            ];
            
            $messageContent = $statusMessages[$newStatus] . "\n\n";
            $messageContent .= "Propriété : {$booking->listing->titre}\n";
            $messageContent .= "Dates : " . \Carbon\Carbon::parse($booking->date_debut)->format('d/m/Y') . " → " . \Carbon\Carbon::parse($booking->date_fin)->format('d/m/Y') . "\n";
            
            if ($newStatus === 'confirmee') {
                $messageContent .= "\nVotre réservation a été confirmée ! Vous pouvez procéder au paiement.";
            } else {
                $messageContent .= "\nDésolé, votre réservation n'a pas pu être acceptée. Vous pouvez consulter d'autres propriétés disponibles.";
            }
            
            $chat->message($messageContent)
                ->from($booking->listing->user)
                ->to($conversation)
                ->send();
                
            \Log::info('Notification de changement de statut envoyée', [
                'booking_id' => $booking->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus
            ]);
                
        } catch (\Exception $e) {
            \Log::error('Erreur notification changement statut : ' . $e->getMessage());
        }
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
