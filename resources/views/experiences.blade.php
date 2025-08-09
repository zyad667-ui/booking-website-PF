<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expériences - PlaceZo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }

        .gradient-text {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 50%, #1e40af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hover-lift {
            transition: all 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.25);
        }

        .property-card {
            transition: all 0.3s ease;
        }

        .property-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .image-overlay {
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
        }

        .filter-btn {
            transition: all 0.3s ease;
        }

        .filter-btn.active {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
        }
    </style>
</head>

<body class="font-['Inter'] bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <h1 class="text-2xl font-bold gradient-text">PlaceZo</h1>
                        <div class="ml-2 w-2 h-2 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full floating"></div>
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">Accueil</a>
                    <a href="{{ route('experiences') }}" class="text-blue-600 font-medium">Expériences</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">À propos</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">Contact</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-all duration-300 font-medium">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition-colors duration-300 font-medium">Connexion</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4 py-2 rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium">
                            Rejoindre
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="fade-in-up">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    Découvrez nos <span class="gradient-text bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Expériences</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto">
                    Des logements extraordinaires qui racontent une histoire unique
                </p>
                
                <!-- Search Bar -->
                <div class="max-w-4xl mx-auto">
                    <form action="{{ route('listings.search') }}" method="GET" class="flex flex-col lg:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" name="q" placeholder="Où souhaitez-vous voyager ?" 
                                   class="w-full px-6 py-4 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex-1">
                            <input type="date" name="date_debut" placeholder="Arrivée"
                                   class="w-full px-6 py-4 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="flex-1">
                            <input type="date" name="date_fin" placeholder="Départ"
                                   class="w-full px-6 py-4 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <button type="submit" class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-8 py-4 rounded-xl hover:from-yellow-500 hover:to-orange-600 transition-all duration-300 font-semibold text-lg">
                            Explorer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="bg-white py-8 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700 font-medium">Filtres:</span>
                    <button class="filter-btn active px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:border-blue-500">
                        Tous
                    </button>
                    <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:border-blue-500">
                        Maroc
                    </button>
                    <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:border-blue-500">
                        Villas
                    </button>
                    <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:border-blue-500">
                        Appartements
                    </button>
                    <button class="filter-btn px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:border-blue-500">
                        Maisons
                    </button>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-700">{{ $experiences->total() }} propriétés trouvées</span>
                    <select class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Prix: Croissant</option>
                        <option>Prix: Décroissant</option>
                        <option>Note: Plus haute</option>
                        <option>Note: Plus basse</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Properties Grid -->
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($experiences as $listing)
                <div class="property-card bg-white rounded-2xl overflow-hidden shadow-lg" data-type="{{ $listing->type ?? 'maison' }}" data-location="{{ strtolower($listing->pays ?? 'france') }}">
                    <div class="relative">
                        @php
                            // Images par défaut selon le type de propriété
                            $defaultImages = [
                                'villa' => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                'appartement' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                'maison' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                'riad' => 'https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                'chalet' => 'https://images.unsplash.com/photo-1600607687644-c7171b42498b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                'loft' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                                'default' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                            ];
                            $propertyType = $listing->type ?? 'maison';
                            $imageUrl = $defaultImages[$propertyType] ?? $defaultImages['default'];
                        @endphp
                        <img src="{{ $imageUrl }}" 
                             alt="{{ $listing->titre ?? 'Propriété Exceptionnelle' }}" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-500 text-white">
                                Disponible
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <div class="flex items-center bg-black/50 rounded-full px-3 py-1">
                                <span class="text-yellow-400 text-sm">★★★★★</span>
                                <span class="text-white text-sm ml-1">{{ rand(45, 50) / 10 }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $listing->titre ?? 'Propriété Exceptionnelle' }}</h3>
                        <p class="text-gray-600 mb-4">{{ $listing->adresse ?? 'Localisation Premium' }}</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $listing->user->name ?? 'Hôte Premium' }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $listing->capacite ?? 4 }} voyageurs
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-gray-900">€{{ $listing->prix ?? 150 }}</span>
                                <span class="text-gray-500">/nuit</span>
                            </div>
                            <a href="{{ route('listings.show', $listing) }}" 
                               class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium">
                                Voir détails
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <!-- Propriétés du Maroc avec vraies images -->
                @foreach($moroccanProperties as $index => $property)
                <div class="property-card bg-white rounded-2xl overflow-hidden shadow-lg" data-type="{{ $property['type'] }}" data-location="maroc">
                    <div class="relative">
                        <img src="{{ $property['image_url'] }}" 
                             alt="{{ $property['image_alt'] }}" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-500 text-white">
                                Disponible
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <div class="flex items-center bg-black/50 rounded-full px-3 py-1">
                                <span class="text-yellow-400 text-sm">★★★★★</span>
                                <span class="text-white text-sm ml-1">{{ $property['rating'] }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $property['title'] }}</h3>
                        <p class="text-gray-600 mb-4">{{ $property['location'] }}</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $property['hosts'] }}
                            </div>
                            <div class="text-sm text-gray-500">
                                {{ $property['guests'] }} voyageurs
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-gray-900">€{{ $property['price'] }}</span>
                                <span class="text-gray-500">/nuit</span>
                            </div>
                            <button class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium">
                                Voir détails
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- Propriétés non-marocaines pour tester les filtres -->
                <div class="property-card bg-white rounded-2xl overflow-hidden shadow-lg" data-type="villa" data-location="france">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Villa Provence" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-500 text-white">
                                Disponible
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <div class="flex items-center bg-black/50 rounded-full px-3 py-1">
                                <span class="text-yellow-400 text-sm">★★★★★</span>
                                <span class="text-white text-sm ml-1">4.8</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Villa Provençale</h3>
                        <p class="text-gray-600 mb-4">Luberon, Provence, France</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Pierre & Marie
                            </div>
                            <div class="text-sm text-gray-500">
                                6 voyageurs
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-gray-900">€200</span>
                                <span class="text-gray-500">/nuit</span>
                            </div>
                            <button class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium">
                                Voir détails
                            </button>
                        </div>
                    </div>
                </div>

                <div class="property-card bg-white rounded-2xl overflow-hidden shadow-lg" data-type="appartement" data-location="italie">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Appartement Rome" class="w-full h-48 object-cover">
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-500 text-white">
                                Disponible
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <div class="flex items-center bg-black/50 rounded-full px-3 py-1">
                                <span class="text-yellow-400 text-sm">★★★★★</span>
                                <span class="text-white text-sm ml-1">4.7</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Appartement Historique</h3>
                        <p class="text-gray-600 mb-4">Centre historique, Rome, Italie</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Marco & Sofia
                            </div>
                            <div class="text-sm text-gray-500">
                                4 voyageurs
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-gray-900">€150</span>
                                <span class="text-gray-500">/nuit</span>
                            </div>
                            <button class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium">
                                Voir détails
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Placeholder cards when no listings -->
                @for($i = 0; $i < 8; $i++)
                <div class="property-card bg-white rounded-2xl overflow-hidden shadow-lg">
                    <div class="relative">
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center">
                            <svg class="w-16 h-16 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-500 text-white">
                                Disponible
                            </span>
                        </div>
                        <div class="absolute bottom-4 left-4">
                            <div class="flex items-center bg-black/50 rounded-full px-3 py-1">
                                <span class="text-yellow-400 text-sm">★★★★★</span>
                                <span class="text-white text-sm ml-1">4.8</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Propriété Exceptionnelle</h3>
                        <p class="text-gray-600 mb-4">Localisation Premium</p>
                        
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Hôte Premium
                            </div>
                            <div class="text-sm text-gray-500">
                                4 voyageurs
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-gray-900">€150</span>
                                <span class="text-gray-500">/nuit</span>
                            </div>
                            <button class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 font-medium">
                                Voir détails
                            </button>
                        </div>
                    </div>
                </div>
                @endfor
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if($experiences->hasPages())
            <div class="mt-12 flex justify-center">
                <div class="flex items-center space-x-2">
                    @if($experiences->onFirstPage())
                        <span class="px-4 py-2 text-gray-400 cursor-not-allowed">Précédent</span>
                    @else
                        <a href="{{ $experiences->previousPageUrl() }}" class="px-4 py-2 text-blue-600 hover:text-blue-800">Précédent</a>
                    @endif
                    
                    @foreach($experiences->getUrlRange(1, $experiences->lastPage()) as $page => $url)
                        @if($page == $experiences->currentPage())
                            <span class="px-4 py-2 bg-blue-600 text-white rounded-lg">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 text-blue-600 hover:text-blue-800">{{ $page }}</a>
                        @endif
                    @endforeach
                    
                    @if($experiences->hasMorePages())
                        <a href="{{ $experiences->nextPageUrl() }}" class="px-4 py-2 text-blue-600 hover:text-blue-800">Suivant</a>
                    @else
                        <span class="px-4 py-2 text-gray-400 cursor-not-allowed">Suivant</span>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-6">
                        <h3 class="text-2xl font-bold gradient-text">PlaceZo</h3>
                        <div class="ml-2 w-2 h-2 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full floating"></div>
                    </div>
                    <p class="text-gray-300 leading-relaxed">
                        Découvrez des logements extraordinaires et vivez des expériences uniques partout dans le monde.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Explorer</h4>
                    <ul class="space-y-3 text-gray-300">
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Destinations</a></li>
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Expériences</a></li>
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Communauté</a></li>
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Support</h4>
                    <ul class="space-y-3 text-gray-300">
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Centre d'aide</a></li>
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Sécurité</a></li>
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Contact</a></li>
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Urgences</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-6">Légal</h4>
                    <ul class="space-y-3 text-gray-300">
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Conditions</a></li>
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Confidentialité</a></li>
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Cookies</a></li>
                        <li><a href="#" class="hover:text-blue-300 transition-colors duration-300">Accessibilité</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                <p class="text-gray-400">&copy; 2024 PlaceZo. Créé avec amour pour les voyageurs du monde entier.</p>
            </div>
        </div>
    </footer>

    <script>
        // Filter buttons functionality
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                // Get the filter text
                const filterText = this.textContent.trim();
                
                // Get all property cards
                const propertyCards = document.querySelectorAll('.property-card');
                
                // Show/hide cards based on filter
                propertyCards.forEach(card => {
                    const cardType = card.getAttribute('data-type') || '';
                    const cardLocation = card.getAttribute('data-location') || '';
                    const cardTitle = card.querySelector('h3').textContent.toLowerCase();
                    const cardLocationText = card.querySelector('p').textContent.toLowerCase();
                    
                    if (filterText === 'Tous') {
                        // Show all cards
                        card.style.display = 'block';
                        card.style.animation = 'fadeInUp 0.6s ease-out';
                    } else if (filterText === 'Maroc') {
                        // Show only Moroccan properties
                        if (cardLocation === 'maroc' || cardLocationText.includes('maroc')) {
                            card.style.display = 'block';
                            card.style.animation = 'fadeInUp 0.6s ease-out';
                        } else {
                            card.style.display = 'none';
                        }
                    } else if (filterText === 'Villas') {
                        // Show only villas and riads
                        if (cardType === 'villa' || cardTitle.includes('villa') || cardTitle.includes('riad')) {
                            card.style.display = 'block';
                            card.style.animation = 'fadeInUp 0.6s ease-out';
                        } else {
                            card.style.display = 'none';
                        }
                    } else if (filterText === 'Appartements') {
                        // Show only apartments
                        if (cardType === 'appartement' || cardTitle.includes('appartement')) {
                            card.style.display = 'block';
                            card.style.animation = 'fadeInUp 0.6s ease-out';
                        } else {
                            card.style.display = 'none';
                        }
                    } else if (filterText === 'Maisons') {
                        // Show only houses (not villas or riads)
                        if (cardType === 'maison' || (cardTitle.includes('maison') && !cardTitle.includes('villa') && !cardTitle.includes('riad'))) {
                            card.style.display = 'block';
                            card.style.animation = 'fadeInUp 0.6s ease-out';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
                
                // Update the count
                updatePropertyCount();
            });
        });
        
        // Function to update property count
        function updatePropertyCount() {
            const visibleCards = document.querySelectorAll('.property-card[style*="display: block"], .property-card:not([style*="display: none"])');
            const countElement = document.querySelector('.text-gray-700');
            if (countElement) {
                countElement.textContent = `${visibleCards.length} propriétés trouvées`;
            }
        }
        
        // Initialize count on page load
        document.addEventListener('DOMContentLoaded', function() {
            updatePropertyCount();
        });

        // Animate cards on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-up');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.property-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>

</html>