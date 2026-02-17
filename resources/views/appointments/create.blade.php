<!-- Modal Crear Cita -->
<div class="modal fade" id="appointmentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Nueva Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('appointments.store') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <!-- Hidden start / end -->
                    <input type="hidden" id="start_time" name="start_time">
                    <input type="hidden" id="end_time" name="end_time">

                    <!-- Paciente -->
                    <div class="mb-3">
                        <label>Paciente</label>
                        <select name="patient_id" class="form-select" required>
                            <option value="">Seleccione paciente</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">
                                    {{ $patient->nombres }} {{ $patient->apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Doctor -->
                    <div class="mb-3">
                        <label>Doctor</label>
                        <select name="doctor_id" class="form-select" required>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">
                                    Dr. {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Motivo -->
                    <div class="mb-3">
                        <label>Motivo</label>
                        <select name="reason_id"
                                id="reasonSelect"
                                class="form-select"
                                required>
                            <option value="">Seleccione motivo</option>
                            @foreach($reasons as $reason)
                                <option value="{{ $reason->id }}"
                                        data-duration="{{ $reason->default_duration }}">
                                    {{ $reason->name }}
                                    ({{ $reason->default_duration }} min)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Duración -->
                    <div class="mb-3">
                        <label>Duración</label>
                        <select id="durationSelect" class="form-select" required>
                            @for($i = 30; $i <= 1440; $i += 30)
                                @php
                                    $hours = floor($i / 60);
                                    $minutes = $i % 60;
                                    $label = sprintf('%02d:%02d horas', $hours, $minutes);
                                @endphp
                                <option value="{{ $i }}">{{ $label }}</option>
                            @endfor
                        </select>
                    </div>

                    <!-- Campo oculto duración -->
                    <input type="hidden" name="duration" id="durationHidden">


                    <!-- Nota -->
                    <div class="mb-3">
                        <label>Nota</label>
                        <textarea name="note" class="form-control"></textarea>
                    </div>

                </div>

                <div class="modal-footer justify-content-end gap-2">
                    <button type="button"
                            class="btn btn-light border"
                            data-bs-dismiss="modal">
                        Cancelar
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        Guardar
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


