@extends('layouts.app')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Demandes de Rendez-vous (Service : {{ Auth::user()->service->nom ?? 'Général' }})</h1>
            </div>
        </div>

        <div class="app-card shadow-sm mb-5">
            <div class="app-card-body p-3">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">Patient</th>
                                <th class="cell">Médecin sollicité</th>
                                <th class="cell">Date & Heure</th>
                                <th class="cell">Motif</th>
                                <th class="cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($demandes as $demande)
                            <tr>
                                <td class="cell"><strong>{{ $demande->patient->name }}</strong></td>
                                <td class="cell">Dr. {{ $demande->medecin->name }}</td>
                                <td class="cell">{{ \Carbon\Carbon::parse($demande->date_heure)->format('d/m/Y H:i') }}</td>
                                <td class="cell"><span class="truncate">{{ $demande->motif }}</span></td>
                                <td class="cell">
                                    <form action="{{ route('secretaire.rdv.valider', $demande->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-sm btn-success text-white" title="Valider">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>

                                    <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $demande->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('secretaire.rdv.refuser', $demande->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PATCH')
                                        <button class="btn btn-sm btn-danger text-white" title="Refuser">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">Aucune demande en attente pour votre service.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection