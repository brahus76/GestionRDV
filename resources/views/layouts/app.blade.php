<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GEST-RDV | Portal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">
</head> 

<body class="app">    
    <header class="app-header fixed-top">          
        <div class="app-header-inner">  
            <div class="container-fluid py-2">
                <div class="app-header-content">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <a id="sidepanel-toggler" class="sidepanel-toggler d-inline-block d-xl-none" href="#">
                                <i class="fas fa-bars"></i>
                            </a>
                        </div>
                        <div class="app-utilities col-auto">
                            <div class="app-utility-item app-user-dropdown dropdown">
                                <a class="dropdown-toggle" id="user-dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                    <i class="fas fa-user-circle fa-2x"></i>
                                    <span class="d-none d-md-inline-block ms-2">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="user-dropdown-toggle">
                                    <li><a class="dropdown-item" href="#">Profil</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="app-sidepanel" class="app-sidepanel"> 
            <div id="sidepanel-drop" class="sidepanel-drop"></div>
            <div class="sidepanel-inner d-flex flex-column">
                <div class="app-branding mb-4 text-center">
                    <a class="app-logo" href="{{ route('dashboard') }}">
                        <span class="logo-text">CLINIC-RDV</span>
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
                                <a class="nav-link {{ Request::is('admin/medecins*') ? 'active' : '' }}" href="{{ route('admin.medecins.index') }}">
                                    <span class="nav-icon"><i class="fas fa-user-md"></i></span>
                                    <span class="nav-link-text">Médecins</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/secretaires*') ? 'active' : '' }}" href="{{ route('admin.secretaires.index') }}">
                                    <span class="nav-icon"><i class="fas fa-user-nurse"></i></span>
                                    <span class="nav-link-text">Secrétaires</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/patients*') ? 'active' : '' }}" href="{{ route('admin.patients.index') }}">
                                    <span class="nav-icon"><i class="fas fa-user-injured"></i></span>
                                    <span class="nav-link-text">Patients</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/services*') ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
                                    <span class="nav-icon"><i class="fas fa-hospital"></i></span>
                                    <span class="nav-link-text">Services</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('admin/affectations*') ? 'active' : '' }}" href="{{ route('admin.affectations.index') }}">
                                    <span class="nav-icon"><i class="fas fa-exchange-alt"></i></span>
                                    <span class="nav-link-text">Affectations</span>
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->role == 'medecin')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('medecin/planning*') ? 'active' : '' }}" href="{{ route('medecin.planning.index') }}">
                                    <span class="nav-icon"><i class="fas fa-calendar-check"></i></span>
                                    <span class="nav-link-text">Mon Planning</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('medecin.planning.index') }}#patients">
                                    <span class="nav-icon"><i class="fas fa-users"></i></span>
                                    <span class="nav-link-text">Mes Patients</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <span class="nav-icon"><i class="fas fa-clock"></i></span>
                                    <span class="nav-link-text">Disponibilités</span>
                                </a>
                            </li>
                        @endif

                        @if(Auth::user()->role == 'patient')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('patient/rendez-vous*') ? 'active' : '' }}" href="{{ route('patient.rdv.index') }}">
                                    <span class="nav-icon"><i class="fas fa-calendar-alt"></i></span>
                                    <span class="nav-link-text">Mes Rendez-vous</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('patient.rdv.create') ? 'active' : '' }}" href="{{ route('patient.rdv.create') }}">
                                    <span class="nav-icon"><i class="fas fa-plus-circle"></i></span>
                                    <span class="nav-link-text">Prendre RDV</span>
                                </a>
                            </li>

                        @endif
                        @if (Auth::user()->role == 'secretaire')
                            
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('secretaire/demandes*') ? 'active' : '' }}" href="{{ route('secretaire.demandes.index') }}">
                                    <span class="nav-icon"><i class="fas fa-clipboard-list"></i></span>
                                    <span class="nav-link-text">Demandes de RDV</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('secretaire/planning*') ? 'active' : '' }}" href="{{ route('secretaire.planning.index') }}">
                                    <span class="nav-icon"><i class="fas fa-calendar-alt"></i></span>
                                    <span class="nav-link-text">Planning du Service</span>
                                </a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{ route('secretaire.demandes.index') }}">
                                    <span class="nav-icon"><i class="fas fa-envelope"></i></span>
                                    <span class="nav-link-text">Demandes</span>
                                    @if(Auth::user()->unreadNotifications->count() > 0)
                                        <span class="badge bg-danger">
                                            {{ Auth::user()->unreadNotifications->count() }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                <div class="mb-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary shadow-sm">
                        <i class="fas fa-home me-2"></i> Retour au Dashboard
                    </a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>  
    <script src="{{ asset('assets/js/app.js') }}"></script> 
</body>
</html>