<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @if($conversations->count() > 0)
                        <div class="space-y-4">
                            @foreach($conversations as $conversation)
                                @php
                                    // Récupérer les participants de la conversation
                                    $participants = $conversation->getParticipants();
                                    $currentUser = auth()->user();
                                    
                                    // Trouver l'autre participant (pas l'utilisateur actuel)
                                    $otherParticipant = null;
                                    foreach($participants as $participant) {
                                        if ($participant->id !== $currentUser->id) {
                                            $otherParticipant = $participant;
                                            break;
                                        }
                                    }
                                    
                                    // Récupérer le dernier message
                                    $lastMessage = $conversation->getLastMessage();
                                    
                                    // Compter les messages non lus
                                    $unreadCount = $conversation->unreadCount($currentUser);
                                @endphp
                                
                                @if($otherParticipant)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <a href="{{ route('messages.show', $conversation->id) }}" class="block">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center space-x-3">
                                                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                                    {{ substr($otherParticipant->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">
                                                        {{ $otherParticipant->name }}
                                                    </h3>
                                                    @if($lastMessage)
                                                        <p class="text-sm text-gray-600 dark:text-gray-400 truncate">
                                                            {{ Str::limit($lastMessage->body, 50) }}
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                @if($lastMessage)
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $lastMessage->created_at->diffForHumans() }}
                                                    </p>
                                                @endif
                                                @if($unreadCount > 0)
                                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
                                                        {{ $unreadCount }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Aucune conversation</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Commencez une conversation en contactant un hôte ou un client.
                            </p>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 