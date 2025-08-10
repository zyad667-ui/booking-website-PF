<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Propriétés') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header avec recherche et filtres -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8 p-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Découvrez nos propriétés</h1>
                        <p class="text-gray-600 mt-2">{{ $listings->count() }} propriété(s) trouvée(s)</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Barre de recherche -->
                        <div class="relative">
                            <input type="text" placeholder="Rechercher une propriété..." 
                                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <!-- Filtres -->
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option>Tous les statuts</option>
                            <option>Publié</option>
                            <option>En attente</option>
                            <option>Refusé</option>
                        </select>
                        @if(auth()->user()->hasRole('host') || auth()->user()->hasRole('admin'))
                            <a href="{{ route('listings.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Nouvelle propriété
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Grille des propriétés -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($listings as $listing)
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition group">
                        <!-- Image de la propriété -->
                        <div class="h-48 relative overflow-hidden">
                            @php
                                // Générer une image basée sur le type de propriété ou utiliser une image par défaut
                                $imageUrl = '';
                                $propertyType = strtolower($listing->type ?? 'maison');
                                
                                // Images statiques pour différents types de propriétés
                                $propertyImages = [
                                    'maison' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
                                    'appartement' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2035&q=80',
                                    'villa' => 'https://images.unsplash.com/photo-1613977257363-707ba9348227?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
                                    'riad' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
                                    'dar' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
                                    'studio' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80',
                                ];
                                
                                // Utiliser l'image correspondante au type ou une image par défaut
                                $imageUrl = $propertyImages[$propertyType] ?? $propertyImages['maison'];
                            @endphp
                            
                            <img src="{{ $imageUrl }}" 
                                 alt="{{ $listing->titre }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            
                            <!-- Badge de statut -->
                            <div class="absolute top-3 right-3">
                                <span class="px-3 py-1 rounded-full text-xs font-medium
                                    @if($listing->statut === 'publie') bg-green-100 text-green-800
                                    @elseif($listing->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ ucfirst($listing->statut) }}
                                </span>
                            </div>
                            
                            <!-- Badge de type de propriété -->
                            <div class="absolute top-3 left-3">
                                <span class="px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ ucfirst($propertyType) }}
                                </span>
                            </div>
                            
                            <!-- Overlay au survol -->
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a href="{{ route('listings.show', $listing) }}" 
                                       class="bg-white text-gray-900 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition">
                                        Voir détails
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contenu de la carte -->
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-blue-600 transition">
                                {{ Str::limit($listing->titre, 30) }}
                            </h3>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($listing->adresse, 40) }}</p>
                            
                            <!-- Informations supplémentaires -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $listing->user->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $listing->bookings->count() }} réservation(s)
                                </div>
                            </div>
                            
                            <!-- Prix et actions -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold text-blue-600">{{ number_format($listing->prix, 2) }}€</span>
                                    <span class="text-gray-500 text-sm">/nuit</span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('listings.show', $listing) }}" 
                                       class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                                        Voir
                                    </a>
                                    @if(auth()->user()->hasRole('admin') || auth()->user()->id === $listing->user_id)
                                        <a href="{{ route('listings.edit', $listing) }}" 
                                           class="text-gray-600 hover:text-gray-700 text-sm font-medium">
                                            Modifier
                                        </a>
                                    @else
                                        <!-- Boutons pour les clients -->
                                        <a href="{{ route('messages.contact.listing', $listing) }}" 
                                           class="text-gray-600 hover:text-gray-700 text-sm font-medium border border-gray-300 px-2 py-1 rounded">
                                            Contacter
                                        </a>
                                        <a href="{{ route('bookings.create') }}?listing_id={{ $listing->id }}" 
                                           class="bg-blue-600 text-white px-2 py-1 rounded text-sm font-medium hover:bg-blue-700 transition">
                                            Réserver
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Aucune propriété trouvée</h3>
                            <p class="text-gray-600">Il n'y a pas encore de propriétés dans le système.</p>
                            @if(auth()->user()->hasRole('host') || auth()->user()->hasRole('admin'))
                                <a href="{{ route('listings.create') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Ajouter une propriété
                                </a>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($listings->hasPages())
                <div class="mt-8">
                    {{ $listings->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout> 