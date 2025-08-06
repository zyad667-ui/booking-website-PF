<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier l\'Annonce') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-8">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Modifier l'annonce</h1>
                    <p class="text-gray-600 mt-2">Modifiez les informations de votre logement</p>
                </div>

                <form action="{{ route('listings.update', $listing) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Titre -->
                    <div>
                        <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">
                            Titre de l'annonce *
                        </label>
                        <input type="text" 
                               name="titre" 
                               id="titre" 
                               value="{{ old('titre', $listing->titre) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                               placeholder="Ex: Appartement cosy centre-ville"
                               required>
                        @error('titre')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description *
                        </label>
                        <textarea name="description" 
                                  id="description" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                  placeholder="Décrivez votre logement, ses avantages, équipements..."
                                  required>{{ old('description', $listing->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Adresse -->
                    <div>
                        <label for="adresse" class="block text-sm font-medium text-gray-700 mb-2">
                            Adresse *
                        </label>
                        <input type="text" 
                               name="adresse" 
                               id="adresse" 
                               value="{{ old('adresse', $listing->adresse) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                               placeholder="Ex: 12 rue de la Paix, Paris"
                               required>
                        @error('adresse')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Prix -->
                    <div>
                        <label for="prix" class="block text-sm font-medium text-gray-700 mb-2">
                            Prix par nuit (€) *
                        </label>
                        <div class="relative">
                            <input type="number" 
                                   name="prix" 
                                   id="prix" 
                                   value="{{ old('prix', $listing->prix) }}"
                                   min="0"
                                   step="0.01"
                                   class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                   placeholder="0.00"
                                   required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                        </div>
                        @error('prix')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Statut (admin seulement) -->
                    @if(auth()->user()->hasRole('admin'))
                        <div>
                            <label for="statut" class="block text-sm font-medium text-gray-700 mb-2">
                                Statut *
                            </label>
                            <select name="statut" 
                                    id="statut" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    required>
                                <option value="en_attente" {{ old('statut', $listing->statut) === 'en_attente' ? 'selected' : '' }}>
                                    En attente
                                </option>
                                <option value="publie" {{ old('statut', $listing->statut) === 'publie' ? 'selected' : '' }}>
                                    Publié
                                </option>
                                <option value="refuse" {{ old('statut', $listing->statut) === 'refuse' ? 'selected' : '' }}>
                                    Refusé
                                </option>
                            </select>
                            @error('statut')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    <!-- Informations supplémentaires -->
                    <div class="bg-blue-50 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Informations importantes</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li>Les modifications seront visibles immédiatement</li>
                                        <li>Le statut ne peut être modifié que par un administrateur</li>
                                        <li>Les réservations existantes ne seront pas affectées</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="flex items-center justify-between pt-6">
                        <a href="{{ route('listings.show', $listing) }}" 
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
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 