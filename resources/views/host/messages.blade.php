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
                            Conversations
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
                                    'user' => 'Jean Dupont',
                                    'last_message' => 'Bonjour, votre propriété est-elle disponible pour le week-end ?',
                                    'time' => 'Il y a 2h',
                                    'unread' => true,
                                    'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
                                ],
                                [
                                    'id' => 2,
                                    'user' => 'Marie Martin',
                                    'last_message' => 'Merci pour votre réponse rapide !',
                                    'time' => 'Il y a 1j',
                                    'unread' => false,
                                    'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
                                ],
                                [
                                    'id' => 3,
                                    'user' => 'Pierre Durand',
                                    'last_message' => 'Pouvez-vous me donner plus d\'informations sur les équipements ?',
                                    'time' => 'Il y a 3j',
                                    'unread' => false,
                                    'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80'
                                ]
                            ];
                        @endphp

                        @foreach($conversations as $conversation)
                        <div class="flex items-center p-4 border border-gray-200 dark:border-gray-700 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors cursor-pointer">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" src="{{ $conversation['avatar'] }}" alt="{{ $conversation['user'] }}">
                            </div>
                            <div class="ml-4 flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100 truncate">
                                        {{ $conversation['user'] }}
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $conversation['time'] }}
                                    </p>
                                </div>
                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
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
                                        Cette page affichera bientôt vos vraies conversations avec les clients. 
                                        Le système de messagerie en temps réel est en cours de développement.
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
