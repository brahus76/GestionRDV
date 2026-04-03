<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
class MedecinController extends Controller
{
    public function index(Request $request) 
    {
        $query = User::where('role', 'medecin');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('matricule', 'like', '%' . $request->search . '%');
        }

        $medecins = $query->get();
        return view('admin.medecins.index', compact('medecins'));
    }




    // Cette fonction manquante est la cause de ton erreur 500
    public function create()
    {
        return view('admin.medecins.create');
    }

    public function edit($id)
    {
    // 1. Utilise le singulier $medecin
        $medecin = User::where('role', 'medecin')->findOrFail($id);
    
    // 2. Utilise le bon nom de modèle (sans le 's' à services)
        $services = \App\Models\services_table::all(); 
    
    // 3. Ici 'medecin' correspond maintenant bien à $medecin
        return view('admin.medecins.edit', compact('medecin', 'services'));
    }

    // Enregistre un nouveau médecin (Action du bouton Ajouter)
    public function store(Request $request) {
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'matricule' => 'required|unique:users',
        // Ajoute les autres validations selon ta table users
    ]);

    User::create([
        'name' => $request->name,
        'prenom' => $request->prenom,
        'email' => $request->email,
        'password' => bcrypt('password123'), // Mot de passe par défaut
        'role' => 'medecin',
        'matricule' => $request->matricule,
        'specialite' => $request->specialite,
    ]);
        // Remplace : return redirect()->route('medecins.index')...
// Par :
        return redirect()->route('admin.medecins.index')->with('success', 'Médecin ajouté !');
    }

    // Supprime un médecin (Action du bouton Supprimer)
    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.medecins.index');
    }



    public function update(Request $request, $id)
    {
        $medecin = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'matricule' => 'required|unique:users,matricule,' . $id,
        ]);

        $medecin->update([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'matricule' => $request->matricule,
            'specialite' => $request->specialite,
            'service_id' => $request->service_id, // Important pour l'affectation
        ]);

        return redirect()->route('admin.medecins.index')->with('success', 'Médecin mis à jour !');
    }


    public function affectationIndex()
    {
        $medecins = User::where('role', 'medecin')->get();
        $services = \App\Models\services_table::all();
        return view('admin.affectations.index', compact('medecins', 'services'));
    }

    public function updateAffectation(Request $request)
    {
        $medecin = User::findOrFail($request->medecin_id);
        $medecin->service_id = $request->service_id;
        $medecin->save();

        return redirect()->back()->with('success', 'Médecin affecté avec succès !');
    }
}


