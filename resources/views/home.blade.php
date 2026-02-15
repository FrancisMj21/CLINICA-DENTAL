@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    {{-- ADMIN --}}
                    @if(auth()->user()->role == 'admin')
                        <h4 class="text-primary">Panel de Administrador</h4>
                        <p>Bienvenido Administrador <strong>{{ auth()->user()->name }}</strong></p>
                        <hr>
                        <p>Desde aquí puedes gestionar doctores y pacientes.</p>
                    @endif


                    {{-- DOCTOR --}}
                    @if(auth()->user()->role == 'doctor')
                        <h4 class="text-success">Panel de Doctor</h4>
                        <p>Bienvenido Dr. <strong>{{ auth()->user()->name }}</strong></p>
                        <hr>
                        <p>Aquí podrás ver tus citas y pacientes asignados.</p>
                    @endif


                    {{-- PATIENT --}}
                    @if(auth()->user()->role == 'patient')
                        <h4 class="text-info">Panel de Paciente</h4>
                        <p>Bienvenido <strong>{{ auth()->user()->name }}</strong></p>
                        <hr>
                        <p>Aquí podrás ver tus citas médicas.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
