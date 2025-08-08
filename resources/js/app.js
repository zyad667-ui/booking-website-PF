import './bootstrap';

import Alpine from 'alpinejs';

// FullCalendar imports
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import timeGridPlugin from '@fullcalendar/timegrid';

// Make FullCalendar globally available
window.Calendar = Calendar;
window.dayGridPlugin = dayGridPlugin;
window.interactionPlugin = interactionPlugin;
window.timeGridPlugin = timeGridPlugin;

window.Alpine = Alpine;

Alpine.start();
