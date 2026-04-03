<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion | GEST-RDV</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}" />
</head>
<body>
    
    <form method="POST" action="{{ route('handleLogin') }}">
        @csrf
        {{-- Note : @method('POST') est inutile ici car le form est déjà en method="POST" --}}
        
        <div class="box">
            <h1>Espace de connexion</h1>
            
            {{-- Message d'erreur global --}}
            @if (session('error_msg'))
                <div style="margin-bottom: 15px;">
                    <b style="font-size: 12px; color: #cc0000;">{{ session('error_msg') }}</b>
                </div>
            @endif

            {{-- Champ Email --}}
            <div class="input-group">
                <input type="email" 
                       name="email" 
                       class="email @error('email') is-invalid @enderror" 
                       placeholder="Votre adresse email"
                       value="{{ old('email') }}" 
                       required 
                       autofocus />
                @error('email')
                    <span style="color: red; font-size: 10px;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Champ Mot de passe --}}
            <div class="input-group">
                <input type="password" 
                       name="password" 
                       class="email @error('password') is-invalid @enderror" 
                       placeholder="Votre mot de passe"
                       required />
                @error('password')
                    <span style="color: red; font-size: 10px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="btn-container">
                <button type="submit">Se connecter</button>
            </div>

            <div style="margin-top: 20px; font-size: 13px;">
                <p>Pas encore de compte ? <a href="{{ route('register') }}" style="color: #4facfe;">Inscrivez-vous ici</a></p>
            </div>
        </div>
    </form>
</body>
</html>