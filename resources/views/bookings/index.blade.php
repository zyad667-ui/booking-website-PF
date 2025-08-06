<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Réservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header avec bouton d'ajout -->
            <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 mb-8 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Gestion des Réservations</h1>
                        <p class="text-gray-600 mt-1">{{ $bookings->count() }} réservation(s) trouvée(s)</p>
                    </div>
                    @if(auth()->user()->hasRole('client'))
                        <a href="{{ route('bookings.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Nouvelle Réservation
                        </a>
                    @endif
                </div>
            </div>

            <!-- Liste des réservations -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($bookings as $booking)
                    <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 overflow-hidden">
                        <!-- Image placeholder -->
                        <div class="h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3a1 1 0 00-1-1H7a1 1 0 00-1 1v9m12 4h-4m4 0v-4a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0H7m0 0v-4a1 1 0 011-1h4a1 1 0 011 1v4"></path>
                            </svg>
                        </div>

                        <!-- Contenu -->
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $booking->listing->titre }}</h3>
                                <span class="px-2 py-1 text-xs font-medium rounded-full 
                                    @if($booking->statut === 'confirmee') bg-green-100 text-green-800
                                    @elseif($booking->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                    @elseif($booking->statut === 'annulee') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($booking->statut) }}
                                </span>
                            </div>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Du {{ \Carbon\Carbon::parse($booking->date_debut)->format('d/m/Y') }}
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Au {{ \Carbon\Carbon::parse($booking->date_fin)->format('d/m/Y') }}
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $booking->listing->adresse }}
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-primary-600">{{ number_format($booking->prix_total, 2) }}€</span>
                                
                                <div class="flex space-x-2">
                                    <a href="{{ route('bookings.show', $booking) }}" class="text-primary-600 hover:text-primary-700 text-sm font-medium">
                                        Voir
                                    </a>
                                    @if(auth()->user()->hasRole('admin') || auth()->user()->id === $booking->user_id)
                                        <a href="{{ route('bookings.edit', $booking) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                            Modifier
                                        </a>
                                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-8 text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3a1 1 0 00-1-1H7a1 1 0 00-1 1v9m12 4h-4m4 0v-4a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0H7m0 0v-4a1 1 0 011-1h4a1 1 0 011 1v4"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune réservation trouvée</h3>
                            <p class="text-gray-600">Il n'y a pas encore de réservations disponibles.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout> 