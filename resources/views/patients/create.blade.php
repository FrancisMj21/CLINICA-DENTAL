<form action="{{ route('patients.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>DNI</label>
        <input type="text" name="dni" class="form-control" value="{{ old('dni') }}" required>
    </div>

    <div class="mb-3">
        <label>Nombres</label>
        <input type="text" name="nombres" class="form-control" value="{{ old('nombres') }}" required>
    </div>

    <div class="mb-3">
        <label>Apellidos</label>
        <input type="text" name="apellidos" class="form-control" value="{{ old('apellidos') }}" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Fecha de Nacimiento</label>
        <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}">
    </div>

    <div class="mb-3">
        <label>Nacionalidad</label>
        <input type="text" name="nacionalidad" class="form-control" value="{{ old('nacionalidad') }}">
    </div>

    <div class="modal-footer justify-content-end gap-2">

    <button type="button"
            class="btn btn-light border"
            data-bs-dismiss="modal">
        Cancelar
    </button>

    <button type="submit"
            class="btn btn-primary">
        Actualizar
    </button>

    </div>

</form>

