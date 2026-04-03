@extends('layouts.app') 

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Gestion des Médecins</h1>
            </div>
            <div class="col-auto">
                 <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <form class="table-search-form row gx-1 align-items-center" action="{{ route('admin.medecins.index') }}" method="GET">
                                <div class="col-auto">
                                    <input type="text" name="search" class="form-control search-input" placeholder="Rechercher...">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-secondary">Chercher</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="{{ route('admin.medecins.create') }}">
                                <i class="fas fa-plus me-2"></i>Nouveau Médecin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">Matricule</th>
                                <th class="cell">Nom & Prénom</th>
                                <th class="cell">Spécialité</th>
                                <th class="cell">Email</th>
                                <th class="cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($medecins as $medecin)
                            <tr>
                                <td class="cell">{{ $medecin->matricule }}</td>
                                <td class="cell"><span class="truncate">{{ $medecin->name }} {{ $medecin->prenom }}</span></td>
                                <td class="cell"><span class="badge bg-success">{{ $medecin->specialite }}</span></td>
                                <td class="cell">{{ $medecin->email }}</td>
                                <td class="cell">
                                    <a class="btn-sm app-btn-secondary" href="{{ route('admin.medecins.edit', $medecin->id) }}">Modifier</a>
                                    
                                    <form action="{{ route('admin.medecins.destroy', $medecin->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer ce médecin ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">Aucun médecin trouvé.</td>
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