<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Gestion des Réservations') }}
            </h2>
            <div class="flex space-x-2">
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Export CSV
                </button>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Rapport
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Filtres et recherche -->
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
                                <input type="date" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <input type="date" class="px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- Statistiques rapides -->
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
                        <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total'] ?? 0 }}</div>
                            <div class="text-sm text-blue-600 dark:text-blue-400">Total</div>
                        </div>
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $stats['pending'] ?? 0 }}</div>
                            <div class="text-sm text-yellow-600 dark:text-yellow-400">En attente</div>
                        </div>
                        <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stats['confirmed'] ?? 0 }}</div>
                            <div class="text-sm text-green-600 dark:text-green-400">Confirmées</div>
                        </div>
                        <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $stats['cancelled'] ?? 0 }}</div>
                            <div class="text-sm text-red-600 dark:text-red-400">Annulées</div>
                        </div>
                        <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ number_format($stats['revenue'] ?? 0, 0, ',', ' ') }}€</div>
                            <div class="text-sm text-purple-600 dark:text-purple-400">Revenus</div>
                        </div>
                    </div>

                    <!-- Tableau des réservations -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Réservation
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Client
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Propriété
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Dates
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Montant
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Statut
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Paiement
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse($bookings ?? [] as $booking)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            #{{ $booking->id }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $booking->created_at->format('d/m/Y H:i') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                <div class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center">
                                                    <span class="text-white text-xs font-semibold">{{ substr($booking->user->name, 0, 1) }}</span>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                    {{ $booking->user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                                    {{ $booking->user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $booking->listing->titre }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $booking->listing->adresse }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-gray-100">
                                            {{ \Carbon\Carbon::parse($booking->date_debut)->format('d/m/Y') }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            → {{ \Carbon\Carbon::parse($booking->date_fin)->format('d/m/Y') }}
                                        </div>
                                        <div class="text-xs text-gray-400">
                                            {{ \Carbon\Carbon::parse($booking->date_debut)->diffInDays($booking->date_fin) }} nuits
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        <span class="font-semibold">{{ number_format($booking->prix_total, 0, ',', ' ') }}€</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($booking->payment)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($booking->payment->statut === 'paye') bg-green-100 text-green-800
                                                @elseif($booking->payment->statut === 'en_attente') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst($booking->payment->statut) }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-sm">Non payé</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.bookings.show', $booking->id) }}" 
                                               class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                                Voir
                                            </a>
                                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                                Modifier
                                            </a>
                                            @if($booking->statut === 'en_attente')
                                                <button class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                                    Confirmer
                                                </button>
                                            @endif
                                            <button class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                                Annuler
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                        Aucune réservation trouvée
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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