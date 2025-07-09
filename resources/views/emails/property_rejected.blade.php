<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Annonce refusée</title>
</head>
<body>
    <h2>Bonjour {{ $property->user->name ?? 'Utilisateur' }},</h2>

    <p>Nous vous informons que votre annonce <strong>"{{ $property->title }}"</strong> a été <strong>refusée</strong> après révision par notre équipe.</p>

    <p>Motif possible : informations incomplètes ou non conformes à nos critères.</p>

    <p>Nous vous invitons à la modifier et à la soumettre à nouveau.</p>

    <p>Merci de votre compréhension.</p>

    <br>
    <p>Cordialement,</p>
    <p><strong>L’équipe de la plateforme</strong></p>
</body>
</html>
