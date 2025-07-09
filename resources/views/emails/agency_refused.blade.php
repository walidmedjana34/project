<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Refus d’enregistrement</title>
</head>
<body>
    <h2>Bonjour {{ $agency->manager_name }},</h2>

    <p>Nous vous remercions pour votre inscription de l’agence <strong>{{ $agency->name }}</strong>.</p>

    <p>Après examen, nous vous informons que votre demande d'enregistrement n’a pas été approuvée.</p>

    <p>Raison possible : informations incomplètes ou non conformes à nos critères.</p>

    <p>Vous pouvez réessayer avec des documents valides ou nous contacter pour plus de détails.</p>

    <br>
    <p>Cordialement,</p>
    <p><strong>L’équipe de gestion</strong></p>
</body>
</html>
