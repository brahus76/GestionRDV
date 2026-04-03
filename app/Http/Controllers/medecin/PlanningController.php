<?php

namespace App\Http\Controllers\medecin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rendez_vous_table;
use App\Models\User;
use Auth;

class PlanningController extends Controller
{
    public function index()
    {
        $medecinId = Auth::id();

        // Récupérer le planning (RDV confirmés ou en attente)
        $planning = rendez_vous_table::where('medecin_id', $medecinId)
            ->with('patient')
            ->orderBy('date_heure', 'asc')
            ->get();

        // Récupérer la liste unique des patients du médecin
        $patients = User::whereHas('rendezvousAsMedecin', function($query) use ($medecinId) {
            $query->where('medecin_id', $medecinId);
        })->distinct()->get();

        return view('medecin.planning.index', compact('planning', 'patients'));
    }

    // Méthode pour gérer la disponibilité (ex: marquer un créneau comme occupé)
    public function updateStatus(Request $request, $id)
    {
        $rdv = rendez_vous_table::where('medecin_id', Auth::id())->findOrFail($id);
        $rdv->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut mis à jour avec succès.');
    }
}
