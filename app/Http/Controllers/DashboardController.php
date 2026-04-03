<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();
    $stats = [];
    $rendezvous = collect();
    $medecins = collect();

    if ($user->role == 'admin') {
        $stats = [
            'medecins' => \App\Models\User::where('role', 'medecin')->count(),
            'secretaires' => \App\Models\User::where('role', 'secretaire')->count(),
            'patients' => \App\Models\User::where('role', 'patient')->count(),
            'services' => \App\Models\services_table::count(),
        ];
        // On récupère les médecins et leur service associé
        $medecins = \App\Models\User::where('role', 'medecin')->with('service')->latest()->take(5)->get();
        
    } elseif ($user->role == 'patient') {
        $rendezvous = \App\Models\rendez_vous_table::where('patient_id', $user->id)
            ->with(['medecin', 'service'])
            ->latest()
            ->get();
    }

    return view('dashboard', compact('stats', 'rendezvous', 'medecins'));
}
}
