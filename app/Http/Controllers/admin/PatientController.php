<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function index() {
        $patients = User::where('role', 'patient')->get();
        return view('admin.patients.index', compact('patients'));
    }

    public function create() {
        return view('admin.patients.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'telephone' => 'required', // Donnée spécifique au patient
        ]);

        User::create([
            'name' => $request->name,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => bcrypt('patient123'),
            'role' => 'patient',
            'telephone' => $request->telephone,
        ]);

        return redirect()->route('admin.patients.index')->with('success', 'Patient enregistré !');
    }

    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.patients.index');
    }

    public function edit($id) {
        $patient = User::where('role', 'patient')->findOrFail($id);
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, $id) {
        $patient = User::findOrFail($id);
    
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'telephone' => 'required',
        ]);

        $patient->update($request->all());

        return redirect()->route('admin.patients.index')->with('success', 'Patient mis à jour !');
    }
}