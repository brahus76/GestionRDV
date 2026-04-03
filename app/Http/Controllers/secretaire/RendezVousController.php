<?php

namespace App\Http\Controllers\secretaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rendez_vous_table;
use Auth;

class RendezVousController extends Controller
{
    /**
     * Valider le rendez-vous (Statut passe à 'confirme')
     */
    public function confirmer($id)
    {
        $rdv = rendez_vous_table::findOrFail($id);
        
        // Sécurité : Vérifier que le RDV appartient au service du secrétaire
        if ($rdv->service_id !== Auth::user()->service_id) {
            return back()->with('error', 'Action non autorisée pour ce service.');
        }

        $rdv->update(['statut' => 'confirme']);

        return back()->with('success', 'Rendez-vous confirmé avec succès.');
    }

    /**
     * Refuser le rendez-vous (Statut passe à 'annule')
     */
    public function refuser($id)
    {
        $rdv = rendez_vous_table::findOrFail($id);
        
        if ($rdv->service_id !== Auth::user()->service_id) {
            return back()->with('error', 'Action non autorisée.');
        }

        $rdv->update(['statut' => 'annule']);

        return back()->with('error', 'Le rendez-vous a été refusé.');
    }

    /**
     * Reprogrammer (Exigence : changer la date/heure)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'date_heure' => 'required|date|after:now',
        ]);

        $rdv = rendez_vous_table::findOrFail($id);
        $rdv->update([
            'date_heure' => $request->date_heure,
            'statut' => 'en_attente' // On peut repasser en attente ou laisser confirmé
        ]);

        return back()->with('success', 'Rendez-vous reprogrammé au ' . $request->date_heure);
    }
}