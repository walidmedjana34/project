@extends('layouts.app2')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title') Détails du bien vacances @endsection

@section("content")
    <!-- Contenu principal -->
    <main class="containere">
        <!-- Galerie Photos -->
        <section class="gallery">
          @php
              $images = $anoncy->main_image ? json_decode($anoncy->main_image) : [];
              $hasImages = count($images) > 0;
          @endphp
          
          <div class="gallery-main splide">
              <div class="splide__track">
                  <div class="splide__list">
                      @if($hasImages)
                          @foreach($images as $image)
                              <div class="splide__slide">
                                  <img src="{{ asset($image) }}" alt="{{ $anoncy->title }} - Image {{ $loop->iteration }}">
                              </div>
                          @endforeach
                      @else
                          <div class="splide__slide">
                              <img src="{{ asset('assets/img/accueil image/im2.jpg') }}" alt="Default vacation property image">
                          </div>
                      @endif
                  </div>
              </div>
              
              <div class="gallery-controls">
                  <span class="gallery-counter">1/{{ $hasImages ? count($images) : 1 }}</span>
                  <button class="gallery-fullscreen">
                      <i class='bx bx-fullscreen'></i>
                  </button>
              </div>
            </div>
            @if($hasImages )
            <div class="gallery-thumbnails splide">
                <div class="splide__track">
                    <div class="splide__list">
                        @foreach($images as $image)
                            <div class="splide__slide">
                                <img src="{{ asset($image) }}" alt="Thumbnail {{ $loop->iteration }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
      </section>

        <!-- Informations essentielles -->
        <section class="property-info">
            <div class="property-header">
                <div>
                    <h1 class="property-title">{{ $anoncy->title }}</h1>
                    <p class="property-address">
                        @if($anoncy->address){{ $anoncy->address }}, @endif
                        @if($anoncy->commune){{ $anoncy->commune }}, @endif
                        @if($anoncy->wilaya){{ $anoncy->wilaya }}@endif
                    </p>
                    <div class="property-meta">
                        <span class="property-meta-item">
                          <i class='bx bx-building'></i> {{ ucfirst($anoncy->type) }}
                        </span>
                        <span class="property-status-badge">
                            @if($anoncy->statut == 'disponible')
                                <span class="badge-available">Disponible</span>
                            @elseif($anoncy->statut == 'reserve')
                                <span class="badge-reserved">Réservé</span>
                            @elseif($anoncy->statut == 'loue')
                                <span class="badge-rented">Loué</span>
                            @endif
                            
                            @if($anoncy->admin_status == 'pending')
                                <span class="badge-pending">En attente de validation</span>
                            @endif
                        </span>
                    </div>
                </div>
                <div class="property-price">
                    <div class="property-price-value">{{ number_format($anoncy->prix_nuit, 0, ',', ' ') }}dz</div>
                    <div class="property-status">
                        @if($anoncy->type_sanonce == 'Location')
                            Location vacances
                        @else
                            Location vacances
                        @endif
                    </div>
                </div>
            </div>

            <div class="property-features">
                @if($anoncy->superficie)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-area'></i>
                    </div>
                    <div class="property-feature-label">Surface</div>
                    <div class="property-feature-value">{{ $anoncy->superficie }} m²</div>
                </div>
                @endif
                
                @if($anoncy->capacite)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-user'></i>
                    </div>
                    <div class="property-feature-label">Capacité</div>
                    <div class="property-feature-value">{{ $anoncy->capacite }} personnes</div>
                </div>
                @endif
                
                <!-- Vacation Amenities -->
                @if($anoncy->wifi)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-wifi'></i>
                    </div>
                    <div class="property-feature-label">WiFi</div>
                </div>
                @endif
                
                @if($anoncy->piscine)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-swim'></i>
                    </div>
                    <div class="property-feature-label">Piscine</div>
                </div>
                @endif
                
                @if($anoncy->parking)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-car'></i>
                    </div>
                    <div class="property-feature-label">Parking</div>
                </div>
                @endif
                
                @if($anoncy->cuisine)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-fridge'></i>
                    </div>
                    <div class="property-feature-label">Cuisine</div>
                </div>
                @endif
                
                @if($anoncy->television)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-tv'></i>
                    </div>
                    <div class="property-feature-label">Télévision</div>
                </div>
                @endif
                
                @if($anoncy->climatisation)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-wind'></i>
                    </div>
                    <div class="property-feature-label">Climatisation</div>
                </div>
                @endif

                @if($anoncy->eau)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-water'></i>
                    </div>
                    <div class="property-feature-label">Eau</div>
                </div>
                @endif
            </div>

            <!-- Availability Section -->
            @if($anoncy->disponible_de || $anoncy->disponible_jusqua_date)
            <div class="availability-section">
                <h3 style="margin-bottom: 10px">Disponibilité</h3>
                <p>
                    @if($anoncy->disponible_de)
                    À partir de: {{ date('d/m/Y', strtotime($anoncy->disponible_de)) }}<br>
                    @endif
                    @if($anoncy->disponible_jusqua_date)
                    Jusqu'à: {{ date('d/m/Y', strtotime($anoncy->disponible_jusqua_date)) }}
                    @endif
                </p>
            </div>
            @endif

            <div class="property-actions">
                <button class="contact-button button2">Contacter l'agence</button>
                <form id="contactForm" method="POST" action="{{ route('messages.store') }}">
                    @csrf
                    <input type="hidden" name="agency_id" value="{{ $anoncy->agency->id }}">
                    <input type="hidden" name="vacance_id" value="{{ $anoncy->id }}">
                <div class="modal-overlay" id="contactModal">
                  <div class="modal-content">
                    <span class="close-btn" id="closeModal">&times;</span>
                    <h2 style="text-align: start;color:#333; margin-bottom:20px;">Contacter l'agence</h2>
                    <p>Vous êtes intéressé par :</p>
                    <h3 class="titlee">Appartement moderne au centre-ville</h3>
                    <p class="Prestige">Géré par Immobilier Prestige</p>
                    <div class="box-infor">
                        <label for="phone">Votre numéro de téléphone</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" required>
                        <span class="error-message phone-error"></span>
                    </div>
                    
                    <div class="box-infor">
                        <label for="message">Votre message</label>
                        <textarea name="content" id="message" required>{{ old('content') }}</textarea>                    <span class="error-message message-error"></span>
                    </div>
                    
                
                    <button class="send-button button2">📤 Envoyer le message</button>
                </form>
                  </div>
                </div>     
                <button class="visit-button open-visit-modal">Programmer une visite</button>
                <!-- Modale de visite -->
                <div class="visit-modal-overlay" id="visitModal" @if($errors->has('scheduled_date') || $errors->has('scheduled_time') || $errors->has('phone')) style="display: flex;" @endif>
                  <div class="visit-modal-box">
                      <span class="visit-close-btn" id="closeVisitModal">&times;</span>
                  
                      <h2 style="text-align: start;color:#333; margin-bottom:20px;">Programmer une visite</h2>
                      <p class="visit-property-info">
                          Vous souhaitez visiter :<br>
                          <strong>{{ $anoncy->title }}</strong><br>
                          <span class="visit-agency">Géré par {{ $anoncy->agency->name }}</span>
                      </p>
                      
                      @if($errors->any())
                          <div class="alert alert-danger">
                              @foreach ($errors->all() as $error)
                                  <p>{{ $error }}</p>
                              @endforeach
                          </div>
                      @endif
                      
                      @if(session('success'))
                          <div class="alert alert-success">
                              {{ session('success') }}
                          </div>
                      @endif
                      
                      <form action="{{ route('visits.store') }}" method="POST">
                          @csrf
                          <input type="hidden" name="vacance_id" value="{{ $anoncy->id }}">
                          <input type="hidden" name="agency_id" value="{{ $anoncy->agency_id }}">
                          
                          <label for="visit-date">Date souhaitée</label>
                          <input type="date" id="visit-date" name="scheduled_date" value="{{ old('scheduled_date') }}" required>
                          @error('scheduled_date')
                              <span class="error-message">{{ $message }}</span>
                          @enderror
                          
                          <label for="visit-time">Heure préférée</label>
                          <select id="visit-time" name="scheduled_time" required>
                              <option value="09:00:00" {{ old('scheduled_time') == '09:00:00' ? 'selected' : '' }}>09:00</option>
                              <option value="10:00:00" {{ old('scheduled_time') == '10:00:00' ? 'selected' : '' }}>10:00</option>
                              <option value="11:00:00" {{ old('scheduled_time') == '11:00:00' ? 'selected' : '' }}>11:00</option>
                              <option value="12:00:00" {{ old('scheduled_time') == '12:00:00' ? 'selected' : '' }}>12:00</option>
                              <option value="14:00:00" {{ old('scheduled_time') == '14:00:00' ? 'selected' : '' }}>14:00</option>
                              <option value="15:00:00" {{ old('scheduled_time') == '15:00:00' ? 'selected' : '' }}>15:00</option>
                              <option value="16:00:00" {{ old('scheduled_time') == '16:00:00' ? 'selected' : '' }}>16:00</option>
                          </select>
                          @error('scheduled_time')
                              <span class="error-message">{{ $message }}</span>
                          @enderror
                          
                          <label for="visit-phone">Votre numéro de téléphone</label>
                          <input type="text" id="visit-phone" name="phone" value="{{ old('phone') }}" placeholder="Ex: 0555 12 34 56" required>
                          @error('phone')
                              <span class="error-message">{{ $message }}</span>
                          @enderror
                          
                          <label for="visit-notes">Notes supplémentaires (optionnel)</label>
                          <textarea id="visit-notes" name="notes" placeholder="Ex: Je suis disponible uniquement le matin...">{{ old('notes') }}</textarea>
                          
                          <button type="submit" class="visit-send-btn">📅 Confirmer la visite</button>
                          
                          <p class="visit-note-footer">L'agent immobilier confirmera votre rendez-vous par téléphone</p>
                      </form>
                  </div>
              </div>
        </section>

        <!-- Navigation par onglets -->
        <section class="tabss">
            <div class="tabss-header">
                <div class="tabs-list">
                    <button class="tab-button active" data-tab="description">Description</button>
                    <button class="tab-button" data-tab="caracteristiques">Caractéristiques</button>
                    <button class="tab-button" data-tab="localisation">Localisation</button>
                </div>
            </div>
            
            <!-- Contenu des onglets -->
            <div class="tabss-content">
                <!-- Description -->
                <div id="description" class="tab-content active">
                    <h2 class="tab-title">À propos de cette location vacances</h2>
                    <p class="tab-section">
                        {{ $anoncy->description }}
                    </p>
                </div>

                <!-- Caractéristiques -->
                <div id="caracteristiques" class="tab-content">
                    <h2 class="tab-title">Caractéristiques détaillées</h2>
                    
                    <div class="feature-list tab-section">
                        <div>
                            <h3 class="tab-section-title">Détails du bien</h3>
                            <ul class="space-y-3">
                                @if($anoncy->superficie)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-label">Surface:</span> 
                                        <span class="feature-value">{{ $anoncy->superficie }} m²</span>
                                    </div>
                                </li>
                                @endif
                                
                                @if($anoncy->capacite)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-label">Capacité:</span> 
                                        <span class="feature-value">{{ $anoncy->capacite }} personnes</span>
                                    </div>
                                </li>
                                @endif
                                
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-label">Type de bien:</span> 
                                        <span class="feature-value">{{ ucfirst($anoncy->type) }}</span>
                                    </div>
                                </li>
                                
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-label">Type d'annonce:</span> 
                                        <span class="feature-value">
                                            @if($anoncy->type_sanonce == 'location')
                                                Location
                                            @else
                                                Vente
                                            @endif
                                        </span>
                                    </div>
                                </li>
                                
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-label">Statut:</span> 
                                        <span class="feature-value">
                                            @if($anoncy->statut == 'disponible')
                                                Disponible
                                            @elseif($anoncy->statut == 'reserve')
                                                Réservé
                                            @elseif($anoncy->statut == 'loue')
                                                Loué
                                            @endif
                                        </span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="tab-section-title">Équipements</h3>
                            <ul class="space-y-3">
                                @if($anoncy->wifi)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-value">WiFi haut débit</span>
                                    </div>
                                </li>
                                @endif
                                
                                @if($anoncy->piscine)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-value">Piscine</span>
                                    </div>
                                </li>
                                @endif
                                
                                @if($anoncy->parking)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-value">Parking privé</span>
                                    </div>
                                </li>
                                @endif
                                
                                @if($anoncy->cuisine)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-value">Cuisine équipée</span>
                                    </div>
                                </li>
                                @endif
                                
                                @if($anoncy->television)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-value">Télévision</span>
                                    </div>
                                </li>
                                @endif
                                
                                @if($anoncy->climatisation)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-value">Climatisation</span>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    
                    <div class="tab-section">
                        <h3 class="tab-section-title">Disponibilité</h3>
                        <div class="availability-grid">
                            @if($anoncy->disponible_de)
                            <div class="availability-card">
                                <div class="availability-label">Disponible à partir du</div>
                                <div class="availability-value">{{ date('d/m/Y', strtotime($anoncy->disponible_de)) }}</div>
                            </div>
                            @endif
                            
                            @if($anoncy->disponible_jusqua_date)
                            <div class="availability-card">
                                <div class="availability-label">Disponible jusqu'au</div>
                                <div class="availability-value">{{ date('d/m/Y', strtotime($anoncy->disponible_jusqua_date)) }}</div>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="tab-section">
                        <h3 class="tab-section-title">Informations financières</h3>
                        <div class="financial-grid">
                            <div class="financial-card">
                                <div class="financial-label">Prix</div>
                                <div class="financial-value">{{ number_format($anoncy->price, 0, ',', ' ') }} DZ</div>
                            </div>
                            
                            @if($anoncy->superficie)
                            <div class="financial-card">
                                <div class="financial-label">Prix au m²</div>
                                <div class="financial-value">
                                    {{ number_format($anoncy->price / $anoncy->superficie, 0, ',', ' ') }} DZ/m²
                                </div>
                            </div>
                            @endif
                            
                            <div class="financial-card">
                                <div class="financial-label">Type</div>
                                <div class="financial-value">
                                    @if($anoncy->type_sanonce == 'location')
                                        Location vacances
                                    @else
                                        À vendre
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Localisation -->
                <div id="localisation" class="tab-content">
                    <h2 class="tab-title">Localisation</h2>
                    <div class="tab-section">
                        <h3 class="tab-section-title">Adresse</h3>
                        <p>
                            @if($anoncy->address){{ $anoncy->address }}<br>@endif
                            @if($anoncy->commune){{ $anoncy->commune }}<br>@endif
                            @if($anoncy->wilaya){{ $anoncy->wilaya }}@endif
                        </p>
                    </div>
                    
                    <div class="tab-section">
                        <h3 class="tab-section-title">Carte</h3>
                        <div class="map-container" style="height: 400px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                            <p>Carte interactive de localisation</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Biens similaires -->
        <section class="similar">
          <div class="similar-header">
              <h2 class="similar-title">Autres locations vacances</h2>
              <a href="{{ route('home.annonces', ['property_type' => $anoncy->type]) }}" class="similar-link">Voir plus</a>
          </div>
          
          <div class="similar-grid">
              @forelse($similarAnnonces as $similar)
                <div class="product">
                    <div class="carousel">
                    <span class="badge">Location vacances</span>
                    <div class="carousel-inr">
                        @php
                            // Handle the image data (works whether it's JSON string or already decoded)
                            $images = [];
                            
                            if (!empty($similar->main_image)) {
                                if (is_string($similar->main_image)) {
                                    // Remove any unexpected backslashes before decoding
                                    $cleaned = stripslashes($similar->main_image);
                                    $images = json_decode($cleaned, true) ?? [];
                                } elseif (is_array($similar->main_image)) {
                                    $images = $similar->main_image;
                                }
                            }
                            
                            // Ensure we have a valid array (handle cases where json_decode fails)
                            $images = is_array($images) ? $images : [];
                        @endphp
                    
                        @if(count($images) > 0)
                            @foreach($images as $index => $imagePath)
                                @php
                                    // Clean up the image path (remove any remaining escaped slashes)
                                    $cleanPath = str_replace('\\/', '/', $imagePath);
                                @endphp
                                <img src="{{ asset($cleanPath) }}" 
                                     class="carousel-item {{ $index === 0 ? 'active' : '' }}" 
                                     alt="Property Image">
                            @endforeach
                        @else
                            <img src="{{ asset('assets/img/accueil image/im2.jpg') }}" 
                                 class="carousel-item active" 
                                 alt="Default Image">
                        @endif
                    </div>
                    <button class="carousel-control prev">❮</button>
                    <button class="carousel-control next">❯</button>
                </div>
        
            <div class="détails">
                <p class="prix">{{ number_format($similar->prix_nuit, 0, ',', ' ') }}<span>DA</span></p>
                <h3>{{ $similar->titre }}</h3>
                <p class="wilaya">{{ config('wilayas.'.$similar->wilaya) }}</p>
                
                <div class="property-infoo">
                    <span><i class='bx bx-door-open'></i> {{ $similar->chambres }} ch.</span>
                    <span><i class='bx bx-bath'></i> {{ $similar->salles_bain }} sdb</span>
                    <span><i class='bx bx-user'></i> {{ $similar->capacite }} pers.</span>
                </div>
        
                <div class="property-icons">
                    @if($similar->wifi)<span class="icon"><i class='bx bx-wifi'></i></span>@endif
                    @if($similar->parking)<span class="icon"><i class='bx bx-car'></i></span>@endif
                    @if($similar->piscine)<span class="icon"><i class='bx bx-pool'></i></span>@endif
                    @if($similar->climatisation)<span class="icon"><i class='bx bx-wind'></i></span>@endif
                    @if($similar->cuisine)<span class="icon"><i class='bx bx-water'></i></span>@endif
                    @if($similar->television)<span class="icon"><i class='bx bx-water'></i></span>@endif
                    @if($similar->eau)<span class="icon"><i class='bx bx-water'></i></span>@endif
                </div>
        
                <div class="features">
                    <div class="iconss">
                        <span><i class='bx bx-bed'></i> {{ $similar->chambres }}</span>
                        <span><i class='bx bx-bath'></i> {{ $similar->salles_bain }}</span>
                        <span><i class='bx bx-square-rounded'></i> {{ $similar->superficie }} m²</span>
                    </div>
                </div>
            </div>
        
            <div class="button-detail">
                <p class="type_ann">vacance</p>
                <a href="{{ route('vacance.details', $similar) }}" class="button2 pr">Détails</a>
            </div>
        </div>
                  
                  {{-- <div class="product-card">
                      <div class="product-badge">
                          @if($similar->statut == 'loue')
                              <span class="badge-sold">Loué</span>
                          @elseif($similar->statut == 'reserve')
                              <span class="badge-reserved">Réservé</span>
                          @elseif($similar->type_sanonce == 'location')
                              <span class="badge-rent">À louer</span>
                          @endif
                      </div>
                      <div class="product-image">
                          <img src="{{ asset($similarMainImage) }}" alt="{{ $similar->title }}">
                          <div class="product-price">{{ number_format($similar->price, 0, ',', ' ') }} DZ</div>
                      </div>
                      <div class="product-content">
                          <h3 class="product-title">{{ $similar->title }}</h3>
                          <p class="product-location">
                              <i class='bx bx-map'></i>
                              @if($similar->commune){{ $similar->commune }}, @endif
                              @if($similar->wilaya){{ $similar->wilaya }}@endif
                          </p>
                          <div class="product-features">
                              @if($similar->superficie)
                              <span class="product-feature">
                                  <i class='bx bx-area'></i> {{ $similar->superficie }} m²
                              </span>
                              @endif
                              @if($similar->capacite)
                              <span class="product-feature">
                                  <i class='bx bx-user'></i> {{ $similar->capacite }} pers.
                              </span>
                              @endif
                          </div>
                          <div class="product-footer">
                              <a href="{{ route('home.detaille', $similar->id) }}" class="product-link">Voir détails</a>
                          </div>
                      </div>
                  </div> --}}
              @empty
                  <div class="no-products">
                      <p>Aucune autre location vacances trouvée</p>
                  </div>
              @endforelse
          </div>
      </section>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Main slider
        const mainSlider = new Splide('.gallery-main.splide', {
            type       : 'loop',
            rewind     : true,
            pagination : false,
            arrows     : true,
            cover      : false,
            
        });

        // Thumbnail slider
        const thumbnails = new Splide('.gallery-thumbnails.splide', {
            fixedWidth  : 100,
            fixedHeight : 60,
            gap         : 10,
            rewind      : true,
            pagination  : false,
            isNavigation: true,
            arrows     : false,
            focus       : 'start',
            breakpoints : {
                600: {
                    fixedWidth : 60,
                    fixedHeight: 40,
                }
            }
        });

        // Sync sliders
        if (mainSlider && thumbnails) {
            mainSlider.sync(thumbnails);
            mainSlider.mount();
            thumbnails.mount();
        } else if (mainSlider) {
            mainSlider.mount();
        }

        // Update counter
        mainSlider.on('mounted move', function() {
            const current = mainSlider.index + 1;
            const total = mainSlider.length;
            document.querySelector('.gallery-counter').textContent = `${current}/${total}`;
        });

        // Gestion des onglets
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                const tabId = button.getAttribute('data-tab');
                
                // Désactiver tous les onglets
                tabButtons.forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.remove('text-primary');
                    btn.classList.remove('border-primary');
                    btn.classList.add('text-gray-600');
                });
                
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Activer l'onglet sélectionné
                button.classList.add('active', 'text-primary', 'border-primary');
                button.classList.remove('text-gray-600');
                document.getElementById(tabId).classList.add('active');
            });
        });
    });
    
    const modal = document.getElementById("contactModal");
    const openBtn = document.querySelector(".contact-button");
    const closeBtn = document.getElementById("closeModal");
  
    openBtn.addEventListener("click", () => {
      modal.style.display = "flex";
    });
  
    closeBtn.addEventListener("click", () => {
      modal.style.display = "none";
    });
  
    window.addEventListener("click", (e) => {
      if (e.target == modal) {
        modal.style.display = "none";
      }
    });

  const visitModal = document.getElementById("visitModal");
  const openVisitBtn = document.querySelector(".open-visit-modal");
  const closeVisitBtn = document.getElementById("closeVisitModal");

  openVisitBtn.addEventListener("click", () => {
    visitModal.style.display = "flex";
  });

  closeVisitBtn.addEventListener("click", () => {
    visitModal.style.display = "none";
  });

  window.addEventListener("click", (e) => {
    if (e.target === visitModal) {
      visitModal.style.display = "none";
    }
  });

document.querySelectorAll(".product").forEach(product => {
    let currentIndex = 0;
    const slides = product.querySelectorAll(".carousel-item");
    const totalSlides = slides.length;
    const prevBtn = product.querySelector(".prev");
    const nextBtn = product.querySelector(".next");

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove("active");
            if (i === index) slide.classList.add("active");
        });
    }

    prevBtn.addEventListener("click", () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        showSlide(currentIndex);
    });

    nextBtn.addEventListener("click", () => {
        currentIndex = (currentIndex + 1) % totalSlides;
        showSlide(currentIndex);
    });  
});
</script>
@endsection