<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle Réservation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-8">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Créer une nouvelle réservation</h1>
                    <p class="text-gray-600 mt-2">Sélectionnez un logement et vos dates de séjour</p>
                </div>

                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Sélection de l'annonce -->
                    <div>
                        <label for="listing_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Choisir un logement *
                        </label>
                        <select name="listing_id" 
                                id="listing_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                required>
                            <option value="">Sélectionnez un logement</option>
                            @foreach($listings as $listing)
                                <option value="{{ $listing->id }}" 
                                        data-prix="{{ $listing->prix }}"
                                        {{ old('listing_id') == $listing->id ? 'selected' : '' }}>
                                    {{ $listing->titre }} - {{ $listing->adresse }} ({{ number_format($listing->prix, 2) }}€/nuit)
                                </option>
                            @endforeach
                        </select>
                        @error('listing_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date de début -->
                    <div>
                        <label for="date_debut" class="block text-sm font-medium text-gray-700 mb-2">
                            Date d'arrivée *
                        </label>
                        <input type="date" 
                               name="date_debut" 
                               id="date_debut" 
                               value="{{ old('date_debut') }}"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                               required>
                        @error('date_debut')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date de fin -->
                    <div>
                        <label for="date_fin" class="block text-sm font-medium text-gray-700 mb-2">
                            Date de départ *
                        </label>
                        <input type="date" 
                               name="date_fin" 
                               id="date_fin" 
                               value="{{ old('date_fin') }}"
                               min="{{ date('Y-m-d', strtotime('+2 days')) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                               required>
                        @error('date_fin')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Calcul automatique du prix -->
                    <div id="prix-calcul" class="hidden">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Calcul du prix</h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Prix par nuit :</span>
                                    <span id="prix-nuit">0.00€</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Nombre de nuits :</span>
                                    <span id="nombre-nuits">0</span>
                                </div>
                                <div class="border-t pt-2">
                                    <div class="flex justify-between font-semibold">
                                        <span>Total :</span>
                                        <span id="prix-total">0.00€</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="flex items-center justify-between pt-6">
                        <a href="{{ route('bookings.index') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Annuler
                        </a>
                        
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Créer la réservation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Calcul automatique du prix
        function calculerPrix() {
            const listingSelect = document.getElementById('listing_id');
            const dateDebut = document.getElementById('date_debut');
            const dateFin = document.getElementById('date_fin');
            const prixCalcul = document.getElementById('prix-calcul');
            const prixNuit = document.getElementById('prix-nuit');
            const nombreNuits = document.getElementById('nombre-nuits');
            const prixTotal = document.getElementById('prix-total');

            if (listingSelect.value && dateDebut.value && dateFin.value) {
                const selectedOption = listingSelect.options[listingSelect.selectedIndex];
                const prix = parseFloat(selectedOption.dataset.prix);
                const debut = new Date(dateDebut.value);
                const fin = new Date(dateFin.value);
                const nuits = Math.ceil((fin - debut) / (1000 * 60 * 60 * 24));

                if (nuits > 0) {
                    prixNuit.textContent = prix.toFixed(2) + '€';
                    nombreNuits.textContent = nuits;
                    prixTotal.textContent = (prix * nuits).toFixed(2) + '€';
                    prixCalcul.classList.remove('hidden');
                }
            } else {
                prixCalcul.classList.add('hidden');
            }
        }

        // Événements
        document.getElementById('listing_id').addEventListener('change', calculerPrix);
        document.getElementById('date_debut').addEventListener('change', calculerPrix);
        document.getElementById('date_fin').addEventListener('change', calculerPrix);
    </script>
</x-app-layout> 