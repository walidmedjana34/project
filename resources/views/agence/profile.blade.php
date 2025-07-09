@extends('layouts.app2')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title')Profil Agence @endsection
@section("content") 
    <!-- Image de couverture -->
    
    <div class="cover">
        <div class="cover-overlay">
            <div class="profile">
                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80" alt="Logo">
                <div>
                    <h1>{{ $agency->name }}</h1>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $agency->address }}</p>
                </div>
            </div>
        </div>
    </div>

    
        <!-- Contenu - Propriétés -->
        <div class="content active" id="properties">
            <h2>Nos Biens <span>{{ $agency->properties->count() }}</span></h2>
            <div class="annonce-list">
                @forelse($agency->properties as $property)
                <div class="product">
                    <div class="carousel">
                        <span class="badge">
                            @if($property->status == 'a_vendre')
                                À vendre
                            @elseif($property->status == 'a_louer')
                                À louer
                            @else
                                Vendu
                            @endif
                        </span>
                        <div class="carousel-inr">
                            <img src="{{ asset($property->main_image) }}" class="carousel-item active" alt="{{ $property->title }}">
                        </div>
                        <button class="carousel-control prev">❮</button>
                        <button class="carousel-control next">❯</button>
                    </div>
                
                    <div class="détails">
                      <h3>{{ $property->title }}</h3>
                      <p class="wilaya">{{ $property->wilaya }},{{ $property->commune }}</p>
                      <div class="features">
                          <div class="">
                              <span><i class='bx bx-bed'></i> {{ $property->bedrooms }}</span>
                              <span><i class='bx bx-bath'></i> {{ $property->bathrooms }}</span>
                              <span><i class='bx bx-square-rounded' ></i> {{ $property->surface }} m²</span>
                          </div>
                          
                          <p class="prix">{{ number_format($property->price, 0, ',', ' ') }}<span>DA</span></p>
                      </div>
                    </div>
                    <div class="button-detail">
                        <a href="{{ route('home.detaills', $property->id) }}" class="button2 card-button">Détails</a>
                    </div>
                </div>
                @empty
                <div class="no-properties">
                    <p>Aucun bien disponible pour le moment.</p>
                </div>
                @endforelse
                
              
            </div>
            
        </div>

        <!-- Contenu - Statistiques -->
        <div class="content" id="stats">
            <h2>Statistiques</h2>
            <div class="stats">
                <div>
                    <h3>{{ $agency->properties_available }}</h3>
                    <p>Biens</p>
                </div>
                <div>
                    <h3>{{ $agency->properties()->where('status', 'vendu')->count() }}</h3>
                    <p>Ventes</p>
                </div>
                <div>
                    <h3>1500</h3>
                    <p>Vues</p>
                </div>
                <div>
                    <h3>{{ number_format($agency->rating, 1) }}</h3>
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