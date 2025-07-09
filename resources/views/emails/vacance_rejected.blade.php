<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Annonce refusée</title>
</head>
<body>
    <h2>Bonjour {{ $vacance->user->name ?? 'Utilisateur' }},</h2>

    <p>Nous vous remercions d’avoir soumis votre annonce <strong>"{{ $vacance->titre }}"</strong>.</p>

    <p>Après vérification, nous vous informons que votre annonce a été <strong>refusée</strong> car elle ne répond pas à nos critères de publication.</p>

    <p>Vous pouvez la modifier et la soumettre à nouveau ou contacter notre équipe pour plus d’informations.</p>

    <br>
    <p>Cordialement,</p>
    <p><strong>L’équipe de gestion de la plateforme</strong></p>
</body>
</html>
