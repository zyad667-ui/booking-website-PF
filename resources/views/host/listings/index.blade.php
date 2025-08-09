<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mes Annonces') }}
            </h2>
            <a href="{{ route('host.listings.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Nouvelle Annonce
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
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stats['published'] ?? 0 }}</div>
                            <div class="text-sm text-green-600 dark:text-green-400">Publiées</div>
                        </div>
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $stats['pending'] ?? 0 }}</div>
                            <div class="text-sm text-yellow-600 dark:text-yellow-400">En attente</div>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $stats['revenue'] ?? 0 }}€</div>
                            <div class="text-sm text-purple-600 dark:text-purple-400">Revenus</div>
                        </div>
                    </div>

                    <!-- Filtres -->
                    <div class="mb-6">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <input type="text" placeholder="Rechercher une annonce..." 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex gap-2">
                                <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Tous les statuts</option>
                                    <option value="publie">Publié</option>
                                    <option value="en_attente">En attente</option>
                                    <option value="rejete">Rejeté</option>
                                    <option value="suspendu">Suspendu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Grille des annonces -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($listings ?? [] as $listing)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <!-- Image de l'annonce -->
                            <div class="relative h-48 bg-gray-200 dark:bg-gray-600">
                                @if($listing->images->count() > 0)
                                    <img class="w-full h-full object-cover" 
                                         src="{{ $listing->images->first()->url }}" 
                                         alt="{{ $listing->titre }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Badge de statut -->
                                <div class="absolute top-2 right-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($listing->statut === 'publie') bg-green-100 text-green-800
                                        @elseif($listing->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                        @elseif($listing->statut === 'rejete') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        @switch($listing->statut)
                                            @case('publie')
                                                Publié
                                                @break
                                            @case('en_attente')
                                                En attente
                                                @break
                                            @case('rejete')
                                                Rejeté
                                                @break
                                            @case('suspendu')
                                                Suspendu
                                                @break
                                            @default
                                                {{ ucfirst($listing->statut) }}
                                        @endswitch
                                    </span>
                                </div>

                                <!-- Nombre d'images -->
                                @if($listing->images->count() > 1)
                                <div class="absolute bottom-2 left-2">
                                    <span class="bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                        +{{ $listing->images->count() - 1 }} photos
                                    </span>
                                </div>
                                @endif
                            </div>

                            <!-- Contenu de l'annonce -->
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                    {{ $listing->titre }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                    {{ $listing->adresse }}
                                </p>

                                <!-- Statistiques -->
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                        <span>{{ $listing->bookings_count ?? 0 }} réservations</span>
                                        <span>{{ $listing->reviews_count ?? 0 }} avis</span>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                            {{ number_format($listing->prix, 0, ',', ' ') }}€
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">/nuit</div>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('listings.show', $listing->id) }}" 
                                       class="flex-1 bg-blue-500 hover:bg-blue-600 text-white text-center py-2 px-4 rounded text-sm font-medium transition-colors">
                                        Voir
                                    </a>
                                    <a href="{{ route('listings.edit', $listing->id) }}" 
                                       class="flex-1 bg-gray-500 hover:bg-gray-600 text-white text-center py-2 px-4 rounded text-sm font-medium transition-colors">
                                        Modifier
                                    </a>
                                    <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-3 rounded text-sm font-medium transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Aucune annonce</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Commencez par créer votre première annonce.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('host.listings.create') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Créer une annonce
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if(isset($listings) && $listings->hasPages())
                    <div class="mt-6">
                        {{ $listings->links() }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout> 