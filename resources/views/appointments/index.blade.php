@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body d-flex justify-content-between align-items-center flex-wrap">

            <!-- IZQUIERDA -->
            <div class="d-flex align-items-center gap-2">

                <!-- Flecha izquierda -->
                <button id="prevBtn" class="btn btn-light border">
                    ⬅
                </button>

                <!-- Icono calendario -->
                <button id="miniCalendarBtn" class="btn btn-light border">
                    📅
                </button>

                <!-- Flecha derecha -->
                <button id="nextBtn" class="btn btn-light border">
                    ➡
                </button>

                <!-- Hoy -->
                <button id="todayBtn" class="btn btn-outline-primary">
                    Hoy
                </button>

                <!-- Rango de fecha -->
                <span id="dateRange"
                      class="fw-semibold ms-2">
                </span>

            </div>


            <!-- DERECHA -->
            <div class="d-flex align-items-center gap-2">

                <!-- Semana -->
                <button class="btn btn-light border view-btn"
                        data-view="timeGridWeek">
                    S
                </button>

                <!-- Día -->
                <button class="btn btn-light border view-btn"
                        data-view="timeGridDay">
                    D
                </button>

                <!-- Dropdown Mes / Doctor -->
                <div class="dropdown">
                    <button class="btn btn-light border dropdown-toggle"
                            data-bs-toggle="dropdown">
                        ▼
                    </button>

                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item change-view"
                               data-view="dayGridMonth">
                                Por Mes
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item">
                                Por Doctor
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Vista Calendario -->
                <button id="calendarViewBtn"
                        class="btn btn-primary">
                    🗓
                </button>

                <!-- Vista Tabla -->
                <button id="tableViewBtn"
                        class="btn btn-light border">
                    📋
                </button>

                <button id="settingsBtn"
                        class="btn btn-light border d-flex align-items-center justify-content-center material-btn"
                        title="Configuración">
                    <span class="material-icons">tune</span>
                </button>

            </div>

        </div>
    </div>


    <!-- Calendario -->
    <div id="calendar" class="bg-white p-3 rounded shadow-sm"></div>

    <!-- Vista Tabla -->
    <div id="tableView"
         class="d-none mt-3">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <p class="text-muted mb-0">
                    Aquí irá la agenda en formato tabla.
                </p>
            </div>
        </div>
    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    let reasonSelect = document.getElementById('reasonSelect');
    let durationSelect = document.getElementById('durationSelect');
    let durationHidden = document.getElementById('durationHidden');
    let startInput = document.getElementById('start_time');
    let endInput = document.getElementById('end_time');

    function calculateEnd(duration) {

        if (!startInput.value || !duration) return;

        let start = new Date(startInput.value);
        let end = new Date(start);

        end.setMinutes(end.getMinutes() + parseInt(duration));

        // Formato YYYY-MM-DD HH:MM:SS
        let year = end.getFullYear();
        let month = String(end.getMonth() + 1).padStart(2, '0');
        let day = String(end.getDate()).padStart(2, '0');
        let hours = String(end.getHours()).padStart(2, '0');
        let minutes = String(end.getMinutes()).padStart(2, '0');
        let seconds = "00";

        endInput.value = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        durationHidden.value = duration;
    }

    // Cuando cambia el motivo → carga duración por defecto
    reasonSelect.addEventListener('change', function () {

        let selected = reasonSelect.options[reasonSelect.selectedIndex];
        let defaultDuration = selected?.dataset?.duration;

        if (!defaultDuration) return;

        durationSelect.value = defaultDuration;
        calculateEnd(defaultDuration);
    });

    // Cuando cambia la duración manualmente
    durationSelect.addEventListener('change', function () {
        calculateEnd(durationSelect.value);
    });

});
</script>


<script>
    window.calendarEvents = @json($events);
</script>


@include('appointments.create')

@endsection
