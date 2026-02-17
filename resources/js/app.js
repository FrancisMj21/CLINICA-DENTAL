import { Calendar } from '@fullcalendar/core'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import esLocale from '@fullcalendar/core/locales/es'
import 'bootstrap'


document.addEventListener('DOMContentLoaded', function () {

    let calendarEl = document.getElementById('calendar');
    if (!calendarEl) return;

    let calendar = new Calendar(calendarEl, {
        plugins: [
            dayGridPlugin,
            timeGridPlugin,
            interactionPlugin
        ],

        locale: esLocale,
        initialView: 'timeGridWeek',
        height: 650,
        headerToolbar: false,
        selectable: true,
        events: window.calendarEvents || [],


        selectable: false,
        selectMirror: false,

        dateClick: function(info) {

            let end = new Date(info.date);
            end.setMinutes(end.getMinutes() + 30);
            let year = end.getFullYear();
            let month = String(end.getMonth() + 1).padStart(2, '0');
            let day = String(end.getDate()).padStart(2, '0');
            let hours = String(end.getHours()).padStart(2, '0');
            let minutes = String(end.getMinutes()).padStart(2, '0');
            let seconds = "00";

            document.getElementById('start_time').value =
    `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

            document.getElementById('end_time').value =
                `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

            let modalElement = document.getElementById('appointmentModal');
            let modal = new bootstrap.Modal(modalElement);
            modal.show();
        },

        datesSet: function(info) {
            let range = document.getElementById('dateRange');
            if (range) {
                range.innerText = info.view.title;
            }
        }
    });

    calendar.render();

    // Navegación
    document.getElementById('prevBtn')?.addEventListener('click', () => calendar.prev());
    document.getElementById('nextBtn')?.addEventListener('click', () => calendar.next());
    document.getElementById('todayBtn')?.addEventListener('click', () => calendar.today());

    document.querySelectorAll('.view-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            calendar.changeView(this.dataset.view);
        });
    });

});
