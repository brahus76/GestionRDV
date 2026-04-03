<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\rendez_vous_table;
use App\Models\services_table;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NouveauRendezVous;

class RendezVousController extends Controller
{
    /**
     * Affiche la liste des rendez-vous du patient connecté.
     */
    public function index()
    {
        $rendezvous = rendez_vous_table::where('patient_id', Auth::id())
            ->with(['medecin', 'service'])
            ->orderBy('date_heure', 'desc') // On affiche les plus récents en premier
            ->get();
            
        return view('patient.dashboard', compact('rendezvous'));
    }

    /**
     * Formulaire de création de demande de rendez-vous.
     */
    public function create()
    {
        $services = services_table::all();
        $medecins = User::where('role', 'medecin')->get();

        return view('patient.rdv.create', compact('services', 'medecins'));
    }

    /**
     * Enregistre le rendez-vous et notifie les secrétaires du service.
     */
    public function store(Request $request) 
    {
        // Validation des données entrantes
        $request->validate([
            'medecin_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:App\Models\services_table,id',
            'date_heure' => 'required|date|after:now',
            'motif'      => 'required|string|max:255',
        ]);

        // 1. Création du rendez-vous
        $rdv = rendez_vous_table::create([
            'patient_id' => Auth::id(),
            'medecin_id' => $request->medecin_id,
            'service_id' => $request->service_id,
            'date_heure' => $request->date_heure,
            'motif'      => $request->motif,
            'type'       => $request->type ?? 'normal',
            'statut'     => 'en_attente',
        ]);

        // 2. MÉCANISME DE NOTIFICATION NATIVE
        // On récupère uniquement les secrétaires affectés au service demandé
        $secretaires = User::where('role', 'secretaire')
                           ->where('service_id', $request->service_id)
                           ->get();

        // Envoi de la notification via le système natif (Canal Database)
        if ($secretaires->count() > 0) {
            Notification::send($secretaires, new NouveauRendezVous($rdv));
        }

        // Redirection avec un message de succès dynamique
        return redirect()->route('patient.rdv.index')
            ->with('success', 'Votre demande a été envoyée avec succès au service ' . $rdv->service->nom . '.');
    }
}