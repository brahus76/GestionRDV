@extends('layouts.app')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Espace Médecin - Dr. {{ Auth::user()->name }}</h1>

        <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
            <a class="flex-sm-fill text-sm-center nav-link active" id="planning-tab" data-bs-toggle="tab" href="#planning" role="tab">Mon Planning</a>
            <a class="flex-sm-fill text-sm-center nav-link" id="patients-tab" data-bs-toggle="tab" href="#patients" role="tab">Mes Patients</a>
        </nav>

        <div class="tab-content" id="orders-table-tab-content">
            <div class="tab-pane fade show active" id="planning" role="tabpanel">
                <div class="app-card shadow-sm mb-5">
                    <div class="app-card-body p-3">
                        <table class="table app-table-hover mb-0 text-left">
                            <thead>
                                <tr>
                                    <th>Date & Heure</th>
                                    <th>Patient</th>
                                    <th>Motif</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($planning as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->date_heure)->format('d/m/Y H:i') }}</td>
                                    <td>{{ $item->patient->name }}</td>
                                    <td>{{ Str::limit($item->motif, 30) }}</td>
                                    <td>
                                        <span class="badge {{ $item->statut == 'confirme' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $item->statut }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('medecin.rdv.update', $item->id) }}" method="POST" class="d-inline">
                                            @csrf @method('PATCH')
                                            <select name="statut" onchange="this.form.submit()" class="form-select form-select-sm d-inline-block w-auto">
                                                <option value="en_attente" {{ $item->statut == 'en_attente' ? 'selected' : '' }}>Attente</option>
                                                <option value="confirme" {{ $item->statut == 'confirme' ? 'selected' : '' }}>Confirmer</option>
                                                <option value="annule" {{ $item->statut == 'annule' ? 'selected' : '' }}>Annuler</option>
                                            </select>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="patients" role="tabpanel">
                <div class="app-card shadow-sm mb-5">
                    <div class="app-card-body p-3">
                        <div class="row g-4">
                            @forelse($patients as $patient)
                            <div class="col-12 col-md-4">
                                <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm p-3">
                                    <div class="app-card-header mb-3">
                                        <h4 class="app-card-title">{{ $patient->name }}</h4>
                                    </div>
                                    <div class="app-card-body">
                                        <p>Email: {{ $patient->email }}</p>
                                    </div>
                                    <div class="app-card-footer mt-auto">
                                        <a class="btn btn-sm btn-secondary" href="#">Voir Dossier</a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-center p-4">Aucun patient enregistré pour le moment.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection