@extends('layouts.app2')
 
@section('title')Profil Agence @endsection
@section("content") 
    <!-- Image de couvertuare -->
    <div class="cover ">
        <div class="cover-overlay ">
            <div class="profile" >
                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80" alt="Logo">
                <div>
                    <h1>{{ $agency->name }}</h1>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $agency->address }}</p>
                </div>
            </div>
        </div>
    </div>

     <!-- Contenu principal -->
    <div class="container-profile">
        <!-- Onglets -->
        <div class="tabs">
            <div class="tabs">
                <div class="tab active" data-tab="properties">Propriétés</div>
                <div class="tab" data-tab="stats">Statistiques</div>
                <div class="tab" data-tab="settings">Paramètres</div>
            </div>
            <div>
                <a href="{{route('home.ajouter_annonce')}}" class="button2">ajouter un bien</a>
            </div>
        </div>

        <!-- Contenu - Propriétés -->
        <div class="content active" id="properties">
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

        <!-- Contenu - Statistiques -->
        <div class="content" id="stats">
            <h2>Statistiques</h2>
            <div class="stats">
                <div>
                    <h3>45</h3>
                    <p>Biens</p>
                </div>
                <div>
                    <h3>120</h3>
                    <p>Ventes</p>
                </div>
                <div>
                    <h3>1500</h3>
                    <p>Vues</p>
                </div>
                <div>
                    <h3>4.8</h3>
                    <p>Note</p>
                </div>
            </div>
        </div>

        <!-- Contenu - Paramètres -->
        <div class="content" id="settings">
            <h2>Paramètres</h2>
            <p>Fonctionnalité en cours de développement...</p>
        </div>
    </div>

    <script>
        // Gestion des onglets
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