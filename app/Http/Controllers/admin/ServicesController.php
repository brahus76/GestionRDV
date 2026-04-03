<?php

namespace App\Http\Controllers\Admin;

use App\Models\services_table; // On utilise l'unique modèle correct
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    public function index() {
        $services = services_table::all();
        return view('admin.services.index', compact('services'));
    }

    public function create() {
        return view('admin.services.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nom' => 'required|unique:services,nom'
        ]);
        
        services_table::create([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service créé !');
    }

    public function destroy($id) {
        services_table::findOrFail($id)->delete();
        return redirect()->route('admin.services.index');
    }


    public function edit($id) {
        $service = services_table::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id) {
        $service = services_table::findOrFail($id);
    
        $request->validate([
            'nom' => 'required|unique:services,nom,' . $id
        ]);

        $service->update([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service mis à jour !');
    }
}