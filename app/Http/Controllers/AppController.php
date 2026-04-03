<?php

namespace App\Http\Controllers;

use App\Models\services_table;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $TotalMedecin = User::where('role','medecin')->count();
        $Totalsecretaire = User::where('role','secretaire')->count();
        $Totalpatient = User::where('role','patient')->count();
        $Totalservice = services_table::all()->count();
        $recents_medecins = User::where('role', 'medecin')->latest()->take(5)->get();
        $recents_patients = User::where('role', 'patient')->latest()->take(5)->get();
        return view('dashboard',compact('TotalMedecin', 'Totalservice','Totalsecretaire','Totalpatient','recents_medecins', 'recents_patients'));
    }
}
