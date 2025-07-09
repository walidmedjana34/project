<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Visite Annulée</title>
</head>
<body>
    <h2>Bonjour {{ $visit->user->name ?? 'Utilisateur' }},</h2>

    <p>Nous vous informons que votre demande de visite pour :</p>
    <p>
        <strong>
            @if($visit->property)
                {{ $visit->property->title }} à {{ $visit->property->address }}
            @elseif($visit->vacance)
                {{ $visit->vacance->title }} à {{ $visit->vacance->address }}
            @endif
        </strong>
    </p>

    <p>a été <strong>annulée</strong>.</p>

    <p>Pour toute question, n’hésitez pas à nous contacter.</p>

    <p>Cordialement,<br>L’équipe Agence</p>
</body>
</html>
