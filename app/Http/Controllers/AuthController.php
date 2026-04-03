<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register'); // Assure-toi que ce fichier existe
    }
    public function handleLogin(AuthRequest $request)
    {
        
        $credentials = $request->only(['email', 'password']);
        if(Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        }else{
            return redirect()->back()->with('error_msg', 'Paramètre de connexion non reconnu');
        }
    }
    // app/Http/Controllers/AuthController.php

// TRÈS IMPORTANT pour le hachage


// ...
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'prenom'   => 'required|string|max:255', 
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'prenom'   => $request->prenom, 
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Le hachage est bien là
        '   role'     => 'patient',
        ]);

    // On ne connecte pas l'utilisateur si on veut qu'il repasse par la page de login
        return redirect()->route('login')->with('success', 'Inscription réussie ! Connectez-vous.');
    }
}


    // La redirection vers la page de connexion
    