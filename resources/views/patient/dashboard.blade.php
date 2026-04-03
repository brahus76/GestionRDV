@extends('layouts.app')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        
        <h1 class="app-page-title">Tableau de Bord Patient</h1>
        
        <div class="row g-4 mb-4">
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100 border-left-primary">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">Total RDV</h4>
                        <div class="stats-figure">{{ $rendezvous->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="app-card app-card-stat shadow-sm h-100 border-left-warning">
                    <div class="app-card-body p-3 p-lg-4">
                        <h4 class="stats-type mb-1">En Attente</h4>
                        <div class="stats-figure text-warning">
                            {{ $rendezvous->where('statut', 'en_attente')->count() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12 col-lg-8">
                <div class="app-card app-card-orders-table shadow-sm mb-5">
                    <div class="app-card-header p-3 border-bottom-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h1 class="app-card-title">Mes prochains rendez-vous</h1>
                            <a class="btn btn-sm btn-primary text-white" href="{{ route('patient.rdv.create') }}">
                                <i class="fas fa-plus me-1"></i> Nouveau RDV
                            </a>
                        </div>
                    </div>
                    <div class="app-card-body p-3">
                        <div class="table-responsive">
                            <table class="table app-table-hover mb-0 text-left">
                                <thead>
                                    <tr>
                                        <th class="cell">Date</th>
                                        <th class="cell">Médecin</th>
                                        <th class="cell">Service</th>
                                        <th class="cell">Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rendezvous->take(5) as $rdv)
                                    <tr>
                                        <td class="cell">
                                            {{ \Carbon\Carbon::parse($rdv->date_heure)->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="cell">
                                            Dr. {{ $rdv->medecin->name ?? 'En attente d\'assignation' }}
                                        </td>
                                        <td class="cell">{{ $rdv->service->nom ?? 'N/A' }}</td>
                                        <td class="cell">
                                            @php
                                                $statusMap = [
                                                    'en_attente' => 'bg-warning',
                                                    'confirme' => 'bg-success',
                                                    'annule' => 'bg-danger',
                                                    'termine' => 'bg-info'
                                                ];
                                                $badgeClass = $statusMap[$rdv->statut] ?? 'bg-secondary';
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">
                                                {{ ucfirst(str_replace('_', ' ', $rdv->statut)) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center p-4 text-muted">
                                            Aucun rendez-vous pour le moment.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-header mb-3">
                        <h1 class="app-card-title">Besoin d'aide ?</h1>
                    </div>
                    <div class="app-card-body text-center">
                        <p class="small text-muted">En cas d'urgence, contactez directement l'accueil de la clinique.</p>
                        <a href="tel:00226XXXXXXXX" class="btn btn-success text-white w-100 mb-2">
                             <i class="fas fa-phone-alt me-2"></i> Appeler l'accueil
                        </a>
                        <small class="text-muted">Disponible 24h/24 - 7j/7</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection