@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Doctores</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Botón para abrir modal -->
    <button type="button" id="btnCreateDoctor" class="btn btn-primary mb-3">
        Nuevo Doctor
    </button>

    <!-- Modal -->
    <div class="modal fade" id="doctorModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Crear Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body" id="modalContent">
                    <div class="text-center">
                        Cargando...
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Tabla de doctores -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>DNI</th>
                <th>Nombre</th>
                <th>Especialidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
                <tr>
                    <td>{{ $doctor->id }}</td>
                    <td>{{ $doctor->dni }}</td>
                    <td>{{ $doctor->nombres }} {{ $doctor->apellidos }}</td>
                    <td>{{ $doctor->especialidad }}</td>
                    <td>
                        <button 
                            class="btn btn-warning btn-sm btnEditDoctor"
                            data-url="{{ route('doctors.edit', $doctor) }}">
                            Editar
                        </button>
                        <form action="{{ route('doctors.destroy',$doctor) }}" method="POST" style="display:inline;">
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

<!-- Script para abrir modal y cargar formulario -->
<script>
    document.getElementById('btnCreateDoctor').addEventListener('click', function() {

    let modal = new bootstrap.Modal(document.getElementById('doctorModal'));
    modal.show();

    document.querySelector('.modal-title').innerText = "Crear Doctor";

    fetch("{{ route('doctors.create') }}")
        .then(response => response.text())
        .then(data => {
            document.getElementById('modalContent').innerHTML = data;
        })
        .catch(error => {
            document.getElementById('modalContent').innerHTML = 
                "<p class='text-danger'>Error al cargar formulario</p>";
        });

});


</script>

<script>

document.querySelectorAll('.btnEditDoctor').forEach(button => {
    button.addEventListener('click', function() {

        let url = this.getAttribute('data-url');
        let modal = new bootstrap.Modal(document.getElementById('doctorModal'));
        modal.show();

        document.querySelector('.modal-title').innerText = "Editar Doctor";

        fetch(url)
            .then(response => response.text())
            .then(data => {
                document.getElementById('modalContent').innerHTML = data;
            })
            .catch(error => {
                document.getElementById('modalContent').innerHTML =
                    "<p class='text-danger'>Error al cargar formulario</p>";
            });

    });
});

</script>

<script>
    setTimeout(function() {
        let alert = document.querySelector('.alert');
        if(alert){
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        }
    }, 2500);
</script>


@endsection
