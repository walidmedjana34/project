<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Visite Confirmée</title>
</head>
<body>
    <h2>Bonjour {{ $visit->user->name ?? 'Utilisateur' }},</h2>

    <p>Nous vous confirmons que votre visite pour :</p>
    <p>
        <strong>
            @if($visit->property)
                {{ $visit->property->title }} à {{ $visit->property->address }}
            @elseif($visit->vacance)
                {{ $visit->vacance->title }} à {{ $visit->vacance->address }}
            @endif
        </strong>
    </p>
    <p>a été <strong>confirmée</strong> pour le <strong>{{ $visit->scheduled_date->format('l d F Y à H:i') }}</strong>.</p>

    <p>Merci pour votre confiance,</p>
    <p>L’équipe Agence</p>
</body>
</html>
