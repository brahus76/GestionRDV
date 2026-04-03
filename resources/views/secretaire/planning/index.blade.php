@extends('layouts.app')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Planning des Médecins du Service</h1>
            </div>
            <div class="col-auto">
                <a class="btn btn-primary" href="#">
                    <i class="fas fa-plus me-2"></i>Ajouter manuellement
                </a>
            </div>
        </div>

        <div class="row g-4">
            @foreach($medecins as $medecin)
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-basic shadow-sm">
                    <div class="app-card-header p-3 border-bottom-0">
                        <h4 class="app-card-title">Dr. {{ $medecin->name }}</h4>
                    </div>
                    <div class="app-card-body p-3">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Heure</th>
                                    <th>Patient</th>
                                    <th>Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($medecin->rendezvousAsMedecin->where('statut', 'confirme') as $rdv)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($rdv->date_heure)->format('H:i') }}</td>
                                    <td>{{ $rdv->patient->name }}</td>
                                    <td><span class="badge bg-success">Confirmé</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-muted small">Aucun RDV confirmé aujourd'hui.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection