@extends('layouts.app')

@section('content')
    <div class="row">
        <h1>Panel principal</h1>
    </div>

    <hr>

    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">

                    <p>Usuarios</p>
                </div>
                <div class="icon">
                    <i class="ion bi bi-file-person-fill"></i>
                </div>
                <a href="{{ url('admin/usuarios') }}" class="small-box-footer">Más información <i
                        class="fas bi bi-file-person-fill"></i></a>
            </div>
        </div>

        <!-- separacion -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">

                    <p>Doctores</p>
                </div>
                <div class="icon">
                    <i class="ion bi bi-file-person-fill"></i>
                </div>
                <a href="{{ url('admin/docentes') }}" class="small-box-footer">Más información <i
                        class="fas bi bi-file-person-fill"></i></a>
            </div>
        </div>

        <!-- separacion -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">

                    <p>Pacientes</p>
                </div>
                <div class="icon">
                    <i class="ion bi bi-file-person-fill"></i>
                </div>
                <a href="{{ url('admin/cursos') }}" class="small-box-footer">Más información <i
                        class="fas bi bi-file-person-fill"></i></a>
            </div>
        </div>

    </div>
@endsection