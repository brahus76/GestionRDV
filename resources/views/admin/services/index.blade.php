@extends('layouts.app') 

@section('content')
<div class="app-wrapper">
    <div class="app-content pt-3 p-md-3 p-lg-4">
        <div class="container-xl">
            
            <div class="row g-3 mb-4 align-items-center justify-content-between">
                <div class="col-auto">
                    <h1 class="app-page-title mb-0">Gestion des Services</h1>
                </div>
                <div class="col-auto">
                     <div class="page-utilities">
                        <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                            <div class="col-auto">
                                <form class="table-search-form row gx-1 align-items-center" action="{{ route('admin.services.index') }}" method="GET">
                                    <div class="col-auto">
                                        <input type="text" name="search" class="form-control search-input" placeholder="Rechercher...">
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-secondary">Chercher</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-auto">
                                <a class="btn btn-primary" href="{{ route('admin.services.create') }}">
                                    <i class="fas fa-plus"></i> Nouveau Services
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
                                    
                                    <th class="cell">Nom</th>
                                    <th class="cell">Description</th>
                                   
                                    <th class="cell">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $service)
                                    <tr>
                                        <td class="cell">{{ $service->nom }}</td>
                                        <td class="cell">{{ $service->description }}</td>
                                        <td class="cell">
                                            <a class="btn-sm app-btn-secondary" href="{{ route('admin.services.edit', $service->id) }}">Modifier</a>
                                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline;>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous supprimer ce service ?')">Supprimer</button>
                                            </form>
                                           
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection