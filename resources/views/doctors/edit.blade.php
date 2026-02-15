<form action="{{ route('doctors.update', $doctor->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>DNI</label>
        <input type="text"
               name="dni"
               class="form-control"
               value="{{ old('dni', $doctor->dni) }}">
    </div>

    <div class="mb-3">
        <label>Nombres</label>
        <input type="text"
               name="nombres"
               class="form-control"
               value="{{ old('nombres', $doctor->nombres) }}">
    </div>

    <div class="mb-3">
        <label>Apellidos</label>
        <input type="text"
               name="apellidos"
               class="form-control"
               value="{{ old('apellidos', $doctor->apellidos) }}">
    </div>

    <div class="mb-3">
    <label>Fecha de Nacimiento</label>
    <input type="date"
           name="fecha_nacimiento"
           class="form-control"
           value="{{ $doctor->fecha_nacimiento }}">
    </div>

    <div class="mb-3">
        <label>Nacionalidad</label>
        <input type="text"
            name="nacionalidad"
            class="form-control"
            value="{{ $doctor->nacionalidad }}">
    </div>

    <div class="mb-3">
        <label>Especialidad</label>
        <input type="text"
               name="especialidad"
               class="form-control"
               value="{{ old('especialidad', $doctor->especialidad) }}">
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-success">
            Actualizar
        </button>
    </div>
</form>
