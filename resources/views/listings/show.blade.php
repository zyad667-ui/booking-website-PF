<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Détails de la propriété') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Breadcrumb -->
            <div class="mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('listings.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                Propriétés
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $listing->titre }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- Image principale avec overlay -->
            <div class="relative mb-8">
                <div class="w-full h-96 bg-gradient-to-br from-blue-500 via-purple-600 to-pink-500 rounded-3xl relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-32 h-32 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    
                    <!-- Badge de statut -->
                    <div class="absolute top-6 right-6">
                        <span class="px-4 py-2 bg-white/90 backdrop-blur-sm text-gray-900 rounded-full text-sm font-semibold">
                            {{ ucfirst($listing->statut) }}
                        </span>
                    </div>
                    
                    <!-- Informations rapides -->
                    <div class="absolute bottom-6 left-6 right-6">
                        <div class="flex items-center justify-between text-white">
                            <div>
                                <h1 class="text-3xl font-bold mb-2">{{ $listing->titre }}</h1>
                                <p class="text-lg opacity-90">{{ $listing->adresse }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-3xl font-bold">€{{ number_format($listing->prix, 2) }}</div>
                                <div class="text-sm opacity-75">par nuit</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contenu principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Informations détaillées -->
                <div class="lg:col-span-2">
                    <!-- Section description -->
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8 mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">À propos de ce logement</h2>
                        <p class="text-gray-700 leading-relaxed mb-6">{{ $listing->description }}</p>
                        
                        <!-- Caractéristiques -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                                <div>
                                    <div class="font-semibold text-gray-900">4 voyageurs</div>
                                    <div class="text-sm text-gray-500">Capacité</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v2H8V5z"></path>
                                </svg>
                                <div>
                                    <div class="font-semibold text-gray-900">2 chambres</div>
                                    <div class="text-sm text-gray-500">Chambres</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <svg class="w-6 h-6 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <div>
                                    <div class="font-semibold text-gray-900">Flexible</div>
                                    <div class="text-sm text-gray-500">Annulation</div>
                                </div>
                            </div>
                            
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <svg class="w-6 h-6 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                                </svg>
                                <div>
                                    <div class="font-semibold text-gray-900">4.9</div>
                                    <div class="text-sm text-gray-500">Note</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section hôte -->
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8 mb-8">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">Votre hôte</h2>
                            <div class="flex items-center space-x-2">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-lg">{{ strtoupper(substr($listing->user->name, 0, 2)) }}</span>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $listing->user->name }}</div>
                                    <div class="text-sm text-gray-500">Membre depuis {{ $listing->user->created_at->format('M Y') }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="text-center p-4 bg-gray-50 rounded-xl">
                                <div class="text-2xl font-bold text-gray-900">4.9</div>
                                <div class="text-sm text-gray-500">Note moyenne</div>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-xl">
                                <div class="text-2xl font-bold text-gray-900">98%</div>
                                <div class="text-sm text-gray-500">Taux de réponse</div>
                            </div>
                            <div class="text-center p-4 bg-gray-50 rounded-xl">
                                <div class="text-2xl font-bold text-gray-900">1h</div>
                                <div class="text-sm text-gray-500">Temps de réponse</div>
                            </div>
                        </div>
                    </div>

                    <!-- Section avis -->
                    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-8">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Avis des voyageurs</h2>
                        
                        @if($listing->bookings->count() > 0)
                            <div class="space-y-6">
                                @foreach($listing->bookings->take(3) as $booking)
                                    <div class="border-b border-gray-200 pb-6 last:border-b-0">
                                        <div class="flex items-center justify-between mb-3">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center mr-3">
                                                    <span class="text-white font-bold text-sm">{{ strtoupper(substr($booking->user->name, 0, 2)) }}</span>
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-gray-900">{{ $booking->user->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $booking->created_at->format('M Y') }}</div>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <div class="flex text-yellow-400">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <svg class="w-5 h-5 {{ $i <= 4 ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.922-.755 1.688-1.538 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.783.57-1.838-.197-1.538-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <p class="text-gray-700">"Excellent séjour ! Le logement était parfait et l'hôte très accueillant. Je recommande vivement."</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <p class="text-gray-500">Aucun avis pour le moment</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Sidebar réservation -->
                <div class="lg:col-span-1">
                    <div class="sticky top-8">
                        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 p-6">
                            <div class="text-center mb-6">
                                <div class="text-3xl font-bold text-gray-900 mb-2">€{{ number_format($listing->prix, 2) }}</div>
                                <div class="text-gray-500">par nuit</div>
                            </div>

                            <!-- Formulaire de réservation -->
                            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Dates</label>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <input type="date" name="date_arrivee" required
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <input type="date" name="date_depart" required
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Voyageurs</label>
                                    <select name="nombre_voyageurs" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">Sélectionner</option>
                                        <option value="1">1 voyageur</option>
                                        <option value="2">2 voyageurs</option>
                                        <option value="3">3 voyageurs</option>
                                        <option value="4">4 voyageurs</option>
                                    </select>
                                </div>

                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-4 rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                                    Réserver maintenant
                                </button>
                            </form>

                            <!-- Informations supplémentaires -->
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <div class="flex items-center justify-between text-sm mb-2">
                                    <span class="text-gray-600">Prix par nuit</span>
                                    <span class="font-medium">€{{ number_format($listing->prix, 2) }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm mb-2">
                                    <span class="text-gray-600">Frais de service</span>
                                    <span class="font-medium">€{{ number_format($listing->prix * 0.10, 2) }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm font-semibold pt-2 border-t border-gray-200">
                                    <span>Total</span>
                                    <span>€{{ number_format($listing->prix * 1.10, 2) }}</span>
                                </div>
                            </div>

                            <!-- Actions rapides -->
                            <div class="mt-6 space-y-3">
                                <button class="w-full bg-gray-100 text-gray-700 py-3 rounded-xl font-medium hover:bg-gray-200 transition-colors duration-300">
                                    Contacter l'hôte
                                </button>
                                <button class="w-full bg-gray-100 text-gray-700 py-3 rounded-xl font-medium hover:bg-gray-200 transition-colors duration-300">
                                    Partager
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 