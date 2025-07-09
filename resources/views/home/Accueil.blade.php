@extends('layouts.app2')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title') Accueil  @endsection
@section("content")
<section class="hero-section curved hidden">
    <div class="hero-content">
        <h1 class="hidden slide-left">Trouvez votre propriété idéale</h1>
        <div class="prg hidden slide-left">
            <p>Parcourez des milliers de propriétés d'agences immobilières vérifiées</p>
        </div>
        
        <form method="GET" action="{{ route('home.annonces') }}" class="search-bar hidden slide-right" >
            <div class="input-container">
                <input type="text" name="search" placeholder="Search for properties..." value="{{ request('search') }}">
            </div>
            <button type="submit" class="button2 search-bttn">
                <i class='bx bx-search-alt-2'></i> 
            </button>
        </form>
    </div>
</section>
    <div class="container">
        <section class="annonce-prd  " style="margin-top:20px;border-radius:8px;">
            <h2 class="hidden slide-up">Découvrez nos dernières annonces</h2>
            <div class="annonce-list" >
                @foreach($annonces as $annonce)
                <div class="product  hidden slide-up">
                    <div class="carousel">
                        @if($annonce->agency)
    @if($annonce->agency->is_premium)
        <span class="badge-premium">Premium</span>
    @elseif($annonce->agency->is_pro)
        <span class="badge-pro">Pro</span>
    @endif
@endif


                        <span class="badge">À vendre</span>
                        <div class="carousel-inr">
                            @if($annonce->main_image)
                                @php
                                    $images = json_decode($annonce->main_image);
                                @endphp
                                
                                @foreach($images as $index => $image)
                                    <img src="{{ asset($image) }}" class="carousel-item {{ $index === 0 ? 'active' : '' }}" alt="Property Image">
                                @endforeach
                            @else
                                <img src="{{ asset('assets/img/accueil image/im2.jpg') }}" class="carousel-item active" alt="Default Image">
                            @endif
                        </div>
                        <button class="carousel-control prev">❮</button>
                        <button class="carousel-control next">❯</button>
                    </div>
                
                    <div class="détails">
                      <p class="prix">{{ $annonce->price }} <span>DA</span></p>
                      <h3>{{ $annonce->title }}</h3>
                      <p class="wilaya">{{ $annonce->wilaya }}</p>
                      <div class="features">
                          <div class="iconss">
                              <span><i class='bx bx-bed'></i> {{ $annonce->bedrooms ?? 'N/A' }}</span>
                              <span><i class='bx bx-bath'></i> {{ $annonce->bathrooms ?? 'N/A' }}</span>
                              <span><i class='bx bx-square-rounded' ></i> {{ $annonce->surface ?? 'N/A' }} m²</span>
                          </div>
                      </div>
                    </div>
                    <div class="button-detail">
                        <p class="type_ann">{{ $annonce->type }}</p>
                        <a href="{{ route('home.detaills', $annonce->id) }}" class="button2 pr">Détails</a>
                    </div>
                </div>
                @endforeach
               
                </div>
            <div class="voir-plus">
                <a href="{{route('home.annonces')}}" class="button2 hidden slide-up">Plus d'annonces</a>
            </div>
        </section>
        
        {{-- <div class="register-banner">
            <p>⚡ Vous êtes une agence immobilière ? Rejoignez-nous et accédez à des milliers de clients potentiels !</p>
            <a href="{{route('agence.inscription')}}" class="register-btn ">Créer un compte agence</a>
        </div> --}}
        
        <section class="ville">
            <div class="inf">
                <h2 class="hidden slide-up">Découvrez les villes</h2>
                <p class="hidden slide-up">Voici les annonces dans quelques villes</p>
            </div>
    
            <div class="card">
                <a class="boxes  hidden slide-up alger" href="{{ route('home.annonces', ['wilaya' => '16']) }}">
                    <span>Alger</span>
                    <p>voir annonces immobilière</p>
                </a>
                <a class="boxes  hidden slide-up oran" href="{{ route('home.annonces', ['wilaya' => '31']) }}">
                    <span>Oran</span>
                    <p>voir annonces immobilière</p>
                </a>
                <a class="boxes  hidden slide-up  annaba" href="{{ route('home.annonces', ['wilaya' => '23']) }}">
                    <span>Annaba</span>
                    <p>voir annonces immobilière</p>
                </a>
                <a class="boxes  hidden slide-up setif" href="{{ route('home.annonces', ['wilaya' => '19']) }}">
                    <span>Setif</span>
                    <p>voir annonces immobilière</p>
                </a>
            </div>
        </section>
        
        <section class="services-section">
            <h2 class="services-title">Nos services immobiliers</h2>
            <p class="services-subtitle">
              Découvrez notre gamme complète de services pour vous accompagner dans tous vos projets immobiliers.
            </p>
        
            <div class="services-container">
              <!-- Bloc 1 -->
              <div class="service-item item hidden slide-left">
                <div class="service-icon"><i class='bx bx-search-alt'></i></div>
                <h3 class="service-heading" style="text-align: center">Recherche personnalisée</h3>
                <p class="service-description">
                  Nous trouvons le bien qui correspond parfaitement à vos critères et à votre budget.
                </p>
              </div>
        
              <!-- Bloc 2 -->
              <div class="service-item item hidden slide-left">
                <div class="service-icon" ><i class='bx bx-analyse'></i></div>
                <h3 class="service-heading"style="text-align: center">Estimation gratuite</h3>
                <p class="service-description">
                  Obtenez une évaluation précise de votre bien immobilier basée sur le marché actuel.
                </p>
              </div>
        
              <!-- Bloc 3 -->
              <div class="service-item  item hidden slide-left">
                <div class="service-icon"><i class='bx bx-file'></i></div>
                <h3 class="service-heading" style="text-align: center">Gestion administrative</h3>
                <p class="service-description">
                  Nous nous occupons de toutes les démarches administratives liées à votre transaction.
                </p>
              </div>
        
              <!-- Bloc 4 -->
              <div class="service-item item hidden slide-left">
                <div class="service-icon"><i class='bx bx-wallet'></i></div>
                <h3 class="service-heading" style="text-align: center">Financement</h3>
                <p class="service-description">
                  Nos conseillers vous aident à trouver les meilleures solutions de financement pour votre projet.
                </p>
              </div>
            </div>
        </section>
        
        <section class="section-agence">
            <div class="agence-container">
              <div class="agence-texte">
                <i class='bx bx-buildings agence-icone'></i>
                <h2 class="agence-titre  hidden slide-up">Vous êtes une agence immobilière ?</h2>
                <p class="agence-soustitre  hidden slide-up">Rejoignez-nous et accédez à des milliers de clients potentiels !</p>
                <a href="{{route('agence.inscription')}}" class="button2  hidden slide-up">Créer un compte</a>
              </div>
            </div>
        </section>

        <section class="contact-form" id="contact">
            <div class="logo-email hidden slide-left">
              
            </div>
            <div class="form">
                <form id="contact-frm" action="{{ route('message.store') }}" method="POST">
                    @csrf
                    <h2 class="hidden slide-up">Contactez-Nous</h2>
                  
                    <!-- Name input -->
                    <div class="form-inp">
                        <input type="text" id="name" name="name" class="form-control hidden slide-up" value="{{ old('name') }}" required />
                        <label class="form-label hidden slide-up" for="name">Name</label>
                        @error('name')
                            <span class="text-danger hidden slide-up">{{ $message }}</span>
                        @enderror
                    </div>
                  
                    <!-- Email input -->
                    <div class="form-inp">
                        <input type="email" id="email" name="email" class="form-control hidden slide-up" value="{{ old('email') }}" required />
                        <label class="form-label hidden slide-up" for="email">Email address</label>
                        @error('email')
                            <span class="text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                  
                    <!-- Subject input -->
                    <div class="form-inp">
                        <input type="text" id="subject" name="subject" class="form-control hidden slide-up" value="{{ old('subject') }}" required />
                        <label class="form-label hidden slide-up" for="subject">Subject</label>
                        @error('subject')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                  
                    <!-- Message input -->
                    <div class="form-inp">
                        <textarea class="form-control hidden slide-up" id="message" name="message" rows="4" required>{{ old('message') }}</textarea>
                        <label class="form-label hidden slide-up" for="message">Message</label>
                        @error('message')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                  
                    <!-- Submit button -->
                    <button id="submit-frm"  type="submit " class="button2 hidden slide-up">
                        Envoyer
                    </button>
            
                    @if(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                </form>
            </div>
        </section>
    </div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        function toggleFilters() {
            let filterBox = document.getElementById("filterBox");
            filterBox.style.display = (filterBox.style.display === "none" || filterBox.style.display === "") ? "block" : "none";
        }
        
        document.getElementById("toggleFilter").addEventListener("click", toggleFilters);
        document.getElementById("closeFilter").addEventListener("click", toggleFilters);
    });

    document.addEventListener('DOMContentLoaded', () => {
        const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
        if (entry.isIntersecting) {
         entry.target.classList.add('show');
         observer.unobserve(entry.target); // Pour éviter l'animation répétée
        }
        });
        });
        
        const elementsToReveal = document.querySelectorAll('.hidden');
        elementsToReveal.forEach(el => observer.observe(el));
    });
    document.addEventListener('DOMContentLoaded', () => {
      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('animate');
            observer.unobserve(entry.target); // Optional: stops observing after first reveal
          }
        });
      });
    
      const serviceItems = document.querySelectorAll('.item');
      serviceItems.forEach(item => observer.observe(item));
    });

</script>
@endsection