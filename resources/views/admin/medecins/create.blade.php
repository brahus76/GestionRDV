@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="app-page-title">Ajouter un nouveau Médecin</h1>
    <div class="app-card shadow-sm p-4">
        <form action="{{ route('admin.medecins.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label>Nom</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label>Prénom</label>
                    <input type="text" name="prenom" class="form-control">
                </div>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label>Matricule</label>
                    <input type="text" name="matricule" class="form-control" placeholder="Ex: MD-001" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label>Spécialité</label>
                    <input type="text" name="specialite" class="form-control" placeholder="Ex: Cardiologie">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer le Médecin</button>
            <a href="{{ route('admin.medecins.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection