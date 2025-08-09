<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mes Réservations') }}
            </h2>
            <a href="{{ route('bookings.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Nouvelle Réservation
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Statistiques rapides -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total'] ?? 0 }}</div>
                            <div class="text-sm text-blue-600 dark:text-blue-400">Total</div>
                        </div>
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $stats['upcoming'] ?? 0 }}</div>
                            <div class="text-sm text-yellow-600 dark:text-yellow-400">À venir</div>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stats['completed'] ?? 0 }}</div>
                            <div class="text-sm text-green-600 dark:text-green-400">Terminées</div>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ number_format($stats['total_spent'] ?? 0, 0, ',', ' ') }}€</div>
                            <div class="text-sm text-purple-600 dark:text-purple-400">Total dépensé</div>
                        </div>
                    </div>

                    <!-- Filtres -->
                    <div class="mb-6">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <input type="text" placeholder="Rechercher une réservation..." 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex gap-2">
                                <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Tous les statuts</option>
                                    <option value="en_attente">En attente</option>
                                    <option value="confirmee">Confirmée</option>
                                    <option value="annulee">Annulée</option>
                                    <option value="terminee">Terminée</option>
                                </select>
                                <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Toutes les dates</option>
                                    <option value="upcoming">À venir</option>
                                    <option value="past">Passées</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Liste des réservations -->
                    <div class="space-y-6">
                        @forelse($bookings ?? [] as $booking)
                        <div class="bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                            <div class="p-6">
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                                    <!-- Informations de la réservation -->
                                    <div class="flex-1">
                                        <div class="flex items-start space-x-4">
                                            <!-- Image de la propriété -->
                                            <div class="flex-shrink-0">
                                                @if($booking->listing->images->count() > 0)
                                                    <img class="w-20 h-20 rounded-lg object-cover" 
                                                         src="{{ $booking->listing->images->first()->url }}" 
                                                         alt="{{ $booking->listing->titre }}">
                                                @else
                                                    <div class="w-20 h-20 rounded-lg bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Détails -->
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center justify-between">
                                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                        {{ $booking->listing->titre }}
                                                    </h3>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        @if($booking->statut === 'confirmee') bg-green-100 text-green-800
                                                        @elseif($booking->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                                        @elseif($booking->statut === 'annulee') bg-red-100 text-red-800
                                                        @elseif($booking->statut === 'terminee') bg-blue-100 text-blue-800
                                                        @else bg-gray-100 text-gray-800
                                                        @endif">
                                                        @switch($booking->statut)
                                                            @case('confirmee')
                                                                Confirmée
                                                                @break
                                                            @case('en_attente')
                                                                En attente
                                                                @break
                                                            @case('annulee')
                                                                Annulée
                                                                @break
                                                            @case('terminee')
                                                                Terminée
                                                                @break
                                                            @default
                                                                {{ ucfirst($booking->statut) }}
                                                        @endswitch
                                                    </span>
                                                </div>
                                                
                                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                                    {{ $booking->listing->adresse }}
                                                </p>
                                                
                                                <div class="flex items-center space-x-6 mt-3 text-sm text-gray-500 dark:text-gray-400">
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($booking->date_debut)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($booking->date_fin)->format('d/m/Y') }}
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        {{ \Carbon\Carbon::parse($booking->date_debut)->diffInDays($booking->date_fin) }} nuits
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                        {{ $booking->listing->user->name }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Prix et actions -->
                                    <div class="mt-4 lg:mt-0 lg:ml-6 flex flex-col items-end">
                                        <div class="text-right mb-4">
                                            <div class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                                {{ number_format($booking->prix_total, 0, ',', ' ') }}€
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ number_format($booking->listing->prix, 0, ',', ' ') }}€/nuit
                                            </div>
                                        </div>

                                        <div class="flex space-x-2">
                                            <a href="{{ route('bookings.show', $booking->id) }}" 
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">
                                                Voir détails
                                            </a>
                                            
                                            @if($booking->statut === 'en_attente')
                                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">
                                                    Annuler
                                                </button>
                                            @endif
                                            
                                            @if($booking->statut === 'confirmee' && !$booking->payment)
                                                <a href="{{ route('payments.create', $booking->id) }}" 
                                                   class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">
                                                    Payer
                                                </a>
                                            @endif
                                            
                                            @if($booking->statut === 'terminee')
                                                <button class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">
                                                    Laisser un avis
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Aucune réservation</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Commencez par réserver votre premier logement.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('bookings.create') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Réserver maintenant
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if(isset($bookings) && $bookings->hasPages())
                    <div class="mt-6">
                        {{ $bookings->links() }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout> 