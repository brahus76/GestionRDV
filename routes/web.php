<?php
use App\Http\Controllers\admin\MedecinController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SecretaireController;
use App\Http\Controllers\admin\PatientController;
use App\Http\Controllers\admin\ServicesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\medecin\PlanningController;
use App\Http\Controllers\secretaire\SecretairesController;
use App\Http\Controllers\secretaire\RendezVousController;
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handleLogin'])->name('handleLogin');


//route securisé
Route::middleware('auth')->group(function(){
    
    Route::prefix('admin')->group(function () {
            // 1. Gestion des Médecins
        Route::get('/medecins', [MedecinController::class, 'index'])->name('admin.medecins.index');
        Route::get('/medecins/create', [MedecinController::class, 'create'])->name('admin.medecins.create');
        Route::post('/medecins/store', [MedecinController::class, 'store'])->name('admin.medecins.store');
        Route::get('/medecins/{id}/edit', [MedecinController::class, 'edit'])->name('admin.medecins.edit');
        Route::put('/medecins/{id}', [MedecinController::class, 'update'])->name('admin.medecins.update');
        Route::delete('/medecins/{id}', [MedecinController::class, 'destroy'])->name('admin.medecins.destroy');


        Route::get('/secretaires', [SecretaireController::class, 'index'])->name('admin.secretaires.index');
        Route::get('/secretaires/create', [SecretaireController::class, 'create'])->name('admin.secretaires.create');
        Route::post('/secretaires/store', [SecretaireController::class, 'store'])->name('admin.secretaires.store');
        Route::delete('/secretaires/{id}', [SecretaireController::class, 'destroy'])->name('admin.secretaires.destroy');
        Route::get('/secretaires/{id}/edit', [SecretaireController::class, 'edit'])->name('admin.secretaires.edit');
        Route::put('/secretaires/{id}/update', [SecretaireController::class, 'update'])->name('admin.secretaires.update');


        // Gestion des Patients
        Route::get('/patients', [PatientController::class, 'index'])->name('admin.patients.index');
        Route::get('/patients/create', [PatientController::class, 'create'])->name('admin.patients.create');
        Route::post('/patients/store', [PatientController::class, 'store'])->name('admin.patients.store');
        Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('admin.patients.destroy');
        Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('admin.patients.edit');
        Route::put('/patients/{id}', [PatientController::class, 'update'])->name('admin.patients.update');          


        // Gestion des Services
        Route::get('/services', [ServicesController::class, 'index'])->name('admin.services.index');
        Route::get('/services/create', [ServicesController::class, 'create'])->name('admin.services.create');
        Route::post('/services/store', [ServicesController::class, 'store'])->name('admin.services.store');
        Route::delete('/services/{id}', [ServicesController::class, 'destroy'])->name('admin.services.destroy');
        Route::get('/services/{id}/edit', [ServicesController::class, 'edit'])->name('admin.services.edit');
        Route::put('/services/{id}', [PatientController::class, 'update'])->name('admin.services.update'); 


        Route::get('/affectations', [MedecinController::class, 'affectationIndex'])->name('admin.affectations.index');
        Route::post('/affectations/update', [MedecinController::class, 'updateAffectation'])->name('admin.affectations.update');


        // Routes pour le Patient
        
    });



    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

    Route::prefix('patient')->group(function () {
        Route::get('/rendez-vous/nouveau', [App\Http\Controllers\patient\RendezVousController::class, 'create'])->name('patient.rdv.create');
        Route::post('/rendez-vous/store', [App\Http\Controllers\patient\RendezVousController::class, 'store'])->name('patient.rdv.store');
        Route::get('/mes-rendez-vous', [App\Http\Controllers\patient\RendezVousController::class, 'index'])->name('patient.rdv.index');
        // Route pour accéder au dashboard patient
        
    });
    


});


Route::middleware(['auth', 'role:medecin'])->prefix('medecin')->name('medecin.')->group(function () {
    // Route pour le planning et la liste des patients
    Route::get('/planning', [PlanningController::class, 'index'])->name('planning.index');
    
    // Route pour mettre à jour le statut d'un RDV (disponibilité)
    Route::patch('/rdv/{id}/update', [PlanningController::class, 'updateStatus'])->name('rdv.update');
});

 // Assure-toi que le contrôleur existe

Route::middleware(['auth'])->prefix('secretaire')->name('secretaire.')->group(function () {
    
    // Route pour la liste des demandes (celle qui cause l'erreur actuellement)
    Route::get('/demandes', [SecretairesController::class, 'index'])->name('demandes.index');
    
    // Route pour le planning du service
    Route::get('/planning', [SecretairesController::class, 'planning'])->name('planning.index');
    
    // Routes pour les actions sur les RDV
    Route::patch('/rdv/{id}/valider', [SecretairesController::class, 'valider'])->name('rdv.valider');
    Route::patch('/rdv/{id}/refuser', [SecretairesController::class, 'refuser'])->name('rdv.refuser');
    Route::patch('/rdv/{id}/confirmer', [RendezVousController::class, 'confirmer'])->name('rdv.confirmer');
    Route::patch('/rdv/{id}/refuser', [RendezVousController::class, 'refuser'])->name('rdv.refuser');
    Route::patch('/rdv/{id}/update', [RendezVousController::class, 'update'])->name('rdv.update');
});


// Affichage du formulaire d'inscription
Route::get('/inscription', [AuthController::class, 'showRegisterForm'])->name('register');

// Traitement de l'inscription
Route::post('/inscription', [AuthController::class, 'register'])->name('register.store');
