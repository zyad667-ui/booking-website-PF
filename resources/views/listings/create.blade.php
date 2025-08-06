<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle Annonce') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-soft border border-neutral-200 p-8">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-gray-900">Créer une nouvelle annonce</h1>
                    <p class="text-gray-600 mt-2">Remplissez les informations de votre logement</p>
                </div>

                <form action="{{ route('listings.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Titre -->
                    <div>
                        <label for="titre" class="block text-sm font-medium text-gray-700 mb-2">
                            Titre de l'annonce *
                        </label>
                        <input type="text" 
                               name="titre" 
                               id="titre" 
                               value="{{ old('titre') }}"
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
                                  required>{{ old('description') }}</textarea>
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
                               value="{{ old('adresse') }}"
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
                                   value="{{ old('prix') }}"
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

                    <!-- Boutons -->
                    <div class="flex items-center justify-between pt-6">
                        <a href="{{ route('listings.index') }}" 
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
                            Créer l'annonce
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 