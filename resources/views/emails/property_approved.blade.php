<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonce Approuvée</title>
</head>
<body>
    <p>Bonjour {{ $property->user->name ?? 'Utilisateur' }},</p>
    <p>Votre annonce <strong>{{ $property->title }}</strong> a été approuvée avec succès.</p>
    <p>Merci pour votre confiance.</p>
</body>
</html>
