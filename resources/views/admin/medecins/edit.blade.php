@extends('layouts.app')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Modifier le Médecin : Dr. {{ $medecin->name }}</h1>
            </div>
            <div class="col-auto">
                <a class="btn app-btn-secondary" href="{{ route('admin.medecins.index') }}">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>
        </div>

        <div class="app-card app-card-settings shadow-sm p-4">
            <form action="{{ route('admin.medecins.update', $medecin->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" name="name" class="form-control" value="{{ $medecin->name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prénom</label>
                        <input type="text" name="prenom" class="form-control" value="{{ $medecin->prenom }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $medecin->email }}" required>
                </div>

                <button type="submit" class="btn app-btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>
</div>
@endsection