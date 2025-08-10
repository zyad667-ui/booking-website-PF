<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\Booking;
use Illuminate\Http\Request;
use Musonza\Chat\Chat;

class MessageController extends Controller
{
    protected $chat;

    public function __construct()
    {
        $this->chat = app(Chat::class);
    }

    /**
     * Afficher la liste des conversations
     */
    public function index()
    {
        $user = auth()->user();
        $conversations = $this->chat->conversations()->setParticipant($user)->get();
        
        return view('messages.index', compact('conversations'));
    }

    /**
     * Afficher une conversation spécifique
     */
    public function show($conversationId)
    {
        $user = auth()->user();
        $conversation = $this->chat->conversations()->getById($conversationId);
        
        // Vérifier que l'utilisateur participe à cette conversation
        if (!$conversation->hasParticipant($user)) {
            abort(403);
        }
        
        $messages = $this->chat->conversation($conversation)->setParticipant($user)->getMessages();
        
        return view('messages.show', compact('conversation', 'messages'));
    }

    /**
     * Créer une nouvelle conversation
     */
    public function create(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
            'subject' => 'nullable|string|max:255',
            'listing_id' => 'nullable|exists:listings,id',
        ]);

        $user = auth()->user();
        $recipient = User::findOrFail($request->recipient_id);
        
        // Vérifier que l'utilisateur ne s'envoie pas un message à lui-même
        if ($user->id === $recipient->id) {
            return redirect()->back()->withErrors(['recipient_id' => 'Vous ne pouvez pas vous envoyer un message à vous-même.']);
        }
        
        // Créer ou récupérer la conversation
        $conversation = $this->chat->createConversation([$user, $recipient]);
        
        // Ajouter le sujet au message si fourni
        $messageContent = $request->message;
        if ($request->subject) {
            $messageContent = "**" . $request->subject . "**\n\n" . $messageContent;
        }
        
        // Envoyer le premier message
        $this->chat->message($messageContent)
            ->from($user)
            ->to($conversation)
            ->send();
        
        return redirect()->route('messages.show', $conversation->id)
                        ->with('success', 'Votre message a été envoyé avec succès !');
    }

    /**
     * Envoyer un message dans une conversation
     */
    public function sendMessage(Request $request, $conversationId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = auth()->user();
        $conversation = $this->chat->conversations()->getById($conversationId);
        
        // Vérifier que l'utilisateur participe à cette conversation
        if (!$conversation->hasParticipant($user)) {
            abort(403);
        }
        
        $this->chat->message($request->message)
            ->from($user)
            ->to($conversation)
            ->send();
        
        return redirect()->back();
    }

    /**
     * Marquer une conversation comme lue
     */
    public function markAsRead($conversationId)
    {
        $user = auth()->user();
        $conversation = $this->chat->conversations()->getById($conversationId);
        
        if ($conversation->hasParticipant($user)) {
            $this->chat->conversation($conversation)->setParticipant($user)->readAll();
        }
        
        return response()->json(['success' => true]);
    }

    /**
     * Obtenir les conversations non lues (AJAX)
     */
    public function getUnreadCount()
    {
        $user = auth()->user();
        $unreadCount = $this->chat->conversations()->setParticipant($user)->unreadCount();
        
        return response()->json(['count' => $unreadCount]);
    }

    /**
     * Afficher la page de contact pour une annonce
     */
    public function contactHost($listingId)
    {
        $listing = Listing::with('user')->findOrFail($listingId);
        $user = auth()->user();
        
        // Vérifier que l'utilisateur ne contacte pas sa propre annonce
        if ($listing->user_id === $user->id) {
            abort(403, 'Vous ne pouvez pas contacter votre propre annonce');
        }
        
        return view('messages.contact', compact('listing'));
    }

    /**
     * Afficher la page de contact pour une réservation
     */
    public function contactBooking($bookingId)
    {
        $booking = Booking::with(['listing.user', 'user'])->findOrFail($bookingId);
        $user = auth()->user();
        
        // Vérifier que l'utilisateur participe à cette réservation
        if ($booking->user_id !== $user->id && $booking->listing->user_id !== $user->id) {
            abort(403);
        }
        
        // Déterminer qui est l'autre participant
        $otherUser = $booking->user_id === $user->id ? $booking->listing->user : $booking->user;
        
        return view('messages.contact-booking', compact('booking', 'otherUser'));
    }
} 