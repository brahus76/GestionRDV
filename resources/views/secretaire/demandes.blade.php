@extends('layouts.app') @section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Demandes de Rendez-vous</h1>
        
        <div class="app-card shadow-sm mb-4">
            <div class="app-card-body p-3">
                <table class="table app-table-hover mb-0 text-left">
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Médecin</th>
                            <th>Date & Heure</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($demandes as $demande)
                        <tr>
                            <td>{{ $demande->patient->name }}</td>
                            <td>Dr. {{ $demande->medecin->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($demande->date_heure)->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('secretaire.rdv.valider', $demande->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-success text-white">Valider</button>
                                </form>

                                <form action="{{ route('secretaire.rdv.refuser', $demande->id) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-danger text-white">Refuser</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Aucune demande en attente.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection