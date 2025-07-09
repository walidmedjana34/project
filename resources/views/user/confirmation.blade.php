<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation du code</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/connexion.css">
    <style>
        .code-confirmation-container {
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
        }

        .code-confirmation-container h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .code-confirmation-container p {
            font-size: 14px;
            line-height: 20px;
            text-align: center;
            margin-bottom: 30px;
        }

        .code-confirmation-container input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .code-confirmation-container button {
            border-radius: 20px;
            border: 1px solid #1565c0;
            background-color: #1565c0;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-top: 20px;
            cursor: pointer;
        }

        .code-confirmation-container .back-link {
            margin-top: 20px;
            font-size: 14px;
        }

        .success-message, .error-message {
            margin-bottom: 20px;
            color: #d32f2f;
        }

        .success-message {
            color: green;
        }
    </style>
</head>
<body>
    <div class="code-confirmation-container">
        <h1>Code de confirmation</h1>
        <p>Veuillez entrer le code que vous avez reçu par e-mail pour continuer la réinitialisation du mot de passe.</p>

        @if(session('status'))
            <div class="success-message">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="error-message">
                @foreach($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.verify.code') }}">
            @csrf
            <input type="hidden" name="email" value="{{ session('reset_email') }}">
            <input type="text" name="code" placeholder="Entrez le code reçu" required>
            <button type="submit">Valider le code</button>
        </form>

        <div class="back-link">
            <a href="{{ route('home.connexion') }}">Retour à la connexion</a>
        </div>
    </div>
</body>
</html>
