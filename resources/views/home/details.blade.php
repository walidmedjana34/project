@extends('layouts.app2')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title') Détails du bien immobilier @endsection
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
                              <img src="https://readdy.ai/api/search-image?query=modern%20luxury%20apartment" alt="Default property image">
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
          
          @if($hasImages)
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
                          <i class='bx bx-building'></i> {{ ucfirst(str_replace('_', ' ', $anoncy->type)) }}
                        </span>
                        <span class="property-meta-item">
                          <i class='bx bx-star'></i> {{ ucfirst(str_replace('-', ' ', $anoncy->etat_blen)) }}
                        </span>
                    </div>
                </div>
                <div class="property-price">
                    <div class="property-price-value">{{ number_format($anoncy->price, 0, ',', ' ') }} DZ</div>
                    <div class="property-status">
                        @if($anoncy->status == 'a_vendre')
                            À vendre
                        @elseif($anoncy->status == 'vendu')
                            Vendu
                        @elseif($anoncy->status == 'a_louer')
                            À louer
                        @endif
                    </div>
                </div>
            </div>

            <div class="property-features">
                @if($anoncy->surface)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-home'></i>
                    </div>
                    <div class="property-feature-label">Surface</div>
                    <div class="property-feature-value">{{ $anoncy->surface }} m²</div>
                </div>
                @endif
                
                @if($anoncy->bedrooms)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-bed'></i>
                    </div>
                    <div class="property-feature-label">Chambres</div>
                    <div class="property-feature-value">{{ $anoncy->bedrooms }}</div>
                </div>
                @endif
                
                @if($anoncy->bathrooms)
                <div class="property-feature">
                    <div class="property-feature-icon">
                      <i class='bx bx-shower'></i>
                    </div>
                    <div class="property-feature-label">Salles de bain</div>
                    <div class="property-feature-value">{{ $anoncy->bathrooms }}</div>
                </div>
                @endif
            </div>

            @if($anoncy->features)
                <div class="property-tags">
                    @foreach(json_decode($anoncy->features) as $feature)
                        <span class="property-tag">{{ $feature }}</span>
                    @endforeach
                </div>
            @endif
            <div class="property-actions">
                <button class="contact-button button2">Contacter l'agence</button>
                <form id="contactForm" method="POST" action="{{ route('messages.store') }}">
                    @csrf
                    <input type="hidden" name="agency_id" value="{{ $anoncy->agency->id }}">
                    <input type="hidden" name="property_id" value="{{ $anoncy->id }}">
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
                        <textarea name="content" id="message" required>{{ old('content') }}</textarea>
                        <span class="error-message message-error"></span>
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
                            <input type="hidden" name="property_id" value="{{ $anoncy->id }}">
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
                    <h2 class="tab-title">À propos de ce bien</h2>
                    <p class="tab-section">
                        {{ $anoncy->description }}
                    </p>
                </div>

                <!-- Caractéristiques -->
                <div id="caracteristiques" class="tab-content">
                    <h2 class="tab-title">Caractéristiques détaillées</h2>
                    
                    <div class="feature-list tab-section">
                        <div>
                            <h3 class="tab-section-title">Intérieur</h3>
                            <ul class="space-y-3">
                                @if($anoncy->surface)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class=' bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-label">Surface habitable:</span> 
                                        <span class="feature-value">{{ $anoncy->surface }} m²</span>
                                    </div>
                                </li>
                                @endif
                                
                                @if($anoncy->bedrooms)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-label">Chambres:</span> 
                                        <span class="feature-value">{{ $anoncy->bedrooms }}</span>
                                    </div>
                                </li>
                                @endif
                                
                                @if($anoncy->bathrooms)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-label">Salles de bain:</span> 
                                        <span class="feature-value">{{ $anoncy->bathrooms }}</span>
                                    </div>
                                </li>
                                @endif
                                
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-label">Type de bien:</span> 
                                        <span class="feature-value">{{ ucfirst(str_replace('_', ' ', $anoncy->type)) }}</span>
                                    </div>
                                </li>
                                
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-label">État du bien:</span> 
                                        <span class="feature-value">{{ ucfirst(str_replace('-', ' ', $anoncy->etat_blen)) }}</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        
                        @if($anoncy->features)
                        <div>
                            <h3 class="tab-section-title">Équipements</h3>
                            <ul class="space-y-3">
                                @foreach(json_decode($anoncy->features) as $feature)
                                <li class="feature-item">
                                    <div class="feature-icon">
                                      <i class='bx bx-check'></i>
                                    </div>
                                    <div>
                                        <span class="feature-value">{{ $feature }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    
                    <div class="tab-section">
                        <h3 class="tab-section-title">Informations financières</h3>
                        <div class="financial-grid">
                            <div class="financial-card">
                                <div class="financial-label">Prix</div>
                                <div class="financial-value">{{ number_format($anoncy->price, 0, ',', ' ') }}DZ</div>
                            </div>
                            
                            @if($anoncy->surface)
                            <div class="financial-card">
                                <div class="financial-label">Prix au m²</div>
                                <div class="financial-value">
                                    {{ number_format($anoncy->price / $anoncy->surface, 0, ',', ' ') }} dz/m²
                                </div>
                            </div>
                            @endif
                            
                            <div class="financial-card">
                                <div class="financial-label">Statut</div>
                                <div class="financial-value">
                                    @if($anoncy->status == 'a_vendre')
                                        À vendre
                                    @elseif($anoncy->status == 'vendu')
                                        Vendu
                                    @elseif($anoncy->status == 'a_louer')
                                        À louer
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
                <h2 class="similar-title">Biens similaires</h2>
                <a href="{{ route('home.annonces', ['property_type' => $anoncy->type]) }}" class="similar-link">Voir plus</a>
            </div>
            
            <div class="similar-grid">
                @forelse($similarAnnonces as $similar) 
                <div class="product">
                    <div class="carousel">
                        {{-- Status Badge --}}
                        @if(isset($similar->status))
                            @if($similar->status == 'vendu')
                                <span class="badge sold">Vendu</span>
                            @elseif($similar->status == 'a_louer')
                                <span class="badge rent">À louer</span>
                            @else
                                <span class="badge">À vendre</span>
                            @endif
                        @else
                            <span class="badge">À vendre</span>
                        @endif
                        
                        <div class="carousel-inr">
                            @if(isset($similar->main_image) && !empty($similar->main_image))
                                @php
                                    $images = json_decode($similar->main_image);
                                @endphp
                                
                                @if(is_array($images) && count($images) > 0)
                                    @foreach($images as $index => $image)
                                        <img src="{{ asset($image) }}" class="carousel-item {{ $index === 0 ? 'active' : '' }}" alt="{{ $similar->title ?? 'Property Image' }}">
                                    @endforeach
                                @else
                                    <img src="{{ asset('assets/img/accueil image/im2.jpg') }}" class="carousel-item active" alt="Default Image">
                                @endif
                            @else
                                <img src="{{ asset('assets/img/accueil image/im2.jpg') }}" class="carousel-item active" alt="Default Image">
                            @endif
                        </div>
                        <button class="carousel-control prev">❮</button>
                        <button class="carousel-control next">❯</button>
                    </div>
                
                    <div class="détails">
                        <p class="prix">{{ isset($similar->price) ? number_format($similar->price, 0, ',', ' ') : 'N/A' }} <span>DA</span></p>
                        <h3>{{ $similar->title ?? 'No Title' }}</h3>
                        <p class="wilaya">
                            @isset($similar->commune){{ $similar->commune }}, @endisset
                            {{ $similar->wilaya ?? '' }}
                        </p>
                        <div class="features">
                            <div class="iconss">
                                <span><i class='bx bx-bed'></i> {{ $similar->bedrooms ?? 'N/A' }}</span>
                                <span><i class='bx bx-bath'></i> {{ $similar->bathrooms ?? 'N/A' }}</span>
                                <span><i class='bx bx-square-rounded'></i> {{ $similar->surface ?? 'N/A' }} m²</span>
                            </div>
                        </div>
                    </div>
                    <div class="button-detail">
                        <p class="type_ann">{{ $similar->type ?? 'N/A' }}</p>
                        <a href="{{ isset($similar->id) ? route('home.detaills', $similar->id) : '#' }}" class="button2 pr">Détails</a>
                    </div>
                </div>
                @empty
                    <div class="no-products">
                        <p>Aucun bien similaire trouvé</p>
                    </div>
                @endforelse
            </div>
        </section>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Main slider
        const mainSlider = new Splide('.gallery-main.splide', {
            type: 'fade',
            rewind: true,
            pagination: false,
            arrows: true,
            cover: false,
        });

        // Thumbnail slider
        const thumbnails = new Splide('.gallery-thumbnails.splide', {
            fixedWidth: 100,
            fixedHeight: 60,
            gap: 10,
            rewind: true,
            pagination: false,
            isNavigation: true,
            arrows: false,
            focus: 'center',
            breakpoints: {
                600: {
                    fixedWidth: 60,
                    fixedHeight: 40,
                }
            }
        });

        // Sync sliders
        if (document.querySelector('.gallery-thumbnails.splide')) {
            mainSlider.sync(thumbnails);
            mainSlider.mount();
            thumbnails.mount();
        } else {
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

        // Gestion des modales
        const modal = document.getElementById("contactModal");
        const openBtn = document.querySelector(".contact-button");
        const closeBtn = document.getElementById("closeModal");
        
        const visitModal = document.getElementById("visitModal");
        const openVisitBtn = document.querySelector(".open-visit-modal");
        const closeVisitBtn = document.getElementById("closeVisitModal");

        // Contact modal
        openBtn.addEventListener("click", () => {
            modal.style.display = "flex";
        });

        closeBtn.addEventListener("click", () => {
            modal.style.display = "none";
        });

        // Visit modal
        openVisitBtn.addEventListener("click", () => {
            visitModal.style.display = "flex";
        });

        closeVisitBtn.addEventListener("click", () => {
            visitModal.style.display = "none";
        });

        // Close modals when clicking outside
        window.addEventListener("click", (e) => {
            if (e.target == modal) {
                modal.style.display = "none";
            }
            if (e.target == visitModal) {
                visitModal.style.display = "none";
            }
        });
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