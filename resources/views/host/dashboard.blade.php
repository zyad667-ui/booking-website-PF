<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Hôte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- En-tête avec informations utilisateur -->
            <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 mb-8 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Bienvenue, {{ auth()->user()->name }} !</h1>
                        <p class="text-gray-600 mt-1">Rôles : {{ $roles->implode(', ') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">Dernière connexion</p>
                        <p class="text-sm font-medium text-gray-900">{{ auth()->user()->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Statistiques principales -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Mes annonces -->
                <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Mes annonces</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_listings'] }}</p>
                            <p class="text-xs text-green-600">{{ $stats['published_listings'] }} publiées</p>
                        </div>
                    </div>
                </div>

                <!-- Annonces en attente -->
                <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">En attente</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_listings'] }}</p>
                            <p class="text-xs text-yellow-600">En cours de validation</p>
                        </div>
                    </div>
                </div>

                <!-- Réservations reçues -->
                <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3a1 1 0 00-1-1H7a1 1 0 00-1 1v9m12 4h-4m4 0v-4a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0H7m0 0v-4a1 1 0 011-1h4a1 1 0 011 1v4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Réservations</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_bookings'] }}</p>
                            <p class="text-xs text-green-600">{{ $stats['confirmed_bookings'] }} confirmées</p>
                        </div>
                    </div>
                </div>

                <!-- Revenus (placeholder) -->
                <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Revenus</p>
                            <p class="text-2xl font-bold text-gray-900">0€</p>
                            <p class="text-xs text-blue-600">Ce mois</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions rapides -->
            <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 mb-8 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <a href="{{ route('listings.create') }}" class="flex items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition">
                        <svg class="w-6 h-6 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="font-medium text-green-900">Nouvelle annonce</span>
                    </a>
                    <a href="{{ route('listings.index') }}" class="flex items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                        <svg class="w-6 h-6 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span class="font-medium text-blue-900">Gérer mes annonces</span>
                    </a>
                    <a href="{{ route('bookings.index') }}" class="flex items-center p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                        <svg class="w-6 h-6 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3a1 1 0 00-1-1H7a1 1 0 00-1 1v9m12 4h-4m4 0v-4a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0H7m0 0v-4a1 1 0 011-1h4a1 1 0 011 1v4"></path>
                        </svg>
                        <span class="font-medium text-purple-900">Voir les réservations</span>
                    </a>
                </div>
            </div>

            <!-- Activité récente -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Mes annonces récentes -->
                <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Mes annonces récentes</h3>
                    <div class="space-y-3">
                        @forelse($stats['recent_listings'] as $listing)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-lg bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ Str::limit($listing->titre, 25) }}</p>
                                    <p class="text-xs text-gray-500">{{ number_format($listing->prix, 2) }}€/nuit</p>
                                </div>
                                <div class="text-xs">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        @if($listing->statut === 'publie') bg-green-100 text-green-800
                                        @elseif($listing->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($listing->statut) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Aucune annonce récente</p>
                        @endforelse
                    </div>
                </div>

                <!-- Réservations récentes -->
                <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Réservations récentes</h3>
                    <div class="space-y-3">
                        @forelse($stats['recent_bookings'] as $booking)
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-lg bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17l4 4 4-4m0-5V3a1 1 0 00-1-1H7a1 1 0 00-1 1v9m12 4h-4m4 0v-4a1 1 0 00-1-1h-4a1 1 0 00-1 1v4m0 0H7m0 0v-4a1 1 0 011-1h4a1 1 0 011 1v4"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-3 flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ Str::limit($booking->listing->titre, 20) }}</p>
                                    <p class="text-xs text-gray-500">{{ $booking->user->name }}</p>
                                </div>
                                <div class="text-xs">
                                    <span class="px-2 py-1 rounded-full text-xs font-medium
                                        @if($booking->statut === 'confirmee') bg-green-100 text-green-800
                                        @elseif($booking->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                        @elseif($booking->statut === 'annulee') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($booking->statut) }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">Aucune réservation récente</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>