@extends('layouts.app2')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title') vacances  @endsection
@section("content")

<section class="header-vacances curved hidden">
    <div>
        <h1 class="hidden slide-left">Trouvez Votre Location de Vacances Idéale</h1>
        <p class="hidden slide-left">Des propriétés exceptionnelles pour des vacances inoubliables</p>
    </div>
    
    <div class="vacancy-search hidden slide-right">
        <form action="{{ route('vacances.filtrer') }}" method="Post" class="vacancy-form">
            @csrf
        <div class="vacancy-bar">
           <div class="vacancy-field">
    <i class="fas fa-map-marker-alt"></i>
    <select class="vacancy-select" name="wilaya">
        <option value="">Choisissez une wilaya</option>
        @foreach(config('wilayas') as $code => $name)
            <option value="{{ $code }}" {{ old('wilaya', request('wilaya')) == $code ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
</div>

            <div class="vacancy-field">
                <i class="far fa-calendar-alt"></i>
                <input type="date" id="dateArrivee" name="date_arrivee" class="vacancy-select" min="{{ date('Y-m-d') }}">
            </div>
            <div class="vacancy-field">
                <i class="far fa-calendar-alt"></i>
                <input type="date" id="dateDepart" name="date_depart" class="vacancy-select" min="{{ date('Y-m-d') }}">
            </div>
            <div class="vacancy-field">
                <i class="fas fa-user"></i>
                <select class="vacancy-select" name="capacite">
                    <option value="1-2">1-2 personnes</option>
                    <option value="3-4">3-4 personnes</option>
                    <option value="5+">5+ personnes</option>
                </select>
            </div>
            <button type="submit" class="search-button  button2">Rechercher</button>
        </div>
    </form>

    </div>


</section>

<section class="search-vacances">
    <form id="filter-form" method="Post" action="{{ route('vacances.filtrer') }}">
        @csrf
    <div class="filter-buttons">
        <button class="filter-btn" id="filter-toggle"><i class='bx bx-filter-alt'></i> Filtres</button>
        <button class="filter-btn"><i class='bx bx-water'></i> Plage</button>
        <button class="filter-btn"><i class='bx bx-mountain'></i> Montagne</button>
        <button class="filter-btn"><i class='bx bx-bell'></i> Campagne</button>
    </div>

    <div class="filter-menu" id="filter-menu">
        <div class="filter-header">
            <h3>Filtres avancés</h3>
            <button id="close-filter"><i class='bx bx-x'></i></button>
        </div>
        <div class="filter-contentt">
            <div class="filter-groupe">
                <label>Prix maximum par nuit</label>
                <input type="number" name="prix_max" placeholder="DZD">
            </div>
            <div class="filter-groupe">
                <label>Type de logement</label>
                <select name="type">
                    <option value="">Tous</option>
                    <option value="appartement">Appartement</option>
                    <option value="maison">Maison</option>
                    <option value="villa">Villa</option>
                </select>
            </div>
            <div class="filter-groupe">
                <label>Équipements</label>
                <div class="equipment-options">
                    <label><input type="checkbox" name="wifi"><i class='bx bx-wifi'></i> Wi-Fi</label>
                    <label><input type="checkbox" name="piscine"><i class='bx bx-pool'></i> Piscine</label>
                    <label><input type="checkbox" name="parking"><i class='bx bx-car'></i> Parking</label>
                </div>
            </div>
            
        </div>
        <div class="filter-actions">
            <button type="submit" class="button2">Appliquer</button>
        </div>
    </div>
</form>
</section>




<section class="annonce-prd" style=" padding-top:20px; margin-top:20px; border-radius:8px;">
    <h2 class="hidden slide-up">Découvrez nos dernières annonces</h2>
    <div class="annonce-list">
        @foreach($vacances as $vacance)
        <div class="product hidden slide-up">
            <div class="carousel">
                <span class="badge">Location vacances</span>
                <div class="carousel-inr">
                    @php
                        // Handle the image data (works whether it's JSON string or already decoded)
                        $images = [];
                        
                        if (!empty($vacance->main_image)) {
                            if (is_string($vacance->main_image)) {
                                // Remove any unexpected backslashes before decoding
                                $cleaned = stripslashes($vacance->main_image);
                                $images = json_decode($cleaned, true) ?? [];
                            } elseif (is_array($vacance->main_image)) {
                                $images = $vacance->main_image;
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
                <p class="prix">{{ number_format($vacance->prix_nuit, 0, ',', ' ') }}<span>DA</span></p>
                <h3>{{ $vacance->titre }}</h3>
                <p class="wilaya">{{ config('wilayas.'.$vacance->wilaya) }}</p>
                
                <div class="property-infoo">
                    <span><i class='bx bx-door-open'></i> {{ $vacance->chambres }} ch.</span>
                    <span><i class='bx bx-bath'></i> {{ $vacance->salles_bain }} sdb</span>
                    <span><i class='bx bx-user'></i> {{ $vacance->capacite }} pers.</span>
                </div>
        
                <div class="property-icons">
                    @if($vacance->wifi)<span class="icon"><i class='bx bx-wifi'></i></span>@endif
                    @if($vacance->parking)<span class="icon"><i class='bx bx-car'></i></span>@endif
                    @if($vacance->piscine)<span class="icon"><i class='bx bx-pool'></i></span>@endif
                    @if($vacance->climatisation)<span class="icon"><i class='bx bx-wind'></i></span>@endif
                    @if($vacance->cuisine)<span class="icon"><i class='bx bx-water'></i></span>@endif
                    @if($vacance->television)<span class="icon"><i class='bx bx-water'></i></span>@endif
                    @if($vacance->eau)<span class="icon"><i class='bx bx-water'></i></span>@endif
                </div>
        
                <div class="features">
                    <div class="iconss">
                        <span><i class='bx bx-bed'></i> {{ $vacance->chambres }}</span>
                        <span><i class='bx bx-bath'></i> {{ $vacance->salles_bain }}</span>
                        <span><i class='bx bx-square-rounded'></i> {{ $vacance->superficie }} m²</span>
                    </div>
                </div>
            </div>
        
            <div class="button-detail">
                <p class="type_ann">vacance</p>
                <a href="{{ route('vacance.details', $vacance) }}" class="button2 pr">Détails</a>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="pagination-controls hidden slide-up">
        <button id="prev-page" class="button2" disabled>Previous</button>
        <span id="page-indicator">Page 1 of 1</span>
        <button id="next-page" class="button2">Next</button>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Toggle filter menu
    const filterBtn = document.getElementById("filter-toggle");
    const filterMenu = document.getElementById("filter-menu");
    const closeFilter = document.getElementById("close-filter");

    function toggleFilters() {
        filterMenu.style.display = (filterMenu.style.display === "none" || filterMenu.style.display === "") ? "block" : "none";
    }

    filterBtn.addEventListener("click", function (event) {
        event.stopPropagation();
        event.preventDefault(); // Prevent the page from reloading
        toggleFilters();
    });

    closeFilter.addEventListener("click", function (event) {
        event.stopPropagation();
        event.preventDefault(); // Prevent the page from reloading
        filterMenu.style.display = "none";
    });

    document.addEventListener("click", function (event) {
        if (!filterMenu.contains(event.target) && event.target !== filterBtn) {
            filterMenu.style.display = "none";
        }
    });

    // Date pickers
    document.querySelectorAll(".vacancy-field").forEach(container => {
        let input = container.querySelector("input");
        let icon = container.querySelector("i");
    
        if (input && icon) {
            icon.addEventListener("click", () => input.showPicker());
            input.addEventListener("click", () => input.showPicker());
        }
    });

    // Location buttons
    document.querySelectorAll(".filter-btn:not(#filter-toggle)").forEach(btn => {
        btn.addEventListener("click", function() {
            const type = this.textContent.trim().toLowerCase();
            window.location.href = `{{ route('vacances.index') }}?location=${type}`;
        });
    });

    // Ensure departure date is after arrival date
    const dateArrivee = document.getElementById("dateArrivee");
    const dateDepart = document.getElementById("dateDepart");
    
    if (dateArrivee && dateDepart) {
        dateArrivee.addEventListener("change", function() {
            dateDepart.min = this.value;
            if (dateDepart.value && dateDepart.value < this.value) {
                dateDepart.value = "";
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const products = document.querySelectorAll('.annonce-list .product');
    const itemsPerPage = 6;
    let currentPage = 1;
    const totalPages = Math.ceil(products.length / itemsPerPage);
    
    // Get button elements
    const prevBtn = document.getElementById('prev-page');
    const nextBtn = document.getElementById('next-page');
    const pageIndicator = document.getElementById('page-indicator');
    
    // Initial check
    if (!products.length || !prevBtn || !nextBtn || !pageIndicator) {
        console.error('Required elements not found!');
        return;
    }

    function showPage(page) {
        // Validate page number
        if (page < 1) page = 1;
        if (page > totalPages) page = totalPages;
        currentPage = page;
        
        // Calculate visible range
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, products.length);
        
        // Update visibility
        products.forEach((product, index) => {
            product.style.display = (index >= startIndex && index < endIndex) 
                ? 'block' 
                : 'none';
        });
        
        // Update UI
        pageIndicator.textContent = `Page ${page} of ${totalPages}`;
        prevBtn.disabled = (page === 1);
        nextBtn.disabled = (page === totalPages);
    }
    
    // Event listeners
    prevBtn.addEventListener('click', (e) => {
        e.preventDefault();
        showPage(currentPage - 1);
    });
    
    nextBtn.addEventListener('click', (e) => {
        e.preventDefault();
        showPage(currentPage + 1);
    });
    
    // Initialize
    showPage(1);
});


</script>
<script>
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
</script>
@endsection