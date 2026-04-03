<div id="app-sidepanel" class="app-sidepanel"> 
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="/">
                <img class="logo-icon me-2" src="{{ asset('assets/images/app-logo.svg') }}" alt="logo">
                <span class="logo-text">GEST-RDV</span>
            </a>
        </div>
         	<nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
    <ul class="app-menu list-unstyled accordion" id="menu-accordion">
        
        <li class="nav-item">
            <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                <span class="nav-icon"><i class="fas fa-home"></i></span>
                <span class="nav-link-text">Tableau de bord</span>
            </a>
        </li>

        @if(Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.medecins.*') ? 'active' : '' }}" href="{{ route('admin.medecins.index') }}">
                    <span class="nav-icon"><i class="fas fa-user-md"></i></span>
                    <span class="nav-link-text">Médecins</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.secretaires.*') ? 'active' : '' }}" href="{{ route('admin.secretaires.index') }}">
                    <span class="nav-icon"><i class="fas fa-user-tie"></i></span>
                    <span class="nav-link-text">Secrétaires</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.patients.*') ? 'active' : '' }}" href="{{ route('admin.patients.index') }}">
                    <span class="nav-icon"><i class="fas fa-users"></i></span>
                    <span class="nav-link-text">Patients</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.services.*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                    <span class="nav-icon"><i class="fas fa-hospital"></i></span>
                    <span class="nav-link-text">Services</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('admin.affectations.*') ? 'active' : '' }}" href="{{ route('admin.affectations.index') }}">
                    <span class="nav-icon"><i class="fas fa-link"></i></span>
                    <span class="nav-link-text">Affectations</span>
                </a>
            </li>
        @endif

        @if(Auth::user()->role == 'medecin')
            <li class="nav-item">
                <a class="nav-link {{ Route::is('medecin.planning.*') ? 'active' : '' }}" href="{{ route('medecin.planning.index') }}">
                    <span class="nav-icon"><i class="fas fa-calendar-check"></i></span>
                    <span class="nav-link-text">Mon Planning</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span class="nav-icon"><i class="fas fa-user-injured"></i></span>
                    <span class="nav-link-text">Mes Patients</span>
                </a>
            </li>
            
            <li class="nav-item">
    		<a class="nav-link" href="{{ route('medecin.disponibilite.index') }}">
        		<span class="nav-icon"><i class="fas fa-clock"></i></span>
        		<span class="nav-link-text">Mes Horaires</span>
    		</a>
    	</li>
            
            
        @endif

        @if(Auth::user()->role == 'patient')
            <li class="nav-item">
                <a class="nav-link {{ Route::is('patient.rdv.*') ? 'active' : '' }}" href="{{ route('patient.rdv.index') }}">
                    <span class="nav-icon"><i class="fas fa-calendar-alt"></i></span>
                    <span class="nav-link-text">Mes Rendez-vous</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('patient.rdv.create') }}">
                    <span class="nav-icon"><i class="fas fa-plus-circle"></i></span>
                    <span class="nav-link-text">Prendre RDV</span>
                </a>
            </li>
        @endif

    </ul>
</nav>
        
        
        </div>
    </div>
</div>