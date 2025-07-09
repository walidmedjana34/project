<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/connexion.css">
    <title>Réinitialisation du mot de passe</title>
    <style>
        .password-reset-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
            margin: 40px auto;
            padding: 0 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 10;
        }

        .password-reset-container h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .password-reset-container p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
            text-align: center;
        }

        .password-reset-container input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .password-reset-container button {
            border-radius: 20px;
            border: 1px solid #1565c0;
            background-color: #1565c0;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            margin-top: 20px;
            cursor: pointer;
        }

        .back-to-login {
            margin-top: 20px;
            text-align: center;
        }

        .back-to-login a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="password-reset-container">
        <h1>Réinitialiser votre mot de passe</h1>
        <p>Entrez votre nouveau mot de passe</p>
        
        @if(session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="error-message">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.change') }}">
            @csrf
            <input type="hidden" name="token" value="{{ session('token') }}">
            <input type="email" name="email" value="{{ session('reset_email') }}" readonly required>
            <input type="password" name="password" placeholder="Nouveau mot de passe" required>
            <input type="password" name="password_confirmation" placeholder="Confirmez le mot de passe" required>
            <button type="submit">Réinitialiser le mot de passe</button>
        </form>
        

        <div class="back-to-login">
            <a href="home.connexion">Retour à la page de connexion</a>
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
</body>
</html>