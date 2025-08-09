<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Créer une Annonce') }}
            </h2>
            <a href="{{ route('host.listings.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                ← Retour aux annonces
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- Informations de base -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Informations de base</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="titre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Titre de l'annonce *
                                    </label>
                                    <input type="text" name="titre" id="titre" required
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                           placeholder="Ex: Magnifique villa avec vue mer">
                                    @error('titre')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="prix" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Prix par nuit (€) *
                                    </label>
                                    <input type="number" name="prix" id="prix" required min="0" step="0.01"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                           placeholder="150">
                                    @error('prix')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="adresse" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Adresse complète *
                                </label>
                                <input type="text" name="adresse" id="adresse" required
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                       placeholder="123 Rue de la Plage, 75001 Paris, France">
                                @error('adresse')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Description</h3>
                            
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Description détaillée *
                                </label>
                                <textarea name="description" id="description" rows="6" required
                                          class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                          placeholder="Décrivez votre propriété, ses équipements, son emplacement..."></textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Caractéristiques -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Caractéristiques</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label for="capacite" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Capacité (personnes)
                                    </label>
                                    <input type="number" name="capacite" id="capacite" min="1"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                           placeholder="4">
                                </div>

                                <div>
                                    <label for="chambres" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Nombre de chambres
                                    </label>
                                    <input type="number" name="chambres" id="chambres" min="0"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                           placeholder="2">
                                </div>

                                <div>
                                    <label for="salles_bain" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Nombre de salles de bain
                                    </label>
                                    <input type="number" name="salles_bain" id="salles_bain" min="0"
                                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                           placeholder="1">
                                </div>
                            </div>

                            <!-- Équipements -->
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                    Équipements disponibles
                                </label>
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="equipements[]" value="wifi" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">WiFi</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="equipements[]" value="climatisation" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Climatisation</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="equipements[]" value="cuisine" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Cuisine</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="equipements[]" value="parking" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Parking</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="equipements[]" value="piscine" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Piscine</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="equipements[]" value="terrasse" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Terrasse</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="equipements[]" value="balcon" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Balcon</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="equipements[]" value="ascenseur" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Ascenseur</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Images -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Images</h3>
                            
                            <div>
                                <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Photos de votre propriété
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                            <label for="images" class="relative cursor-pointer bg-white dark:bg-gray-700 rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Télécharger des fichiers</span>
                                                <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*">
                                            </label>
                                            <p class="pl-1">ou glisser-déposer</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            PNG, JPG, GIF jusqu'à 10MB
                                        </p>
                                    </div>
                                </div>
                                @error('images')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Règles et conditions -->
                        <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Règles et conditions</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="regles" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Règles de la maison
                                    </label>
                                    <textarea name="regles" id="regles" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                              placeholder="Ex: Pas de fête, pas d'animaux, check-in à partir de 15h..."></textarea>
                                </div>

                                <div>
                                    <label for="conditions_annulation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Conditions d'annulation
                                    </label>
                                    <select name="conditions_annulation" id="conditions_annulation"
                                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100">
                                        <option value="flexible">Flexible - Remboursement complet jusqu'à 24h avant</option>
                                        <option value="modere">Modéré - Remboursement complet jusqu'à 5 jours avant</option>
                                        <option value="strict">Strict - Remboursement complet jusqu'à 7 jours avant</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="flex justify-end space-x-4">
                            <a href="{{ route('host.listings.index') }}" 
                               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded transition-colors">
                                Annuler
                            </a>
                            <button type="submit" 
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                Créer l'annonce
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout> 