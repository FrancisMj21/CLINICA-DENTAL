<form action="{{ route('doctors.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Contraseña</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <hr>

    <h5 class="mt-3">Datos personales</h5>
    <div class="mb-3">
        <label>DNI</label>
        <input type="text" name="dni" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nombres</label>
        <input type="text" name="nombres" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Apellidos</label>
        <input type="text" name="apellidos" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Fecha Nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nacionalidad</label>
        <input type="text" name="nacionalidad" class="form-control">
    </div>
    <div class="mb-3">
        <label>Especialidad</label>
        <input type="text" name="especialidad" class="form-control">
    </div>

    <div class="modal-footer justify-content-end gap-2">

    <button type="button"
            class="btn btn-light border"
            data-bs-dismiss="modal">
        Cancelar
    </button>

    <button type="submit"
            class="btn btn-primary">
        Crear
    </button>

    </div>
</form>
