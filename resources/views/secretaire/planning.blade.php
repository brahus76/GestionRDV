@extends('layouts.app')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Planning du Service : {{ Auth::user()->service->nom ?? 'Mon Service' }}</h1>
        
        <div class="row g-4">
            @forelse($medecins as $medecin)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="app-card app-card-basic shadow-sm">
                        <div class="app-card-header p-3 border-bottom-0">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <h4 class="app-card-title">Dr. {{ $medecin->name }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="app-card-body p-3">
                            <div class="table-responsive">
                                <table class="table table-sm mb-0">
                                    <thead>
                                        <tr>
                                            <th>Heure</th>
                                            <th>Patient</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($medecin->rendezvousAsMedecin as $rdv)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($rdv->date_heure)->format('H:i') }}</td>
                                                <td>{{ $rdv->patient->name }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-muted text-center small">Aucun RDV aujourd'hui</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="app-card-footer p-3 mt-auto">
                           <a class="btn btn-sm btn-secondary" href="#">Voir tout le planning</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Aucun médecin n'est affecté à votre service pour le moment.</div>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection