@extends('layouts.app')

@section('content')
<h1 class="app-page-title">Ajouter un nouveau Service</h1>
<hr class="mb-4">
<div class="row g-4 settings-section">
    <div class="col-12 col-md-8">
        <div class="app-card app-card-settings shadow-sm p-4">
            <div class="app-card-body">
                <form action="{{ route('admin.services.store') }}" method="POST">
                    @csrf <div class="mb-3">
                        <label class="form-label">Nom du Service</label>
                        <input type="text" name="nom" class="form-control" required> 
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer le service</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection