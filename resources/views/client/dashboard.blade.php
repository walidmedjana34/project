@extends('layouts.app2')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/nav_footer.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dashboard_client.css') }}">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endpush

@section('title') dashboard client @endsection

@section("content")
<div class="dashboard-container">
    <header class="dashboard-header">
        <h1>Tableau de bord</h1>
    </header>
    
    <main class="dashboard-main">
        <!-- Informations personnelles -->
        <section class="profile-section">
            <div class="profile-section__header">
                <div class="profile-section__info">
                    <div class="profile-section__photo">
                        <img src="https://readdy.ai/api/search-image?query=professional%20portrait%20of%20a%20French%20man%20with%20short%20brown%20hair%2C%20neutral%20expression%2C%20business%20casual%20attire%2C%20soft%20lighting%2C%20studio%20photography%2C%20high%20quality&width=200&height=200&seq=2&orientation=squarish" alt="Photo de profil">
                        <button type="button" class="photo-edit-btn"><i class='bx bx-camera'></i></button>
                    </div>
                    <div class="profile-section__details">
                        <h2 class="profile-name">{{ $users->name }}</h2>
                        <div class="profile-contact">
                            <div class="contact-item">
                                <i class='bx bx-envelope contact-icon'></i>
                                <span class="contact-text">{{ $users->email }}</span>
                            </div>
                            <div class="contact-item">
                                <i class='bx bx-phone contact-icon'></i>
                                <span class="contact-text">{{ $users->phone }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <form class="personal-info-form" method="POST" action="{{ route('user.profile.update') }}">
                @csrf
                @method('PUT')
                
                <!-- Display general form errors -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <h3 class="form-title">Informations personnelles</h3>
                
                <div class="form-grid">
                    <!-- Nom field -->
                    <div class="form-group">
                        <label for="nom" class="form-label">Nom complet</label>
                        <div class="input-wrapper">
                            <i class='bx bx-user input-icon'></i>
                            <input type="text" id="nom" name="nom" 
                                   value="{{ old('nom', auth()->user()->name) }}" 
                                   class="form-input @error('nom') is-invalid @enderror">
                        </div>
                        @error('nom')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Email field -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-wrapper">
                            <i class='bx bx-envelope input-icon'></i>
                            <input type="email" id="email" name="email" 
                                   value="{{ old('email', auth()->user()->email) }}" 
                                   class="form-input @error('email') is-invalid @enderror">
                        </div>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Telephone field -->
                    <div class="form-group">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <div class="input-wrapper">
                            <i class='bx bx-phone input-icon'></i>
                            <input type="tel" id="telephone" name="telephone" 
                                   value="{{ old('telephone', auth()->user()->phone) }}" 
                                   class="form-input @error('telephone') is-invalid @enderror">
                        </div>
                        @error('telephone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                <div class="form-actions">
                    <button type="submit" class="btn btn--primary">
                        <i class='bx bx-save btn-icon'></i>
                        <span class="btn-text">Enregistrer les modifications</span>
                    </button>
                </div>
            </form>
        </section>
        
        <div class="dashboard-layout">
            <!-- Colonne gauche -->
            <div class="dashboard-layout__left">
                <!-- Visites programmées -->
                <!-- Visites programmées -->
<section class="dashboard-card">
    <div class="card-header">
        <h2 class="card-title"><i class='bx bx-calendar-check card-icon'></i> Visites programmées</h2>
        <a href="#" class="card-link">Voir tout</a>
    </div>
    
    @forelse($upcomingVisits as $visit)
    
    <div class="visit-card {{ $loop->first ? 'visit-card--highlight' : '' }}">
        <div class="visit-card__header">
            <h3 class="visit-card__title">{{ $loop->first ? 'Prochaine visite' : 'Visite à venir' }}</h3>
            <span class="status-badge status-badge--{{ $visit->status === 'confirmed' ? 'confirmed' : 'pending' }}">
                {{ $visit->status === 'confirmed' ? 'Confirmée' : 'En attente' }}
            </span>
        </div>
        <div class="visit-card__content">
            <div class="visit-details">
                <h4 class="property-title">{{ $visit->property->title ?? 'Propriété' }}</h4>
                <div class="property-info">
                    <div class="info-item">
                        <i class='bx bx-map info-icon'></i>
                        <span class="info-text">{{ $visit->property->address ?? 'Adresse non spécifiée' }}</span>
                    </div>
                    <div class="info-item">
                        <i class='bx bx-time info-icon'></i>
                        <span class="info-text">
                            @if($visit->scheduled_date)
                                {{ \Carbon\Carbon::parse($visit->scheduled_date)->format('d F Y \à H:i') }}
                            @else
                                Date non précisée
                            @endif
                        </span>
                    </div>
                    <div class="info-item">
                        <i class='bx bx-building-house info-icon'></i>
                        <span class="info-text">{{ $visit->agency->name ?? 'Agence' }}</span>
                    </div>
                </div>
            </div>
            <div class="visit-actions">
                <button class="btn btn--sm btn--outline">
                    <i class='bx bx-edit btn-icon'></i>
                    <span class="btn-text">Modifier</span>
                </button>
                <button class="btn btn--sm btn--outline-danger">
                    <i class='bx bx-x btn-icon'></i>
                    <span class="btn-text">Annuler</span>
                </button>
            </div>
        </div>
    </div>
    @empty
    <div class="visit-card">
        <div class="visit-card__content">
            <p>Aucune visite programmée</p>
        </div>
    </div>
    @endforelse
</section>

<!-- Historique de visites -->
<section class="dashboard-card">
    <div class="card-header">
        <h2 class="card-title"><i class='bx bx-history card-icon'></i> Historique de visites</h2>
    </div>
    
    <div class="history-list">
        @forelse($pastVisits as $visit)
        <div class="history-item">
            <div class="history-item__header">
                <div>
                    <h4 class="property-title">{{ $visit->property->title ?? 'Propriété' }}</h4>
                    <div class="property-info">
                        <div class="info-item">
                            <i class='bx bx-map info-icon'></i>
                            <span class="info-text">{{ $visit->property->address ?? 'Adresse non spécifiée' }}</span>
                        </div>
                        <div class="info-item">
                            <i class='bx bx-time info-icon'></i>
                            <span class="info-text">
                                @if($visit->scheduled_date)
                                    {{ \Carbon\Carbon::parse($visit->scheduled_date)->format('d F Y \à H:i') }}
                                @else
                                    Date non précisée
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <span class="status-badge status-badge--{{ $visit->status === 'canceled' ? 'cancelled' : 'visited' }}">
                    {{ $visit->status === 'canceled' ? 'Annulé' : 'Visité' }}
                </span>
            </div>
        </div>
        @empty
        <div class="history-item">
            <div class="history-item__header">
                <p>Aucune visite dans l'historique</p>
            </div>
        </div>
        @endforelse
    </div>
</section>
            </div>
            
            <!-- Colonne droite -->
            <div class="dashboard-layout__right">
                <!-- Favoris -->
                {{-- <section class="dashboard-card">
                    <div class="card-header">
                        <h2 class="card-title"><i class='bx bx-heart card-icon'></i> Favoris</h2>
                        <a href="#" class="card-link">Voir tout</a>
                    </div>
                    
                    <div class="favorites-card">
                        <div class="favorites-card__content">
                            <div class="favorites-count">7</div>
                            <p class="favorites-text">Biens ajoutés en favoris</p>
                            <a href="#" class="btn btn--primary" style="margin-top: 16px;">
                                Consulter mes favoris
                            </a>
                        </div>
                    </div>
                </section> --}}
                
                <!-- Messages et notifications -->
                <section class="dashboard-card">
                    <div class="card-header">
                        <h2 class="card-title"><i class='bx bx-message-detail card-icon'></i> Messages et notifications</h2>
                        <a href="#" class="card-link">Tout marquer comme lu</a>
                    </div>
                    
                    <div class="notifications-list">
                        <div class="notification notification--unread">
                            <div class="notification__header">
                                <h3 class="notification__title">Visite confirmée</h3>
                                <span class="notification__time">Aujourd'hui</span>
                            </div>
                            <p class="notification__content">
                                Votre visite pour l'appartement à Montmartre a été confirmée par l'agence.
                            </p>
                            <a href="#" class="card-link">Voir les détails</a>
                        </div>
                        
                        <div class="notification notification--unread">
                            <div class="notification__header">
                                <h3 class="notification__title">Nouveau bien correspondant</h3>
                                <span class="notification__time">Hier</span>
                            </div>
                            <p class="notification__content">
                                Un nouveau bien correspondant à votre recherche "Appartement Paris 5-7ème" est disponible.
                            </p>
                            <a href="#" class="card-link">Voir le bien</a>
                        </div>
                        
                        <div class="notification notification--read">
                            <div class="notification__header">
                                <h3 class="notification__title">Message de l'agence</h3>
                                <span class="notification__time">17 avril</span>
                            </div>
                            <p class="notification__content">
                                L'agence Neuilly Prestige Immobilier vous a envoyé des informations complémentaires.
                            </p>
                            <a href="#" class="card-link">Lire le message</a>
                        </div>
                        
                        <div class="notification notification--read">
                            <div class="notification__header">
                                <h3 class="notification__title">Baisse de prix</h3>
                                <span class="notification__time">15 avril</span>
                            </div>
                            <p class="notification__content">
                                Le prix du Studio à Saint-Germain que vous avez en favori a baissé de 15 000 €.
                            </p>
                            <a href="#" class="card-link">Voir le bien</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Checkbox functionality
        const checkboxes = document.querySelectorAll(".custom-checkbox");
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener("click", function() {
                this.classList.toggle("checked");
            });
        });
        
        // Switch functionality
        const switches = document.querySelectorAll(".custom-switch input");
        switches.forEach(switchInput => {
            switchInput.addEventListener("change", function() {
                // Additional functionality can be added here
            });
        });
        
        
        
        // Button actions
        const cancelButtons = document.querySelectorAll(".btn--outline-danger");
        cancelButtons.forEach(button => {
            button.addEventListener("click", function(e) {
                e.preventDefault();
                if (confirm("Êtes-vous sûr de vouloir annuler cette visite ?")) {
                    const visitCard = this.closest(".visit-card");
                    if (visitCard) {
                        visitCard.remove();
                    }
                }
            });
        });
        
        // Mark all as read
        const markAllRead = document.querySelector(".card-header a[href='#']");
        if (markAllRead) {
            markAllRead.addEventListener("click", function(e) {
                e.preventDefault();
                const notifications = document.querySelectorAll(".notification--unread");
                notifications.forEach(notification => {
                    notification.classList.remove("notification--unread");
                    notification.classList.add("notification--read");
                });
            });
        }
    });
</script>

@endsection