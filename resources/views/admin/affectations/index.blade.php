@extends('layouts.app')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Affectation des Médecins aux Services</h1>
        
        <div class="app-card shadow-sm mb-5">
            <div class="app-card-body p-4">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">Médecin</th>
                                <th class="cell">Service Actuel</th>
                                <th class="cell">Changer l'Affectation</th>
                                <th class="cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medecins as $medecin)
                            <tr>
                                <td class="cell">{{ $medecin->name }} {{ $medecin->prenom }}</td>
                                <td class="cell">
                                    <span class="badge bg-info">
                                        {{ $medecin->service ? $medecin->service->nom : 'Non affecté' }}
                                    </span>
                                </td>
                                <form action="{{ route('admin.affectations.update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="medecin_id" value="{{ $medecin->id }}">
                                    <td class="cell">
                                        <select name="service_id" class="form-select form-select-sm" required>
                                            <option value="">Choisir un service...</option>
                                            @foreach($services as $service)
                                                <option value="{{ $service->id }}" {{ $medecin->service_id == $service->id ? 'selected' : '' }}>
                                                    {{ $service->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="cell">
                                        <button type="submit" class="btn btn-sm btn-primary text-white">Valider</button>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection