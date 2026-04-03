@extends('layouts.app') 

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        
    

        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Gestion des Secrétaires</h1>
            </div>
            <div class="col-auto">
                 <div class="page-utilities">
                    <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                        <div class="col-auto">
                            <form class="table-search-form row gx-1 align-items-center" action="{{ route('admin.secretaires.index') }}" method="GET">
                                <div class="col-auto">
                                    <input type="text" name="search" class="form-control search-input" placeholder="Rechercher...">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-secondary">Chercher</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <a class="btn app-btn-primary" href="{{ route('admin.secretaires.create') }}">
                                <i class="fas fa-plus me-2"></i>Nouveau Secrétaire
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
                                <th class="cell">Nom</th>
                                <th class="cell">Prénom</th>
                                <th class="cell">Email</th>
                                <th class="cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($secretaires as $secretaire)
                            <tr>
                                <td class="cell">{{ $secretaire->matricule }}</td>
                                <td class="cell"><span>{{ $secretaire->name }}</span></td>
                                <td class="cell">{{ $secretaire->prenom }}</td>
                                <td class="cell">{{ $secretaire->email }}</td>
                                <td class="cell">
                                    <a class="btn-sm app-btn-secondary" href="{{ route('admin.secretaires.edit', $secretaire->id) }}">Modifier</a>
                                    
                                    <form action="{{ route('admin.secretaires.destroy', $secretaire->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous supprimer ce secrétaire ?')">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center p-4">Aucun secrétaire enregistré.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($secretaires instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="app-pagination mt-3">
                {{ $secretaires->links() }}
            </div>
        @endif

    </div>
</div>
@endsection