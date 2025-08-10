<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Mes Favoris') }}
            </h2>
            <a href="{{ route('properties') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Découvrir plus
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Statistiques rapides -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total'] ?? 0 }}</div>
                            <div class="text-sm text-blue-600 dark:text-blue-400">Favoris</div>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stats['available'] ?? 0 }}</div>
                            <div class="text-sm text-green-600 dark:text-green-400">Disponibles</div>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ number_format($stats['avg_price'] ?? 0, 0, ',', ' ') }}€</div>
                            <div class="text-sm text-purple-600 dark:text-purple-400">Prix moyen</div>
                        </div>
                    </div>

                    <!-- Filtres -->
                    <div class="mb-6">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1">
                                <input type="text" placeholder="Rechercher dans mes favoris..." 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div class="flex gap-2">
                                <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Tous les prix</option>
                                    <option value="0-50">0-50€</option>
                                    <option value="50-100">50-100€</option>
                                    <option value="100-200">100-200€</option>
                                    <option value="200+">200€+</option>
                                </select>
                                <select class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Tous les types</option>
                                    <option value="appartement">Appartement</option>
                                    <option value="maison">Maison</option>
                                    <option value="villa">Villa</option>
                                    <option value="chalet">Chalet</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Grille des favoris -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse($favorites ?? [] as $favorite)
                        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                            <!-- Image de la propriété -->
                            <div class="relative h-48 bg-gray-200 dark:bg-gray-600">
                                @if($favorite->listing->images->count() > 0)
                                    <img class="w-full h-full object-cover" 
                                         src="{{ $favorite->listing->images->first()->url }}" 
                                         alt="{{ $favorite->listing->titre }}">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                <!-- Bouton favori -->
                                <div class="absolute top-2 right-2">
                                    <button class="bg-white bg-opacity-90 hover:bg-opacity-100 p-2 rounded-full shadow-md transition-all duration-200 transform hover:scale-110">
                                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Badge de disponibilité -->
                                <div class="absolute top-2 left-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Disponible
                                    </span>
                                </div>

                                <!-- Nombre d'images -->
                                @if($favorite->listing->images->count() > 1)
                                <div class="absolute bottom-2 left-2">
                                    <span class="bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                        +{{ $favorite->listing->images->count() - 1 }} photos
                                    </span>
                                </div>
                                @endif
                            </div>

                            <!-- Contenu de la propriété -->
                            <div class="p-4">
                                <div class="flex items-start justify-between mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $favorite->listing->titre }}
                                    </h3>
                                </div>
                                
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                    {{ $favorite->listing->adresse }}
                                </p>

                                <!-- Caractéristiques -->
                                <div class="flex items-center space-x-4 mb-4 text-sm text-gray-500 dark:text-gray-400">
                                    @if($favorite->listing->capacite)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        {{ $favorite->listing->capacite }} personnes
                                    </div>
                                    @endif
                                    @if($favorite->listing->chambres)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"></path>
                                        </svg>
                                        {{ $favorite->listing->chambres }} chambres
                                    </div>
                                    @endif
                                    @if($favorite->listing->salles_bain)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"></path>
                                        </svg>
                                        {{ $favorite->listing->salles_bain }} SDB
                                    </div>
                                    @endif
                                </div>

                                <!-- Équipements -->
                                @if($favorite->listing->equipements)
                                <div class="flex flex-wrap gap-1 mb-4">
                                    @foreach(json_decode($favorite->listing->equipements) as $equipement)
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ ucfirst($equipement) }}
                                    </span>
                                    @endforeach
                                </div>
                                @endif

                                <!-- Prix et actions -->
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                            {{ number_format($favorite->listing->prix, 0, ',', ' ') }}€
                                        </span>
                                        <span class="text-gray-500 dark:text-gray-400">/nuit</span>
                                    </div>
                                    <div class="flex space-x-2">
                                        <a href="{{ route('listings.show', $favorite->listing->id) }}" 
                                           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">
                                            Voir
                                        </a>
                                        <a href="{{ route('bookings.create', ['listing_id' => $favorite->listing->id]) }}" 
                                           class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded text-sm font-medium transition-colors">
                                            Réserver
                                        </a>
                                    </div>
                                </div>

                                <!-- Date d'ajout aux favoris -->
                                <div class="mt-3 pt-3 border-t border-gray-200 dark:border-gray-600">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Ajouté le {{ $favorite->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Aucun favori</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Commencez par ajouter des propriétés à vos favoris.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('properties') }}" 
                                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                    Découvrir des propriétés
                                </a>
                            </div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if(isset($favorites) && method_exists($favorites, 'hasPages') && $favorites->hasPages())
                    <div class="mt-6">
                        {{ $favorites->links() }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout> 