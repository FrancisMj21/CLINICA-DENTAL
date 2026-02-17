@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Pacientes</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Botón para abrir modal -->
    <button type="button" id="btnCreatePatient" class="btn btn-primary mb-3">
        Nuevo Paciente
    </button>

    <!-- Modal -->
    <div class="modal fade" id="patientModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Crear Paciente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body" id="modalContent">
                    <div class="text-center">Cargando...</div>
                </div>

            </div>
        </div>
    </div>

    <!-- Tabla de pacientes -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $patient->id }}</td>
                    <td>{{ $patient->dni }}</td>
                    <td>{{ $patient->nombres }} {{ $patient->apellidos }}</td>
                    <td>
                        <button 
                            class="btn btn-warning btn-sm btnEditPatient"
                            data-url="{{ route('patients.edit', $patient) }}">
                            Editar
                        </button>

                        <form action="{{ route('patients.destroy',$patient) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Script para crear paciente -->
<script>
document.getElementById('btnCreatePatient').addEventListener('click', function() {
    let modal = new bootstrap.Modal(document.getElementById('patientModal'));
    modal.show();

    document.querySelector('.modal-title').innerText = "Crear Paciente";

    fetch("{{ route('patients.create') }}")
        .then(res => res.text())
        .then(data => document.getElementById('modalContent').innerHTML = data)
        .catch(err => document.getElementById('modalContent').innerHTML = "<p class='text-danger'>Error al cargar formulario</p>");
});
</script>

<!-- Script para editar paciente -->
<script>
document.querySelectorAll('.btnEditPatient').forEach(button => {
    button.addEventListener('click', function() {
        let url = this.getAttribute('data-url');
        let modal = new bootstrap.Modal(document.getElementById('patientModal'));
        modal.show();

        document.querySelector('.modal-title').innerText = "Editar Paciente";

        fetch(url)
            .then(res => res.text())
            .then(data => document.getElementById('modalContent').innerHTML = data)
            .catch(err => document.getElementById('modalContent').innerHTML = "<p class='text-danger'>Error al cargar formulario</p>");
    });
});
</script>

<!-- Auto ocultar alert -->
<script>
setTimeout(() => {
    let alert = document.querySelector('.alert');
    if(alert){
        alert.classList.remove('show');
        alert.classList.add('fade');
        setTimeout(() => alert.remove(), 500);
    }
}, 2500);
</script>
@endsection
