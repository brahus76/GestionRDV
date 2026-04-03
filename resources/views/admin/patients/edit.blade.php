@extends('layouts.app')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Modifier le Patient : {{ $patient->name }} {{ $patient->prenom }}</h1>
            </div>
            <div class="col-auto">
                <a class="btn app-btn-secondary" href="{{ route('admin.patients.index') }}">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>
        </div>

        <div class="row g-4 settings-section">
            <div class="col-12 col-md-8">
                <div class="app-card app-card-settings shadow-sm p-4">
                    <div class="app-card-body">
                        <form action="{{ route('admin.patients.update', $patient->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="name" class="form-control" value="{{ $patient->name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Prénom</label>
                                    <input type="text" name="prenom" class="form-control" value="{{ $patient->prenom }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Numéro de Téléphone</label>
                                <input type="text" name="telephone" class="form-control" value="{{ $patient->telephone }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Adresse Email</label>
                                <input type="email" name="email" class="form-control" value="{{ $patient->email }}" required>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn app-btn-primary">Mettre à jour le dossier</button>
                                <a href="{{ route('admin.patients.index') }}" class="btn btn-light">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection