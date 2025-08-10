<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Paiement - PlaceZo') }}
            </h2>
            <a href="{{ route('home') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Retour à l'accueil
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Finaliser votre réservation</h1>
                <p class="text-gray-600">Sécurisé par Stripe</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Payment Form -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Informations de paiement</h2>
                        
                        <!-- Booking Summary -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h3 class="font-semibold text-gray-900 mb-2">Résumé de la réservation</h3>
                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between">
                                    <span>Propriété:</span>
                                    <span class="font-medium">{{ $booking->listing->titre }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Dates:</span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($booking->date_debut)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($booking->date_fin)->format('d/m/Y') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Nuits:</span>
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($booking->date_debut)->diffInDays(\Carbon\Carbon::parse($booking->date_fin)) }} nuits</span>
                                </div>
                                <div class="flex justify-between text-lg font-semibold text-gray-900 pt-2 border-t">
                                    <span>Total:</span>
                                    <span>{{ number_format($booking->prix_total, 2) }} €</span>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method Selection -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Méthode de paiement</label>
                            <div class="space-y-3">
                                <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="payment_method" value="card" checked class="mr-3">
                                    <div class="flex items-center">
                                        <svg class="w-6 h-6 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        <span class="text-sm font-medium">Carte bancaire</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Stripe Card Element -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Détails de la carte</label>
                            <div id="card-element" class="p-4 border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500">
                                <!-- Stripe Elements will be inserted here -->
                            </div>
                            <div id="card-errors" class="mt-2 text-sm text-red-600 hidden"></div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mb-6">
                            <label class="flex items-start">
                                <input type="checkbox" id="terms" class="mt-1 mr-3 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-sm text-gray-600">
                                    J'accepte les <a href="#" class="text-blue-600 hover:underline">conditions générales</a> et la 
                                    <a href="#" class="text-blue-600 hover:underline">politique de confidentialité</a>
                                </span>
                            </label>
                        </div>

                        <!-- Payment Button -->
                        <button id="submit-payment" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 px-6 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span id="button-text">Payer {{ number_format($booking->prix_total, 2) }} €</span>
                            <span id="spinner" class="hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Traitement en cours...
                            </span>
                        </button>
                    </div>
                </div>

                <!-- Security Info -->
                <div class="space-y-6">
                    <!-- Security Badge -->
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Paiement sécurisé</h3>
                                <p class="text-sm text-gray-600">Protégé par Stripe</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">
                            Vos informations de paiement sont chiffrées et sécurisées. Nous ne stockons jamais vos données de carte bancaire.
                        </p>
                    </div>

                    <!-- Payment Methods -->
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Méthodes de paiement acceptées</h3>
                        <div class="flex space-x-4">
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <span class="ml-2 text-sm text-gray-600">Visa</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <span class="ml-2 text-sm text-gray-600">Mastercard</span>
                            </div>
                        </div>
                    </div>

                    <!-- Cancellation Policy -->
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Politique d'annulation</h3>
                        <div class="space-y-2 text-sm text-gray-600">
                            <div class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span>Annulation gratuite jusqu'à 24h avant l'arrivée</span>
                            </div>
                            <div class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span>Remboursement complet en cas d'annulation</span>
                            </div>
                            <div class="flex items-start">
                                <span class="text-green-500 mr-2">✓</span>
                                <span>Pas de frais cachés</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stripe Scripts -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Initialize Stripe
        const stripe = Stripe('{{ config("stripe.publishable_key") }}');
        const elements = stripe.elements();

        // Create card element
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#424770',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
                invalid: {
                    color: '#9e2146',
                },
            },
        });

        // Mount card element
        cardElement.mount('#card-element');

        // Handle real-time validation errors
        cardElement.on('change', function(event) {
            const displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
                displayError.classList.remove('hidden');
            } else {
                displayError.textContent = '';
                displayError.classList.add('hidden');
            }
        });

        // Handle form submission
        const submitButton = document.getElementById('submit-payment');
        const buttonText = document.getElementById('button-text');
        const spinner = document.getElementById('spinner');
        const termsCheckbox = document.getElementById('terms');

        submitButton.addEventListener('click', async function(event) {
            event.preventDefault();

            // Check terms acceptance
            if (!termsCheckbox.checked) {
                alert('Veuillez accepter les conditions générales.');
                return;
            }

            // Disable button and show spinner
            submitButton.disabled = true;
            buttonText.classList.add('hidden');
            spinner.classList.remove('hidden');

            try {
                // Create payment intent
                const response = await fetch('{{ route("payments.create-intent", $booking) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        amount: {{ $booking->prix_total }},
                    }),
                });

                const data = await response.json();

                if (!data.success) {
                    throw new Error(data.message || 'Failed to create payment intent');
                }

                // Confirm payment
                const { error, paymentIntent } = await stripe.confirmCardPayment(data.client_secret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: '{{ auth()->user()->name }}',
                            email: '{{ auth()->user()->email }}',
                        },
                    },
                });

                if (error) {
                    throw new Error(error.message);
                }

                // Send confirmation to server
                const confirmResponse = await fetch('{{ route("payments.confirm") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        payment_intent_id: paymentIntent.id,
                        payment_id: data.payment_id,
                    }),
                });

                const confirmData = await confirmResponse.json();

                if (confirmData.success) {
                    // Redirect to success page
                    window.location.href = confirmData.redirect_url;
                } else {
                    throw new Error(confirmData.message || 'Payment confirmation failed');
                }

            } catch (error) {
                console.error('Payment error:', error);
                
                // Show error message
                const displayError = document.getElementById('card-errors');
                displayError.textContent = error.message;
                displayError.classList.remove('hidden');

                // Re-enable button
                submitButton.disabled = false;
                buttonText.classList.remove('hidden');
                spinner.classList.add('hidden');
            }
        });
    </script>
</x-app-layout> 