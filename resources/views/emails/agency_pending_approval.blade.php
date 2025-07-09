<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Votre demande est en attente</title>
</head>
<body>
    <h2>Bonjour {{ $agency->manager_name }},</h2>

    <p>Merci d’avoir enregistré votre agence <strong>{{ $agency->name }}</strong> sur notre plateforme.</p>

    <p>Votre demande est en cours de vérification par notre équipe. Vous recevrez un email de confirmation dès que votre agence sera approuvée.</p>

    <p>Nous vous remercions de votre confiance.</p>

    <br>
    <p>Cordialement,</p>
    <p><strong>Équipe de Gestion de la Plateforme</strong></p>
</body>
</html>
