<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
    <title>Inscription Patient</title>
</head>
<body>
   <form method="POST" action="{{ route('register.store') }}">
    @csrf {{-- INDISPENSABLE pour éviter l'erreur 419 --}}
    
    <div class="box">
        <h1>Créer un compte</h1>

        {{-- Champ Nom --}}
        <input type="text" name="name" class="email" placeholder="Nom de famille" value="{{ old('name') }}" required>
        
        {{-- Champ Prénom (Ajouté) --}}
        <input type="text" name="prenom" class="email" placeholder="Prénom" value="{{ old('prenom') }}" required>

        {{-- Champ Email --}}
        <input type="email" name="email" class="email" placeholder="Email" value="{{ old('email') }}" required>
        @error('email') <span style="color:red; font-size:10px;">{{ $message }}</span> @enderror

        {{-- Champ Mot de passe --}}
        <input type="password" name="password" class="email" placeholder="Mot de passe" required>
        
        {{-- Confirmation --}}
        <input type="password" name="password_confirmation" class="email" placeholder="Confirmer le mot de passe" required>

        <div class="btn-container">
            <button type="submit">S'inscrire</button>
        </div>
    </div>
</form>
</body>
</html>