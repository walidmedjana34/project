<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/connexion.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <title>Page de Connexion</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                <h1>Créer un Compte</h1>
                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="error-message">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                </div>
                <span>ou utilisez votre email pour vous inscrire</span>
                
            
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Nom" required>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <input type="password" name="password_confirmation" placeholder="Confirmez le mot de passe" required>
              
                <label for="agreement" class="accept">
                    <input type="checkbox" name="agreement" id="agreement" required {{ old('agreement') ? 'checked' : '' }}>
                    <div class="checkmark"></div>
                    J'accepte les conditions d'utilisation
                </label>
                <button type="submit">S'inscrire</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <h1>Se Connecter</h1>
                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="error-message">
                        Email ou mot de passe invalide
                    </div>
                @endif
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <span>ou utilisez votre email et mot de passe</span>
                
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                <input type="password" name="password" placeholder="Mot de passe" required>
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>

             
                <a href="{{ route('user.oblier') }}">Mot de passe oublié ?</a>
                <button>Se Connecter</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Bienvenue à nouveau !</h1>
                    <p>Entrez vos informations personnelles pour utiliser toutes les fonctionnalités du site</p>
                    <button class="hidden" id="login">Se Connecter</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Bonjour, Ami !</h1>
                    <p>Inscrivez-vous avec vos informations personnelles pour utiliser toutes les fonctionnalités du site</p>
                    <button class="hidden" id="register">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>
    <ul class="background">
        <li class="house"></li>
        <li></li>
        <li class="house"></li>
        <li></li>
        <li class="agency"></li>
        <li class="agency"></li>
        <li class="agency"></li>
        <li class="house"></li>
        <li></li>
        <li></li>
     </ul>
    <script src="../assets/js/accueil/connexion.js"></script>
</body>

</html>