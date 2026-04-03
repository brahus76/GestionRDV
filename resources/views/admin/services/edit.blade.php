@extends('layouts.app')

@section('content')
<div class="container-xl">
    <h1 class="app-page-title">Modifier le Service : {{ $service->nom }}</h1>
    <div class="app-card shadow-sm p-4">
        <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-3">
                <label class="form-label">Nom du Service</label>
                <input type="text" name="nom" class="form-control" value="{{ $service->nom }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3">{{ $service->description }}</textarea>
            </div>

            <button type="submit" class="btn app-btn-primary">Enregistrer les modifications</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection