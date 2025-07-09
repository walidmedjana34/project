@extends('layouts.app2')
 
@section('title')Profil client @endsection
@section("content")

<div class="cover curved">
    <div class="cover-overlay curved">
        <div class="profile">
            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80" alt="Logo">
            <div>
                <h1>NAME AGENCY</h1>
                <p><i class="fas fa-map-marker-alt"></i> ADRESEAGENYC</p>
            </div>
        </div>
    </div>
</div>

 <!-- Contenu principal -->
<div class="container-profile">
    <!-- Onglets -->
    <div class="tabs">
        <div class="tabs">
            <div class="tab active" data-tab="settings">Paramètres</div>
            {{-- <div class="tab" data-tab="stats">Statistiques</div> --}}
            <div class="tab" data-tab="reservation">mes reservation</div>
            <div class="tab" data-tab="properties">favoris</div>
        </div>
        <div>
            <a href="{{route('home.type-annonce')}}" class="button2">ajouter un bien</a>
        </div>
    </div>

    <!-- Contenu - Propriétés -->
    <div class="content " id="properties">
        <h2>Nos Biens <span>2</span></h2>
        <div class="annonce-list">
            <div class="product">
                <div class="carousel">
                    <span class="badge">À vendre</span>
                    <div class="carousel-inr">
                        <img src="{{ asset('assets/img/accueil image/im2.jpg') }}" class="carousel-item active" alt="Image 1">
                        <img src="{{ asset('assets/img/accueil image/istockphoto-1400379553-612x612.jpg') }}" class="carousel-item" alt="Image 2">
                        <img src="{{ asset('assets/img/accueil image/Na_Nov_06.jpg') }}" class="carousel-item" alt="Image 3">
                    </div>
                    <button class="carousel-control prev">❮</button>
                    <button class="carousel-control next">❯</button>
                </div>
            
                <div class="détails">
                  <h3>Appartement spacieux en centre-ville</h3>
                  <p class="wilaya">Bordj Bou Arreridj</p>
                  <div class="features">
                      <div class="">
                          <span><i class='bx bx-bed'></i> 3</span>
                          <span><i class='bx bx-bath'></i> 2</span>
                          <span><i class='bx bx-square-rounded' ></i> 85 m²</span>
                      </div>
                      
                      <p class="prix">1500<span>DA</span></p>
                  </div>
                </div>
                <div class="button-detail">
                    <a href="{{route('home.details')}}" class="button2 card-button">détails</a>
                </div>
            </div>
            <div class="product">
                <div class="carousel">
                    <span class="badge">À vendre</span>
                    <div class="carousel-inr">
                        <img src="{{ asset('assets/img/accueil image/im2.jpg') }}" class="carousel-item active" alt="Image 1">
                        <img src="{{ asset('assets/img/accueil image/istockphoto-1400379553-612x612.jpg') }}" class="carousel-item" alt="Image 2">
                        <img src="{{ asset('assets/img/accueil image/Na_Nov_06.jpg') }}" class="carousel-item" alt="Image 3">
                    </div>
                    <button class="carousel-control prev">❮</button>
                    <button class="carousel-control next">❯</button>
                </div>
            
                <div class="détails">
                  <h3>Appartement spacieux en centre-ville</h3>
                  <p class="wilaya">Bordj Bou Arreridj</p>
                  <div class="features">
                      <div class="">
                          <span><i class='bx bx-bed'></i> 3</span>
                          <span><i class='bx bx-bath'></i> 2</span>
                          <span><i class='bx bx-square-rounded' ></i> 85 m²</span>
                      </div>
                      
                      <p class="prix">1500<span>DA</span></p>
                  </div>
                </div>
                <div class="button-detail">
                    <a href="{{route('home.details')}}" class="button2 card-button">détails</a>
                </div>
            </div> 
        </div>
        
    </div>

    <!-- Contenu - Paramètres -->
    <div class="content active" id="settings">
        <h2>Paramètres</h2>
        <div class="agence-information">
                <div class="form-group">
                  <div class="form-field">
                    <label for="agency-name">Nom de l'agence </label>
                    <input type="text" class="inp-area" id="name" name="name" placeholder="Entrez le nom de l'agence" required>
                  </div>
                  <div class="form-field">
                    <label for="agency-email">Email </label>
                    <input type="email" class="inp-area"  id="email" name="email" placeholder="Entrez l'email de l'agence" required>
                  </div>
                </div>
              
                <div class="form-group">
                  <div class="form-field">
                    <label for="agency-contact">Numéro de téléphone </label>
                    <input type="tel" class="inp-area"  id="phone_number" name="phone_number" placeholder="Entrez le numéro de téléphone" required>
                  </div>
                  <div class="form-field">
                    <label for="agency-address">Adresse :</label>
                    <textarea id="address" class="inp-area area"  name="address" rows="3" placeholder="Entrez l'adresse complète de l'agence" required></textarea>
                  </div>
                </div>

              
                <div class="form-group" style="flex-direction: column;">
                    <label for="description">Description </label>
                    <textarea id="description" class="inp-area"  name="description" rows="4" placeholder="Description de l'agence"></textarea>
                </div>
              
                <button class="button2">enregistrer les modifications</button>
        </div> 
    </div>

    <div class="content client-visits-section" id="reservation">
        <h2><i class='bx bxs-calendar-check'></i> Mes visites programmées</h2>
      
        <!-- Exemple d'entrée (à afficher dynamiquement depuis le backend) -->
        <div class="visit-card">
            <h3>Appartement moderne au centre-ville</h3>
            <p>Géré par <strong>Immobilier Prestige</strong></p>
            <p><i class='bx bx-calendar' style="color: #0092ca"></i> 22 avril 2025 à 10:00</p>
            <p><i class='bx bx-phone' style="color: #0092ca"></i> 0555 12 34 56</p>
            <p>Notes : Je suis disponible uniquement le matin.</p>
          
            <div class="visit-card-actions">
              <button class="btn-visit edit"><i class='bx bx-edit'></i> Modifier</button>
              <button class="btn-visit cancel"><i class='bx bx-trash'></i> Annuler</button>
              <!-- <button class="btn-visit contact"><i class='bx bx-message-detail'></i> Contacter l'agence</button> -->
            </div>
        </div>
    </div>
      
</div>

<script>
    document.querySelectorAll(".tab").forEach(tab => {
        tab.addEventListener("click", function() {
            document.querySelectorAll(".tab").forEach(t => t.classList.remove("active"));
            document.querySelectorAll(".content").forEach(c => c.classList.remove("active"));

            this.classList.add("active");
            document.getElementById(this.dataset.tab).classList.add("active");
        });
    });
</script>
@endsection