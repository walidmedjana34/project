@extends('layouts.app2')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title') Agence  @endsection
@section("content")
 
<div class="header-info-agence">
    <div class="containerr">
        <div class="head-agences">
            <h2 class="hidden slide-up">Nos Agences Partenaires</h2>
            <div class="search-filter">
                <input type="text" class="hidden slide-right"  placeholder="Rechercher une agence...">
                <button onclick="toggleFilters()" class="button2 hidden slide-right">
                    <i class='bx bx-slider-alt'></i> Filtres
                </button>
            </div>
        </div>
        

        <!-- Boîte de filtres -->
        <div class="filter-box" id="filterBox" style="display: none;">
            <div class="filter-header">
                <h3>Filtres</h3>
                <button class="close-btn" onclick="toggleFilters()">&times;</button>
            </div>
            <form method="GET" action="{{ route('agence.agences') }}" id="filterForm">
                <div class="filter-content">
                    <div class="filter-group">
                        <label for="wilaya">Wilaya</label>
                        <select id="wilaya" name="wilaya" onchange="updateCommunes()" class="form-select">
                            <option value="">Toutes</option>
                            @foreach(config('wilayas') as $code => $name)
                                <option value="{{ $code }}" {{ request('wilaya') == $code ? 'selected' : '' }}>
                                    {{ $code }} - {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="commune">Commune</label>
                        <select id="commune" name="commune">
                            <option value="">Toutes</option>
                            @if(request('wilaya') && !empty($communes))
                                @foreach($communes as $commune)
                                    <option value="{{ $commune }}" {{ request('commune') == $commune ? 'selected' : '' }}>
                                        {{ $commune }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                
                    <div class="filter-group">
                        <label for="agency_type">Type d'agence</label>
                        <select id="agency_type" name="agency_type" class="form-control">
                            <option value="">Tous les types</option>
                            @foreach([
                                'Vente' => 'Vente',
                                'Location' => 'Location',
                                'Consultation' => 'Consultation',
                                'Multi-services' => 'Multi-services'
                            ] as $value => $label)
                                <option value="{{ $value }}" 
                                    @if(request('agency_type') == $value) selected @endif>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
            
                    <div class="filter-group">
                        <label for="sort">Trier par</label>
                        <select id="sort" name="sort" class="form-select">
                            <option value="">Par défaut</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nom (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nom (Z-A)</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Note</option>
                        </select>
                    </div>
                    
                    <div class="filter-actions">
                        <button type="submit" class="button2">Appliquer</button>
                        <a href="{{ route('agence.agences') }}" class="button2">Réinitialiser</a>
                    </div>
                </div>
            </form>
        </div>
        
        <section style="margin: 30px 0;">
            <div class="annonce-list">
                @foreach($agencies as $agency)
                @if($agency->status === 'approved')
                <div class="product hidden slide-left">
                    @if($agency->logo)
                    <img src="data:image/png;base64,{{ $agency->logo }}" alt="{{ $agency->name }}">
                    @else
                    <img src="{{ asset('assets/img/accueil/image/im2.jpg') }}" alt="{{ $agency->name }}">
                    @endif
                    <div class="rating"><i class='bx bxs-star'></i> {{ $agency->rating }}</div>
                    <div class="détails">
                        <h3>{{ $agency->name }}</h3>
                        <p><i class='bx bx-map' style="color: #0092ca"></i> {{ $agency->address }}</p>
                        <p><i class='bx bx-phone' style="color: #0092ca"></i> {{ $agency->phone_number }}</p>
                        <p><i class='bx bx-envelope' style="color: #0092ca"></i> {{ $agency->email }}</p>
                        <p class="description">{{ $agency->description }}</p>
                        <span class="availability">{{ $agency->properties_available }} annonce </span>
                        <a href="{{ route('agence.profile', $agency->id) }}" class="profile-btn button2">Voir le profil</a>
                    </div>
                    
                </div>
                @endif
                @endforeach
                
            </div>
        </section>
        <!-- Pagination Controls -->
        <div class="custom-pagination hidden slide-up">
           <button id="prev-page" class="button2">Previous</button>
           <span id="page-indicator">Page 1 of 2</span>
           <button id="next-page" class="button2">Next</button>
       </div>
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
    document.addEventListener('DOMContentLoaded', function () {
    const agencyCards = document.querySelectorAll('.agency-list .agency-card');
    const itemsPerPage = 6;
    let currentPage = 1;

    // Function to show the current page's agency cards
    function showPage(page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        // Hide all agency cards
        agencyCards.forEach(card => {
            card.style.display = 'none';
        });

        // Show only the agency cards for the current page
        for (let i = startIndex; i < endIndex && i < agencyCards.length; i++) {
            agencyCards[i].style.display = 'block';
        }

        // Update the page indicator
        document.getElementById('page-indicator').textContent = `Page ${page} of ${Math.ceil(agencyCards.length / itemsPerPage)}`;
    }

    // Event listener for the "Next" button
    document.getElementById('next-page').addEventListener('click', function () {
        if (currentPage < Math.ceil(agencyCards.length / itemsPerPage)) {
            currentPage++;
            showPage(currentPage);
        }
    });

    // Event listener for the "Previous" button
    document.getElementById('prev-page').addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            showPage(currentPage);
        }
    });

    // Initialize the first page
    showPage(currentPage);
});

    function toggleFilters() {
    let filterBox = document.getElementById("filterBox");
    if (filterBox.style.display === "none" || filterBox.style.display === "") {
        filterBox.style.display = "block";
    } else {
        filterBox.style.display = "none";
    }
}

</script>
<script>
    // This object contains all wilayas with their communes
    
    
    function updateCommunes() {
    const wilayaSelect = document.getElementById('wilaya');
    const communeSelect = document.getElementById('commune');
    const selectedWilaya = wilayaSelect.value;
    
    communeSelect.innerHTML = '<option value="">Toutes</option>';
    
    if (selectedWilaya) {
        fetch(`/get-communes?wilaya=${selectedWilaya}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(communes => {
                communes.forEach(commune => {
                    const option = document.createElement('option');
                    option.value = commune;
                    option.textContent = commune;
                    communeSelect.appendChild(option);
                    
                    if (commune === "{{ request('commune') }}") {
                        option.selected = true;
                    }
                });
            })
            .catch(error => {
                console.error('Error fetching communes:', error);
            });
    }
}
    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('wilaya').value) {
            updateCommunes();
        }
    });
    </script>
@endsection