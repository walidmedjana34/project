<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/type-annonce.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>type annonce</title>
</head>
<body>
  <div class="ad-type-container">
    <h2>Quel type d'annonce souhaitez-vous publier ?</h2>
    <div class="ad-type-options">
      <a class="ad-option" href="{{route('annonces.create')}}">
        <div class="icon-circle">
          <i class='bx bxs-building'></i>
        </div>
        <h3>Propriété à vendre/louer</h3>
        <p>Publiez une annonce pour un appartement, une maison, un bureau ou un terrain à vendre ou à louer.</p>
      </a>
      <a class="ad-option" href="{{route('home.ajouter_vacance')}}">
        <div class="icon-circle">
          <i class='bx bxs-tree'></i>
        </div>
        <h3>Location de vacances</h3>
        <p>Publiez une annonce pour une location saisonnière ou de courte durée pour les vacanciers.</p>
      </a>
    </div>
  </div>
      
</body>
</html>