@extends('layouts.app2')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title') Anoonce  @endsection
@section("content")

 
<div class="header-info-annonce">
    <div class="containerr">
        <div class="head-agences">
            <h2 class="hidden slide-left">Nos Anonces Partenaires</h2>
            <div class="search-filter">
                <input type="text" class="hidden slide-right" placeholder="Rechercher une agence...">
                <button onclick="toggleFilters()" class="button2 hidden slide-right">
                    <i class='bx bx-slider-alt'></i> Filtres
                </button>
            </div>
        </div>
        

         <!-- Boîte de filtres -->
<!-- Replace just the search-filters div with this -->
<div class="search-filters" id="filterBox">
    <div class="filters-header">
        <h3>Filtres de recherche</h3>
        <button class="filters-close-btn" onclick="toggleFilters()">&times;</button>
    </div>
    
    <form method="GET" action="{{ route('home.annonces') }}" id="filterForm">
         <!-- Add a hidden input for search term -->
    @if(request('search'))
    <input type="hidden" name="search" value="{{ request('search') }}">
@endif
        <div class="filters-content">
            <!-- Transaction Type -->
           

           <!-- Property Type -->
<div class="filter-group">
    <label for="property-type">Type de bien</label>
    <select id="property-type" name="property_type">
        <option value="">Tous</option>
        <option value="appartement" {{ request('property_type') == 'appartement' ? 'selected' : '' }}>Appartement</option>
        <option value="bungalow" {{ request('property_type') == 'bungalow' ? 'selected' : '' }}>Bungalow</option>
        <option value="carcasse" {{ request('property_type') == 'carcasse' ? 'selected' : '' }}>Carcasse</option>
        <option value="villa" {{ request('property_type') == 'villa' ? 'selected' : '' }}>Villa</option>
        <option value="immeuble" {{ request('property_type') == 'immeuble' ? 'selected' : '' }}>Immeuble</option>
        <option value="local" {{ request('property_type') == 'local' ? 'selected' : '' }}>Local</option>
        <option value="hungar" {{ request('property_type') == 'hungar' ? 'selected' : '' }}>Hangar</option>
        <option value="terrain" {{ request('property_type') == 'terrain' ? 'selected' : '' }}>Terrain</option>
        <option value="bureaux_et_locaux" {{ request('property_type') == 'bureaux_et_locaux' ? 'selected' : '' }}>Bureaux et Locaux</option>
        <option value="salle_fetes" {{ request('property_type') == 'salle_fetes' ? 'selected' : '' }}>Salle des fêtes</option>
        <option value="garage_parking" {{ request('property_type') == 'garage_parking' ? 'selected' : '' }}>Garage / Parking</option>
        <option value="chalet" {{ request('property_type') == 'chalet' ? 'selected' : '' }}>Chalet</option>
        <option value="studio" {{ request('property_type') == 'studio' ? 'selected' : '' }}>Studio</option>
        <option value="commercial" {{ request('property_type') == 'commercial' ? 'selected' : '' }}>Commercial</option>
    </select>
</div>


            <!-- Price Range -->
            <div class="filter-group">
                <label for="min-price">Prix minimum</label>
                <input type="number" id="min-price" name="min_price" value="{{ request('min_price') }}" placeholder="DA min">
            </div>

            <div class="filter-group">
                <label for="max-price">Prix maximum</label>
                <input type="number" id="max-price" name="max_price" value="{{ request('max_price') }}" placeholder="DA max">
            </div>

            <!-- Wilaya Selection -->
            <div class="filter-group">
                <label for="wilaya">Wilaya</label>
                <select id="wilaya" name="wilaya" onchange="updateCommunes()">
                    <option value="">Toutes</option>
                    @foreach($wilayas as $code => $name)
                        <option value="{{ $code }}" {{ request('wilaya') == $code ? 'selected' : '' }}>
                            {{ $code }} - {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Commune Selection -->
            <div class="filter-group">
                <label for="commune">Commune</label>
                <select id="commune" name="commune">
                    <option value="">Toutes</option>
                    @if(request('wilaya') && isset($communes[request('wilaya')]))
                        @foreach($communes[request('wilaya')] as $commune)
                            <option value="{{ $commune }}" {{ request('commune') == $commune ? 'selected' : '' }}>
                                {{ $commune }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>

            <!-- Sort Options -->
            <div class="filter-group">
                <label for="sort-by">Trier par</label>
                <select id="sort-by" name="sort">
                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Plus récent</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Prix croissant</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="filter-actions">
                <button type="submit" class="button2">Appliquer</button>
                <a href="{{ route('home.annonces') }}" class="button2">Réinitialiser</a>
            </div>
        </div>
    </form>
</div>



<section class="annonce-prd">
    <div class="annonce-list">
        @foreach ($annonces as $annonce)

        <div class="product hidden slide-up">
            <div class="carousel">
               @if($annonce->agency)
    @if($annonce->agency->is_premium)
        <span class="badge-premium">Premium</span>
    @elseif($annonce->agency->is_pro)
        <span class="badge-pro">Pro</span>
    @endif
@endif

                <span class="badge"  >
                     @if($annonce->status == 'a_vendre')
                    À vendre
                @elseif($annonce->status == 'a_louer')
                    À louer
                @else
                    Vendu
                @endif</span>
                
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
                <button class="carousel-control prev " >❮</button>
                <button class="carousel-control next " >❯</button>
            </div>
        
            
        
            <div class="détails">
              <p class="prix">{{ $annonce->price }}<span> DA</span></p>
              <h3>{{ $annonce->title }}</h3>
              <p class="wilaya">{{ $annonce->commune }}, {{ $annonce->wilaya }}</p>
              <div class="features">
                  <div class="iconss">
                      <span><i class='bx bx-bed'></i> {{ $annonce->bedrooms ?? '-' }}</span>
                      <span><i class='bx bx-bath'></i>  {{ $annonce->bathrooms ?? '-' }}</span>
                      <span><i class='bx bx-square-rounded' ></i> {{ $annonce->surface ?? '-' }} m²</span>
                  </div>
                  
              </div>
            </div>
            <div class="button-detail">
                <p class="type_ann">{{ $annonce->type }}</p>
                <a href="{{ route('home.detaills', $annonce->id) }}" class="button2 pr">détails</a>
            </div>
        </div>
        @endforeach
    </div>
        
    <div class="pagination-controls hidden slide-up">
        <button id="prev-page" class="button2 " disabled>Previous</button>
        <span id="page-indicator ">Page 1 of 1</span>
        <button id="next-page" class="button2 ">Next</button>
    </div>
</section>
        


    </div>
</div>
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
<script>
    // This object contains all wilayas with their communes
    function updateCommunes() {
        const wilayaSelect = document.getElementById('wilaya');
        const communeSelect = document.getElementById('commune');
        const selectedWilaya = wilayaSelect.value;
        
        // Clear previous options
        communeSelect.innerHTML = '<option value="">Toutes</option>';
        
        if (selectedWilaya) {
            // Make AJAX request to get communes
            fetch(`/get-communes?wilaya=${selectedWilaya}`)
                .then(response => response.json())
                .then(communes => {
                    communes.forEach(commune => {
                        const option = document.createElement('option');
                        option.value = commune;
                        option.textContent = commune;
                        communeSelect.appendChild(option);
                        
                        // Preselect if matching request parameter
                        if (commune === "{{ request('commune') }}") {
                            option.selected = true;
                        }
                    });
                });
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('wilaya').value) {
            updateCommunes();
        }
    });


</script>
    
            
<script>
document.addEventListener('DOMContentLoaded', function() {
    const products = document.querySelectorAll('.annonce-list .product');
    const itemsPerPage = 6;
    let currentPage = 1;
    const totalPages = Math.ceil(products.length / itemsPerPage);
    
    function updatePagination() {
        // Update page indicator
        document.getElementById('page-indicator').textContent = 
            `Page ${currentPage} of ${totalPages}`;
        
        // Update button states
        document.getElementById('prev-page').disabled = currentPage === 1;
        document.getElementById('next-page').disabled = currentPage === totalPages;
    }
    
    function showPage(page) {
        currentPage = page;
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        
        products.forEach((product, index) => {
            product.style.display = (index >= startIndex && index < endIndex) 
                ? 'block' 
                : 'none';
        });
        
        updatePagination();
    }
    
    // Event listeners
    document.getElementById('prev-page').addEventListener('click', () => {
        if (currentPage > 1) showPage(currentPage - 1);
    });
    
    document.getElementById('next-page').addEventListener('click', () => {
        if (currentPage < totalPages) showPage(currentPage + 1);
    });
    
    // Initialize
    showPage(1);
});




function toggleFilters() {
    let filterBox = document.getElementById("filterBox");
    filterBox.style.display = (filterBox.style.display === "none" || filterBox.style.display === "") ? "block" : "none";
}

document.getElementById("toggleFilter").addEventListener("click", toggleFilters);
document.getElementById("closeFilter").addEventListener("click", toggleFilters);
</script>


@endsection