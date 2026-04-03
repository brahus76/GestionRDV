<?php

namespace App\Http\Controllers\secretaire;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rendez_vous_table;
use App\Models\User; // Ajouté pour la gestion du planning

class SecretairesController extends Controller
{
    /**
     * Liste des demandes de rendez-vous du service
     */
    public function index()
    {
        $serviceId = Auth::user()->service_id; 

        $demandes = rendez_vous_table::where('service_id', $serviceId)
                    ->where('statut', 'en_attente')
                    ->with(['patient', 'medecin'])
                    ->orderBy('date_heure', 'asc')
                    ->get();

        // Vérifie si ta vue est dans resources/views/secretaire/demandes.blade.php
        return view('secretaire.demandes', compact('demandes'));
    }

    /**
     * Consulter le planning des médecins du service
     */
    public function planning()
    {
        $serviceId = Auth::user()->service_id;

        // Récupère les médecins du même service avec leurs rendez-vous confirmés
        $medecins = User::where('role', 'medecin')
                    ->where('service_id', $serviceId)
                    ->with(['rendezvousAsMedecin' => function($query) {
                        $query->where('statut', 'confirme');
                    }])
                    ->get();

        return view('secretaire.planning', compact('medecins'));
    }

    /**
     * Valider une demande
     */
    public function valider(Request $request, $id)
    {
        $rdv = rendez_vous_table::findOrFail($id);
        $rdv->update(['statut' => 'confirme']);
    
        return back()->with('success', 'Rendez-vous validé avec succès.');
    }

    /**
     * Refuser une demande (Exigence du cahier des charges)
     */
    public function refuser(Request $request, $id)
    {
        $rdv = rendez_vous_table::findOrFail($id);
        $rdv->update(['statut' => 'annule']);
    
        return back()->with('error', 'Le rendez-vous a été refusé.');
    }
}