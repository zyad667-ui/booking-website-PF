<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacter à propos de la réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Informations sur la réservation -->
                    <div class="mb-8">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-4">Réservation #{{ $booking->id }}</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start space-x-3">
                                    <!-- Image de la propriété -->
                                    <div class="flex-shrink-0">
                                        @if($booking->listing->images->count() > 0)
                                            <img src="{{ asset('storage/' . $booking->listing->images->first()->chemin) }}" 
                                                 alt="{{ $booking->listing->titre }}"
                                                 class="w-16 h-16 object-cover rounded-lg">
                                        @else
                                            <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Détails de la propriété -->
                                    <div class="flex-1 min-w-0">
                                        <h5 class="text-sm font-medium text-gray-900 truncate">{{ $booking->listing->titre }}</h5>
                                        <p class="text-sm text-gray-600">{{ $booking->listing->adresse }}</p>
                                        <p class="text-xs text-gray-500 mt-1">{{ number_format($booking->prix_total, 2) }}€ total</p>
                                    </div>
                                </div>
                                
                                <div class="space-y-2">
                                    <div class="flex items-center text-sm">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-gray-600">
                                            {{ \Carbon\Carbon::parse($booking->date_debut)->format('d/m/Y') }} - 
                                            {{ \Carbon\Carbon::parse($booking->date_fin)->format('d/m/Y') }}
                                        </span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-gray-600">
                                            {{ \Carbon\Carbon::parse($booking->date_debut)->diffInDays($booking->date_fin) }} nuit(s)
                                        </span>
                                    </div>
                                    <div class="flex items-center text-sm">
                                        @switch($booking->statut)
                                            @case('en_attente')
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    En attente
                                                </span>
                                                @break
                                            @case('confirmee')
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                    Confirmée
                                                </span>
                                                @break
                                            @case('annulee')
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Annulée
                                                </span>
                                                @break
                                            @case('terminee')
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Terminée
                                                </span>
                                                @break
                                        @endswitch
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations sur l'interlocuteur -->
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">
                            @if($booking->user_id === auth()->user()->id)
                                Contacter l'hôte
                            @else
                                Contacter le client
                            @endif
                        </h4>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-sm">
                                    {{ strtoupper(substr($otherUser->name, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $otherUser->name }}</p>
                                <p class="text-sm text-gray-500">{{ $otherUser->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire de message -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Envoyer un message</h4>
                        
                        <form action="{{ route('messages.create') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="recipient_id" value="{{ $otherUser->id }}">
                            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                            
                            <!-- Sujet -->
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                    Sujet
                                </label>
                                <input type="text" 
                                       name="subject" 
                                       id="subject" 
                                       value="Réservation #{{ $booking->id }} - {{ $booking->listing->titre }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       required>
                                @error('subject')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Message prédéfini selon le contexte -->
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                    Message
                                </label>
                                <textarea name="message" 
                                          id="message" 
                                          rows="6" 
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Votre message..."
                                          required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Messages prédéfinis -->
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h5 class="text-sm font-medium text-blue-900 mb-2">Messages rapides :</h5>
                                <div class="flex flex-wrap gap-2">
                                    @if($booking->user_id === auth()->user()->id)
                                        <!-- Messages du client vers l'hôte -->
                                        <button type="button" onclick="setMessage('Bonjour, j\'ai une question concernant ma réservation. Pouvez-vous me confirmer l\'heure d\'arrivée ?')" 
                                                class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition">
                                            Question sur l'arrivée
                                        </button>
                                        <button type="button" onclick="setMessage('Bonjour, est-il possible de modifier les dates de ma réservation ?')" 
                                                class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition">
                                            Modifier les dates
                                        </button>
                                        <button type="button" onclick="setMessage('Bonjour, j\'aimerais avoir plus d\'informations sur les équipements disponibles.')" 
                                                class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition">
                                            Équipements
                                        </button>
                                    @else
                                        <!-- Messages de l'hôte vers le client -->
                                        <button type="button" onclick="setMessage('Bonjour, votre réservation a été confirmée ! L\'arrivée se fait à partir de 15h. Avez-vous des questions ?')" 
                                                class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition">
                                            Confirmation
                                        </button>
                                        <button type="button" onclick="setMessage('Bonjour, voici les informations d\'accès à la propriété...')" 
                                                class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition">
                                            Infos d'accès
                                        </button>
                                        <button type="button" onclick="setMessage('Bonjour, j\'espère que votre séjour s\'est bien passé. N\'hésitez pas à laisser un avis !')" 
                                                class="text-xs px-3 py-1 bg-blue-100 text-blue-700 rounded-full hover:bg-blue-200 transition">
                                            Après séjour
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <!-- Boutons -->
                            <div class="flex items-center justify-between pt-6">
                                <a href="{{ route('bookings.show', $booking) }}" 
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Retour à la réservation
                                </a>
                                
                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Envoyer le message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setMessage(message) {
            document.getElementById('message').value = message;
        }
    </script>
</x-app-layout>
