<div id="app-sidepanel" class="app-sidepanel"> 
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="/"><img class="logo-icon me-2" src="{{ asset('assets/images/app-logo.svg') }}" alt="logo"><span class="logo-text">GEST-RDV</span></a>
        </div>
        
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
                        <span class="nav-icon"><i class="fas fa-home"></i></span>
                        <span class="nav-link-text">Tableau de bord</span>
                    </a>
                </li>

                @if(Auth::user()->role == 'admin')
                    <li class="nav-item has-submenu">
                        <a class="nav-link submenu-toggle {{ request()->is('admin/users*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#submenu-users">
                            <span class="nav-icon"><i class="fas fa-users-cog"></i></span>
                            <span class="nav-link-text">Utilisateurs</span>
                            <span class="submenu-arrow"><i class="fas fa-chevron-down"></i></span>
                        </a>
                        <div id="submenu-users" class="collapse submenu {{ request()->is('admin/users*') ? 'show' : '' }}">
                            <ul class="submenu-list list-unstyled">
                                <li><a class="submenu-link" href="{{ route('admin.medecins.index') }}">Médecins</a></li>
                                <li><a class="submenu-link" href="/admin/secretaires">Secrétaires</a></li>
                                <li><a class="submenu-link" href="{{ route('admin.patients.index') }}">Patients</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/services*') ? 'active' : '' }}" href="/admin/services">
                            <span class="nav-icon"><i class="fas fa-hospital"></i></span>
                            <span class="nav-link-text">Services</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/affectations*') ? 'active' : '' }}" href="{{ route('admin.affectations.index') }}">
                            <span class="nav-icon"><i class="fas fa-handshake"></i></span>
                            <span class="nav-link-text">Affectations</span>
                        </a>
                    </li>

                @elseif(Auth::user()->role == 'secretaire')
                    <li class="nav-item">
                        <a class="nav-link" href="/secretaire/demandes">
                            <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span>
                            <span class="nav-link-text">Demandes RDV</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/secretaire/planning">
                            <span class="nav-icon"><i class="fas fa-calendar-check"></i></span>
                            <span class="nav-link-text">Planning Service</span>
                        </a>
                    </li>

                @elseif(Auth::user()->role == 'medecin')
                    <li class="nav-item">
                        <a class="nav-link" href="/medecin/planning">
                            <span class="nav-icon"><i class="fas fa-calendar-alt"></i></span>
                            <span class="nav-link-text">Mon Planning</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/medecin/disponibilites">
                            <span class="nav-icon"><i class="fas fa-clock"></i></span>
                            <span class="nav-link-text">Mes Disponibilités</span>
                        </a>
                    </li>

                @elseif(Auth::user()->role == 'patient')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.rdv.create') }}">
                            <span class="nav-icon"><i class="fas fa-plus-circle"></i></span>
                            <span class="nav-link-text">Prendre RDV</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('patient.rdv.index') }}">
                            <span class="nav-icon"><i class="fas fa-history"></i></span>
                            <span class="nav-link-text">Mes Rendez-vous</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>

        <div class="app-sidepanel-footer">
            <nav class="app-nav app-nav-footer">
                <ul class="app-menu footer-menu list-unstyled">
                    <li class="nav-item">
                        <a class="nav-link" href="/settings">
                            <span class="nav-icon"><i class="fas fa-cog"></i></span>
                            <span class="nav-link-text">Paramètres</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>