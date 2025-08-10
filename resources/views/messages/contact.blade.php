<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacter l\'hôte') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <!-- Informations sur la propriété -->
                    <div class="mb-8">
                        <div class="flex items-start space-x-4">
                            <!-- Image de la propriété -->
                            <div class="flex-shrink-0">
                                @if($listing->images->count() > 0)
                                    <img src="{{ asset('storage/' . $listing->images->first()->chemin) }}" 
                                         alt="{{ $listing->titre }}"
                                         class="w-24 h-24 object-cover rounded-lg">
                                @else
                                    <div class="w-24 h-24 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Détails de la propriété -->
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $listing->titre }}</h3>
                                <p class="text-gray-600">{{ $listing->adresse }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ number_format($listing->prix, 2) }}€ par nuit</p>
                            </div>
                        </div>
                    </div>

                    <!-- Informations sur l'hôte -->
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                        <h4 class="font-medium text-gray-900 mb-2">Votre hôte</h4>
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-semibold text-lg">
                                    {{ strtoupper(substr($listing->user->name, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $listing->user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $listing->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulaire de contact -->
                    <div>
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Envoyer un message</h4>
                        
                        <form action="{{ route('messages.create') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="recipient_id" value="{{ $listing->user_id }}">
                            <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                            
                            <!-- Sujet -->
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                    Sujet
                                </label>
                                <input type="text" 
                                       name="subject" 
                                       id="subject" 
                                       value="Demande d'information - {{ $listing->titre }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       required>
                                @error('subject')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Message -->
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                    Message
                                </label>
                                <textarea name="message" 
                                          id="message" 
                                          rows="6" 
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                          placeholder="Bonjour, je suis intéressé(e) par votre propriété..."
                                          required>{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Boutons -->
                            <div class="flex items-center justify-between pt-6">
                                <a href="{{ route('listings.show', $listing) }}" 
                                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Retour à la propriété
                                </a>
                                
                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Envoyer le message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
