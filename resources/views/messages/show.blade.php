<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Conversation') }}
            </h2>
            <a href="{{ route('messages.index') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                ← Retour aux messages
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- En-tête de la conversation -->
                    @php
                        $otherParticipant = $conversation->getParticipantFromConversation(auth()->user());
                    @endphp
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4 mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-semibold">
                                {{ substr($otherParticipant->name, 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">{{ $otherParticipant->name }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $otherParticipant->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Messages -->
                    <div class="space-y-4 mb-6" id="messages-container">
                        @foreach($messages as $message)
                            <div class="flex {{ $message->sender->id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg {{ $message->sender->id === auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' }}">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <span class="text-xs opacity-75">{{ $message->sender->name }}</span>
                                        <span class="text-xs opacity-75">{{ $message->created_at->format('H:i') }}</span>
                                    </div>
                                    <p class="text-sm">{{ $message->body }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Formulaire d'envoi -->
                    <form action="{{ route('messages.send', $conversation->id) }}" method="POST" class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        @csrf
                        <div class="flex space-x-4">
                            <div class="flex-1">
                                <textarea 
                                    name="message" 
                                    rows="3" 
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-100"
                                    placeholder="Tapez votre message..."
                                    required
                                ></textarea>
                            </div>
                            <div class="flex items-end">
                                <button 
                                    type="submit" 
                                    class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                                >
                                    Envoyer
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto-scroll vers le bas
        function scrollToBottom() {
            const container = document.getElementById('messages-container');
            container.scrollTop = container.scrollHeight;
        }
        
        // Scroll au chargement
        document.addEventListener('DOMContentLoaded', function() {
            scrollToBottom();
        });
        
        // Marquer comme lu
        fetch('{{ route("messages.read", $conversation->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
    </script>
    @endpush
</x-app-layout> 