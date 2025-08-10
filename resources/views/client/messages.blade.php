<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Messages') }}
            </h2>
            <a href="{{ route('home') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Retour à l'accueil
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            Conversations avec les hôtes
                        </h3>
                        <div class="flex space-x-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                                En ligne
                            </span>
                        </div>
                    </div>

                    <!-- Liste des conversations -->
                    <div class="space-y-4">
                        @php
                            // Simuler des conversations pour l'exemple
                            $conversations = [
                                [
                                    'id' => 1,
                                    'host' => 'Ahmed & Fatima',
                                    'property' => 'Riad Traditionnel - Marrakech',
                                    'last_message' => 'Bonjour ! Votre réservation a été confirmée. Nous vous attendons !',
                                    'time' => 'Il y a 1h',
                                    'unread' => true,
                                    'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
                                ],
                                [
                                    'id' => 2,
                                    'host' => 'Karim & Leila',
                                    'property' => 'Villa avec Vue Océan - Agadir',
                                    'last_message' => 'Merci pour votre message. La villa sera parfaitement préparée.',
                                    'time' => 'Il y a 2j',
                                    'unread' => false,
                                    'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
                                ],
                                [
                                    'id' => 3,
                                    'host' => 'Hassan & Amina',
                                    'property' => 'Maison Historique - Fès',
                                    'last_message' => 'Nous avons bien reçu votre demande. Réponse dans la journée.',
                                    'time' => 'Il y a 3j',
                                    'unread' => false,
                                    'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
                                ]
                            ];
                        @endphp

                        @foreach($conversations as $conversation)
                        <div class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" src="{{ $conversation['avatar'] }}" alt="{{ $conversation['host'] }}">
                            </div>
                            <div class="ml-4 flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                            {{ $conversation['host'] }}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                            {{ $conversation['property'] }}
                                        </p>
                                    </div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $conversation['time'] }}
                                    </p>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate mt-1">
                                    {{ $conversation['last_message'] }}
                                </p>
                            </div>
                            @if($conversation['unread'])
                            <div class="ml-4 flex-shrink-0">
                                <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-blue-600 text-xs font-medium text-white">
                                    1
                                </span>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <!-- Actions rapides -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-blue-50 dark:bg-blue-900 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                        Nouveau message
                                    </h3>
                                    <p class="text-sm text-blue-600 dark:text-blue-300">
                                        Contacter un hôte
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-green-800 dark:text-green-200">
                                        Réservations confirmées
                                    </h3>
                                    <p class="text-sm text-green-600 dark:text-green-300">
                                        Voir vos séjours
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 dark:bg-purple-900 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-purple-800 dark:text-purple-200">
                                        Favoris
                                    </h3>
                                    <p class="text-sm text-purple-600 dark:text-purple-300">
                                        Propriétés sauvegardées
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message d'information -->
                    <div class="mt-8 p-4 bg-blue-50 dark:bg-blue-900 border border-blue-200 dark:border-blue-700 rounded-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                    Système de messagerie
                                </h3>
                                <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                                    <p>
                                        Communiquez directement avec vos hôtes pour toute question concernant vos réservations. 
                                        Les messages sont sécurisés et privés.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
