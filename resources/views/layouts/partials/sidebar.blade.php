<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('appointments.index') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light">Clínica Dental</span>
    </a>

    <div class="sidebar">
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column">

                @auth

                    {{-- OPCIÓN COMÚN --}}
                    <li class="nav-item">
                        <a href="{{ route('appointments.index') }}"
                           class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar"></i>
                            <p>Agenda</p>
                        </a>
                    </li>

                    {{-- OPCIONES POR ROL --}}
                    @if(auth()->user()->role == 'admin')
                        @include('layouts.partials.sidebar-admin')
                    @endif

                    @if(auth()->user()->role == 'doctor')
                        @include('layouts.partials.sidebar-doctor')
                    @endif

                    @if(auth()->user()->role == 'patient')
                        @include('layouts.partials.sidebar-patient')
                    @endif

                    {{-- LOGOUT --}}
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link w-100 text-left border-0 bg-transparent">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Cerrar Sesión</p>
                            </button>
                        </form>
                    </li>

                @endauth

            </ul>
        </nav>
    </div>
</aside>
