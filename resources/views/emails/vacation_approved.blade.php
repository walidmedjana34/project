<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Annonce Approuvée</title>
</head>
<body>
    <h2>Bonjour {{ $vacance->user->name ?? 'utilisateur' }},</h2>
    <p>Votre annonce <strong>{{ $vacance->titre }}</strong> a été approuvée par l'administration !</p>
    <p>Elle est maintenant visible sur notre plateforme. Merci pour votre confiance.</p>
    <p>— L'équipe de gestion</p>
</body>
</html>
