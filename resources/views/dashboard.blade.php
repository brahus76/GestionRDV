@extends('layouts.app')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Tableau de Bord - {{ ucfirst(Auth::user()->role) }}</h1>

        <div class="row g-4 mb-4">
            @if(Auth::user()->role == 'admin')
                @foreach(['Médecins' => 'medecins', 'Secrétaires' => 'secretaires', 'Patients' => 'patients', 'Services' => 'services'] as $label => $key)
                <div class="col-6 col-lg-3">
                    <div class="app-card app-card-stat shadow-sm h-100 border-left-primary">
                        <div class="app-card-body p-3">
                            <h4 class="stats-type mb-1">{{ $label }}</h4>
                            <div class="stats-figure">{{ $stats[$key] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            @elseif(Auth::user()->role == 'patient')
                <div class="col-6 col-lg-6">
                    <div class="app-card app-card-stat shadow-sm h-100 border-left-primary">
                        <div class="app-card-body p-3">
                            <h4 class="stats-type mb-1">Mes Rendez-vous</h4>
                            <div class="stats-figure">{{ $rendezvous->count() }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-6">
                    <div class="app-card app-card-stat shadow-sm h-100 border-left-warning">
                        <div class="app-card-body p-3">
                            <h4 class="stats-type mb-1">En Attente</h4>
                            <div class="stats-figure text-warning">{{ $rendezvous->where('statut', 'en_attente')->count() }}</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12 col-lg-8">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-header p-3">
                        <h4 class="app-card-title">
                            {{ Auth::user()->role == 'admin' ? 'Dernières Affectations' : 'Mes prochains rendez-vous' }}
                        </h4>
                    </div>
                    <div class="app-card-body p-3">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        @if(Auth::user()->role == 'admin')
                                            <th>Médecin</th><th>Service</th><th>Statut</th>
                                        @else
                                            <th>Date</th><th>Médecin</th><th>Statut</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(Auth::user()->role == 'admin')
                                        @forelse($medecins as $med)
                                            <tr>
                                                <td>Dr. {{ $med->name }}</td>
                                                <td>{{ $med->service->nom ?? 'Non affecté' }}</td>
                                                <td><span class="badge bg-success">Actif</span></td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3" class="text-center">Aucun médecin trouvé.</td></tr>
                                        @endforelse
                                    @else
                                        @forelse($rendezvous as $rdv)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($rdv->date_heure)->format('d/m/Y H:i') }}</td>
                                                <td>Dr. {{ $rdv->medecin->name ?? 'À définir' }}</td>
                                                <td><span class="badge bg-warning">{{ $rdv->statut }}</span></td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3" class="text-center">Aucun rendez-vous enregistré.</td></tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="app-card shadow-sm p-4 text-center">
                    @if(Auth::user()->role == 'patient')
                        <a href="{{ route('patient.rdv.create') }}" class="btn btn-primary w-100">+ Prendre RDV</a>
                    @elseif(Auth::user()->role == 'admin')
                        <a href="{{ route('admin.affectations.index') }}" class="btn btn-info w-100 mb-2">Gérer Affectations</a>
                        <a href="{{ route('admin.medecins.index') }}" class="btn btn-dark w-100">Gérer Personnel</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection