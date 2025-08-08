@extends('layouts.app')

@section('title', 'Détails du paiement - PlaceZo')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Détails du paiement</h1>
                    <p class="text-gray-600">Paiement #{{ $payment->id }}</p>
                </div>
                <a href="{{ route('payments.history') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour à l'historique
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Payment Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Payment Status Card -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Statut du paiement</h2>
                        @switch($payment->statut)
                            @case('paye')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Payé
                                </span>
                                @break
                            @case('en_attente')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    En attente
                                </span>
                                @break
                            @case('echoue')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Échoué
                                </span>
                                @break
                            @case('rembourse')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Remboursé
                                </span>
                                @break
                            @default
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    {{ ucfirst($payment->statut) }}
                                </span>
                        @endswitch
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Montant</h3>
                            <p class="text-2xl font-bold text-gray-900">{{ number_format($payment->montant, 2) }} €</p>
                            <p class="text-sm text-gray-500">{{ strtoupper($payment->currency) }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Date de paiement</h3>
                            <p class="text-lg font-medium text-gray-900">{{ $payment->created_at->format('d/m/Y') }}</p>
                            <p class="text-sm text-gray-500">{{ $payment->created_at->format('H:i') }}</p>
                        </div>
                    </div>

                    @if($payment->description)
                        <div class="mt-6">
                            <h3 class="text-sm font-medium text-gray-500 mb-2">Description</h3>
                            <p class="text-gray-900">{{ $payment->description }}</p>
                        </div>
                    @endif
                </div>

                <!-- Booking Details -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Détails de la réservation</h2>
                    
                    @if($payment->booking)
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">{{ $payment->booking->listing->titre ?? 'N/A' }}</h3>
                                    <p class="text-sm text-gray-500">Réservation #{{ $payment->booking_id }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 mb-1">Date d'arrivée</h4>
                                    <p class="text-gray-900">{{ \Carbon\Carbon::parse($payment->booking->date_arrivee)->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 mb-1">Date de départ</h4>
                                    <p class="text-gray-900">{{ \Carbon\Carbon::parse($payment->booking->date_depart)->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 mb-1">Nombre de voyageurs</h4>
                                    <p class="text-gray-900">{{ $payment->booking->nombre_voyageurs }} personne(s)</p>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-gray-500 mb-1">Statut de la réservation</h4>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        {{ $payment->booking->statut === 'confirme' ? 'bg-green-100 text-green-800' : 
                                           ($payment->booking->statut === 'en_attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ ucfirst($payment->booking->statut) }}
                                    </span>
                                </div>
                            </div>

                            @if($payment->isSuccessful())
                                <div class="mt-6">
                                    <a href="{{ route('bookings.show', $payment->booking) }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                        Voir la réservation complète
                                    </a>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-gray-500">Aucune réservation associée à ce paiement.</p>
                    @endif
                </div>

                <!-- Stripe Details -->
                @if($payment->stripe_payment_intent_id)
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Informations Stripe</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-1">ID de paiement Stripe</h3>
                                <p class="text-sm font-mono text-gray-900 bg-gray-100 p-2 rounded">{{ $payment->stripe_payment_intent_id }}</p>
                            </div>
                            
                            @if($payment->stripe_id)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 mb-1">ID de charge Stripe</h3>
                                    <p class="text-sm font-mono text-gray-900 bg-gray-100 p-2 rounded">{{ $payment->stripe_id }}</p>
                                </div>
                            @endif

                            @if($payment->metadata)
                                <div>
                                    <h3 class="text-sm font-medium text-gray-500 mb-2">Métadonnées</h3>
                                    <div class="bg-gray-100 p-3 rounded">
                                        <pre class="text-xs text-gray-700">{{ json_encode($payment->metadata, JSON_PRETTY_PRINT) }}</pre>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Actions -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                    
                    <div class="space-y-3">
                        @if($payment->isSuccessful())
                            <form action="{{ route('payments.refund', $payment) }}" method="POST" class="inline-block w-full">
                                @csrf
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700"
                                        onclick="return confirm('Êtes-vous sûr de vouloir rembourser ce paiement ?')">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Demander un remboursement
                                </button>
                            </form>
                        @endif

                        @if($payment->isPending())
                            <form action="{{ route('payments.cancel', $payment) }}" method="POST" class="inline-block w-full">
                                @csrf
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"
                                        onclick="return confirm('Êtes-vous sûr de vouloir annuler ce paiement ?')">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Annuler le paiement
                                </button>
                            </form>
                        @endif

                        <a href="{{ route('payments.history') }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Voir l'historique
                        </a>
                    </div>
                </div>

                <!-- Support -->
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Besoin d'aide ?</h3>
                    <p class="text-sm text-gray-600 mb-4">
                        Si vous avez des questions concernant ce paiement, notre équipe est là pour vous aider.
                    </p>
                    <a href="#" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Contactez le support
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 