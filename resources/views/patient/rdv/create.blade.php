@extends('layouts.app')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        <h1 class="app-page-title">Prendre un Rendez-vous</h1>
        <div class="app-card shadow-sm p-4">
            <form action="{{ route('patient.rdv.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Service médical</label>
                        <select name="service_id" class="form-select" required>
                            <option value="">Choisir un service...</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Médecin</label>
                        <select name="medecin_id" class="form-select" required>
                            <option value="">Choisir un médecin...</option>
                            @foreach($medecins as $medecin)
                                <option value="{{ $medecin->id }}">Dr. {{ $medecin->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Date et Heure souhaitée</label>
                        <input type="datetime-local" name="date_heure" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Motif de la consultation</label>
                        <textarea name="motif" class="form-control" rows="3" placeholder="Expliquez brièvement votre besoin..."></textarea>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary">Confirmer la demande</button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection