<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propriétés - PlaceZo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-gray-900">PlaceZo</a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="/" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Accueil</a>
                        <a href="#" class="text-blue-600 hover:text-blue-700 px-3 py-2 rounded-md text-sm font-medium">Propriétés</a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">À propos</a>
                        <a href="#" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Inscription</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-6">
                    Découvrez nos propriétés
                </h1>
                <p class="text-xl mb-8 text-blue-100">
                    Trouvez le logement parfait pour votre séjour
                </p>
                
                <!-- Barre de recherche -->
                <div class="max-w-3xl mx-auto">
                    <div class="bg-white rounded-2xl p-2 shadow-2xl">
                        <div class="flex flex-col md:flex-row gap-2">
                            <div class="flex-1">
                                <input type="text" placeholder="Où voulez-vous aller ?" 
                                       class="w-full px-6 py-4 text-gray-900 placeholder-gray-500 focus:outline-none">
                            </div>
                            <div class="flex-1">
                                <input type="date" placeholder="Arrivée" 
                                       class="w-full px-6 py-4 text-gray-900 focus:outline-none">
                            </div>
                            <div class="flex-1">
                                <input type="date" placeholder="Départ" 
                                       class="w-full px-6 py-4 text-gray-900 focus:outline-none">
                            </div>
                            <button class="bg-blue-600 text-white px-8 py-4 rounded-xl hover:bg-blue-700 transition font-semibold">
                                Rechercher
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filtres et tri -->
    <section class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Trier par</option>
                        <option>Prix croissant</option>
                        <option>Prix décroissant</option>
                        <option>Plus récent</option>
                        <option>Plus populaire</option>
                    </select>
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Prix</option>
                        <option>0€ - 50€</option>
                        <option>50€ - 100€</option>
                        <option>100€ - 200€</option>
                        <option>200€+</option>
                    </select>
                </div>
                <div class="text-gray-600">
                    {{ $listings->count() }} propriété(s) trouvée(s)
                </div>
            </div>
        </div>
    </section>

    <!-- Grille des propriétés -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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
                            @if($listing->statut === 'publie')
                                <div class="absolute top-3 right-3">
                                    <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Disponible
                                    </span>
                                </div>
                            @endif
                            
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
                                        Voir détails
                                    </a>
                                    @auth
                                        <a href="{{ route('messages.contact.listing', $listing) }}" 
                                           class="text-gray-600 hover:text-gray-700 text-sm font-medium border border-gray-300 px-3 py-1 rounded">
                                            Contacter
                                        </a>
                                        <a href="{{ route('bookings.create') }}?listing_id={{ $listing->id }}" 
                                           class="bg-blue-600 text-white px-3 py-1 rounded text-sm font-medium hover:bg-blue-700 transition">
                                            Réserver
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" 
                                           class="bg-blue-600 text-white px-3 py-1 rounded text-sm font-medium hover:bg-blue-700 transition">
                                            Se connecter
                                        </a>
                                    @endauth
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
                            <p class="text-gray-600">Il n'y a pas encore de propriétés disponibles.</p>
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
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4">PlaceZo</h3>
                    <p class="text-gray-400">Trouvez votre logement de rêve parmi des milliers de propriétés uniques.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Découvrir</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Propriétés</a></li>
                        <li><a href="#" class="hover:text-white transition">Destinations</a></li>
                        <li><a href="#" class="hover:text-white transition">Expériences</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Centre d'aide</a></li>
                        <li><a href="#" class="hover:text-white transition">Contact</a></li>
                        <li><a href="#" class="hover:text-white transition">Sécurité</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Légal</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Conditions</a></li>
                        <li><a href="#" class="hover:text-white transition">Confidentialité</a></li>
                        <li><a href="#" class="hover:text-white transition">Cookies</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 PlaceZo. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html> 