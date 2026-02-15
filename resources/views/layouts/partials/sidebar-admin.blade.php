<li class="nav-item">
    <a href="{{ route('patients.index') }}"
       class="nav-link {{ request()->routeIs('patients.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Pacientes</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('doctors.index') }}"
       class="nav-link {{ request()->routeIs('doctors.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-md"></i>
        <p>Doctores</p>
    </a>
</li>
