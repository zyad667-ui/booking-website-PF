<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la Réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header avec actions -->
            <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 mb-8 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Réservation #{{ $booking->id }}</h1>
                        <p class="text-gray-600 mt-1">{{ $booking->listing->titre }}</p>
                    </div>
                    <div class="flex space-x-3">
                        @if(auth()->user()->hasRole('admin') || auth()->user()->id === $booking->user_id)
                            <a href="{{ route('bookings.edit', $booking) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Modifier
                            </a>
                        @endif
                        <a href="{{ route('bookings.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Retour
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Informations principales -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Image placeholder -->
                    <div class="bg-gradient-to-br from-green-100 to-green-200 rounded-2xl h-64 flex items-center justify-center">
                        <svg class="w-24 h-24 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3a1 1 0 00-1-1H7a1 1 0 00-1 1v9m12 4h-4m4 0v-4a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0H7m0 0v-4a1 1 0 011-1h4a1 1 0 011 1v4"></path>
                        </svg>
                    </div>

                    <!-- Informations de la réservation -->
                    <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations de la réservation</h3>
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <span class="text-sm text-gray-500">Date d'arrivée</span>
                                        <div class="font-medium">{{ \Carbon\Carbon::parse($booking->date_debut)->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <div>
                                        <span class="text-sm text-gray-500">Date de départ</span>
                                        <div class="font-medium">{{ \Carbon\Carbon::parse($booking->date_fin)->format('d/m/Y') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <span class="text-sm text-gray-500">Adresse</span>
                                    <div class="font-medium">{{ $booking->listing->adresse }}</div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <div>
                                    <span class="text-sm text-gray-500">Client</span>
                                    <div class="font-medium">{{ $booking->user->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations du logement -->
                    <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations du logement</h3>
                        <div class="space-y-4">
                            <div>
                                <span class="text-sm text-gray-500">Titre</span>
                                <div class="font-medium">{{ $booking->listing->titre }}</div>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Description</span>
                                <div class="text-gray-700 mt-1">{{ Str::limit($booking->listing->description, 200) }}</div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-sm text-gray-500">Prix par nuit</span>
                                    <div class="font-medium">{{ number_format($booking->listing->prix, 2) }}€</div>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-500">Propriétaire</span>
                                    <div class="font-medium">{{ $booking->listing->user->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Statut et prix -->
                    <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Statut</h3>
                            <span class="px-3 py-1 text-sm font-medium rounded-full 
                                @if($booking->statut === 'confirmee') bg-green-100 text-green-800
                                @elseif($booking->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                @elseif($booking->statut === 'annulee') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($booking->statut) }}
                            </span>
                        </div>
                        <div class="text-3xl font-bold text-primary-600 mb-2">
                            {{ number_format($booking->prix_total, 2) }}€
                        </div>
                        <p class="text-gray-600 text-sm">Total du séjour</p>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                        <div class="space-y-3">
                            @if(auth()->user()->id === $booking->user_id)
                                @if(!$booking->payment || !$booking->payment->isSuccessful())
                                    <a href="{{ route('payments.create', $booking) }}" 
                                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        Payer maintenant
                                    </a>
                                @else
                                    <div class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-100 text-green-800 rounded-lg">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Paiement effectué
                                    </div>
                                @endif
                            @endif
                            
                            @if(auth()->user()->hasRole('admin') || auth()->user()->id === $booking->user_id)
                                <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                                            onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Annuler
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('listings.show', $booking->listing) }}" 
                               class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Voir le logement
                            </a>
                        </div>
                    </div>

                    <!-- Calcul du séjour -->
                    <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Calcul du séjour</h3>
                        <div class="space-y-3">
                            @php
                                $debut = \Carbon\Carbon::parse($booking->date_debut);
                                $fin = \Carbon\Carbon::parse($booking->date_fin);
                                $nuits = $debut->diffInDays($fin);
                            @endphp
                            <div class="flex justify-between">
                                <span class="text-gray-600">Prix par nuit</span>
                                <span class="font-medium">{{ number_format($booking->listing->prix, 2) }}€</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Nombre de nuits</span>
                                <span class="font-medium">{{ $nuits }}</span>
                            </div>
                            <div class="border-t pt-2">
                                <div class="flex justify-between font-semibold">
                                    <span>Total</span>
                                    <span>{{ number_format($booking->prix_total, 2) }}€</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 