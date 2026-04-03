<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SecretaireController extends Controller
{
    public function index() {
        // On ne récupère que les utilisateurs ayant le rôle 'secretaire'
        $secretaires = User::where('role', 'secretaire')->get();
        return view('admin.secretaires.index', compact('secretaires'));
    }

    // Affiche le formulaire d'édition
    public function edit($id)
    {
        // On récupère le secrétaire ou on renvoie une erreur 404
        $secretaire = User::where('role', 'secretaire')->findOrFail($id);
        
        return view('admin.secretaires.edit', compact('secretaire'));
    }

    public function create() {
        return view('admin.secretaires.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => bcrypt('password123'),
            'role' => 'secretaire', // Différenciation cruciale ici
        ]);

        return redirect()->route('admin.secretaires.index')->with('success', 'Secrétaire ajoutée !');
    }

    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.secretaires.index');
    }

    
}


