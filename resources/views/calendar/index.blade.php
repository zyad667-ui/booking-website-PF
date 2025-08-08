<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Calendrier des réservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <!-- Filtres -->
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-4 items-center">
                            <div>
                                <label for="listing-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Filtrer par propriété
                                </label>
                                <select id="listing-filter" class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                    <option value="">Toutes les propriétés</option>
                                    @foreach($listings as $listing)
                                        <option value="{{ $listing->id }}">{{ $listing->titre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="flex gap-2">
                                <button id="today-btn" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Aujourd'hui
                                </button>
                                <button id="prev-btn" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                                    Précédent
                                </button>
                                <button id="next-btn" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                                    Suivant
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Légende -->
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-4 text-sm">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-green-500 rounded mr-2"></div>
                                <span>Confirmée</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-yellow-500 rounded mr-2"></div>
                                <span>En attente</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-red-500 rounded mr-2"></div>
                                <span>Annulée</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-gray-500 rounded mr-2"></div>
                                <span>Terminée</span>
                            </div>
                        </div>
                    </div>

                    <!-- Calendrier -->
                    <div id="calendar" class="bg-white rounded-lg shadow"></div>

                    <!-- Modal pour les détails de réservation -->
                    <div id="booking-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
                        <div class="flex items-center justify-center min-h-screen">
                            <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold" id="modal-title">Détails de la réservation</h3>
                                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <div id="modal-content" class="space-y-4">
                                    <!-- Le contenu sera rempli par JavaScript -->
                                </div>
                                
                                <div class="flex justify-end gap-2 mt-6">
                                    <button onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                                        Fermer
                                    </button>
                                    <button id="confirm-booking-btn" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 hidden">
                                        Confirmer
                                    </button>
                                    <button id="cancel-booking-btn" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 hidden">
                                        Annuler
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let calendar;
            let currentBookingId = null;

            // Initialiser le calendrier
            function initCalendar() {
                const calendarEl = document.getElementById('calendar');
                
                calendar = new Calendar(calendarEl, {
                    plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin],
                    initialView: 'dayGridMonth',
                    locale: 'fr',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek'
                    },
                    selectable: true,
                    editable: false,
                    eventClick: function(info) {
                        showBookingDetails(info.event);
                    },
                    select: function(info) {
                        // Optionnel: permettre de bloquer des dates
                        console.log('Date sélectionnée:', info.startStr);
                    },
                    events: function(info, successCallback, failureCallback) {
                        const listingId = document.getElementById('listing-filter').value;
                        const url = '{{ route("host.calendar.events") }}' + (listingId ? `?listing_id=${listingId}` : '');
                        
                        fetch(url)
                            .then(response => response.json())
                            .then(data => {
                                successCallback(data);
                            })
                            .catch(error => {
                                console.error('Erreur lors du chargement des événements:', error);
                                failureCallback(error);
                            });
                    }
                });
                
                calendar.render();
            }

            // Afficher les détails d'une réservation
            function showBookingDetails(event) {
                const props = event.extendedProps;
                currentBookingId = event.id;
                
                document.getElementById('modal-title').textContent = props.listing;
                
                const content = `
                    <div class="space-y-3">
                        <div>
                            <strong>Client:</strong> ${props.client}
                        </div>
                        <div>
                            <strong>Statut:</strong> 
                            <span class="px-2 py-1 rounded text-xs ${getStatusClass(props.statut)}">
                                ${getStatusText(props.statut)}
                            </span>
                        </div>
                        <div>
                            <strong>Prix total:</strong> ${props.prix_total}€
                        </div>
                        <div>
                            <strong>Dates:</strong> ${event.startStr} - ${event.endStr}
                        </div>
                    </div>
                `;
                
                document.getElementById('modal-content').innerHTML = content;
                
                // Afficher/masquer les boutons selon le statut
                const confirmBtn = document.getElementById('confirm-booking-btn');
                const cancelBtn = document.getElementById('cancel-booking-btn');
                
                if (props.statut === 'en_attente') {
                    confirmBtn.classList.remove('hidden');
                    cancelBtn.classList.remove('hidden');
                } else {
                    confirmBtn.classList.add('hidden');
                    cancelBtn.classList.add('hidden');
                }
                
                document.getElementById('booking-modal').classList.remove('hidden');
            }

            // Fermer le modal
            window.closeModal = function() {
                document.getElementById('booking-modal').classList.add('hidden');
                currentBookingId = null;
            }

            // Confirmer une réservation
            document.getElementById('confirm-booking-btn').addEventListener('click', function() {
                updateBookingStatus('confirmee');
            });

            // Annuler une réservation
            document.getElementById('cancel-booking-btn').addEventListener('click', function() {
                updateBookingStatus('annulee');
            });

            // Mettre à jour le statut d'une réservation
            function updateBookingStatus(status) {
                if (!currentBookingId) return;
                
                fetch('{{ route("host.calendar.booking.status") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        booking_id: currentBookingId,
                        statut: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        calendar.refetchEvents();
                        closeModal();
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                });
            }

            // Filtre par propriété
            document.getElementById('listing-filter').addEventListener('change', function() {
                calendar.refetchEvents();
            });

            // Boutons de navigation
            document.getElementById('today-btn').addEventListener('click', function() {
                calendar.today();
            });

            document.getElementById('prev-btn').addEventListener('click', function() {
                calendar.prev();
            });

            document.getElementById('next-btn').addEventListener('click', function() {
                calendar.next();
            });

            // Utilitaires
            function getStatusClass(status) {
                const classes = {
                    'confirmee': 'bg-green-100 text-green-800',
                    'en_attente': 'bg-yellow-100 text-yellow-800',
                    'annulee': 'bg-red-100 text-red-800',
                    'terminee': 'bg-gray-100 text-gray-800'
                };
                return classes[status] || 'bg-gray-100 text-gray-800';
            }

            function getStatusText(status) {
                const texts = {
                    'confirmee': 'Confirmée',
                    'en_attente': 'En attente',
                    'annulee': 'Annulée',
                    'terminee': 'Terminée'
                };
                return texts[status] || status;
            }

            // Initialiser le calendrier
            initCalendar();
        });
    </script>
    @endpush
</x-app-layout> 