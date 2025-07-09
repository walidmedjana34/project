@extends('layouts.agence.app')

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/Dashboard-agence.css') }}">
@endpush

@section('title') Properties @endsection

@section("content")
    <header>
        <h1>Properties</h1>
        <p>Manage and monitor all your agency's property listings in one place.</p>
    </header>

    <div class="search-container">
        <div class="search-bar">
            <input type="text" placeholder="Search by property name, address, ID..." />
        </div>
        <div class="filters">
            <select>
                <option>Price Range</option>
            </select>
            <select>
                <option>Status</option>
            </select>
            <select>
                <option>Location</option>
            </select>
        </div>
    </div>

    <div class="property-container">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Property</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Listed Date</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($properties as $property)
                <tr class="property-list-item">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            @if($property->main_image)
                            <div class="flex-shrink-0 h-10 w-14">
                                <img class="h-10 w-14 rounded object-cover" 
                                     src="{{ asset(json_decode($property->main_image)[0] ?? 'default-image.jpg') }}" 
                                     alt="{{ $property->title }}">
                            </div>
                            @endif
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $property->title }}</div>
                                <div class="text-sm text-gray-500">
                                    {{ $property->bedrooms }} beds • 
                                    {{ $property->bathrooms }} baths • 
                                    {{ $property->area }} sq ft
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $property->wilaya }}, {{ $property->commune }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ number_format($property->price) }} DA</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full 
                            {{ $property->status === 'for_sale' ? 'bg-green-100 text-green-800' : 
                               ($property->status === 'for_rent' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                            @if($property->status === 'for_sale') For Sale
                            @elseif($property->status === 'for_rent') For Rent
                            @elseif($property->status === 'sold') Sold
                            @else {{ ucfirst(str_replace('_', ' ', $property->status)) }}
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $property->views ?? 0 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $property->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            
                            <button id="openModalBtn-{{ $property->id }}" class="btn open-modal-btn" data-target="editModal-{{ $property->id }}">Edit</button>
                            
                            <!-- Modal -->
                            <!-- Modal -->
<div id="editModal-{{ $property->id }}" class="modal">
  <div class="modal-content">
    <span class="close-btn" data-target="editModal-{{ $property->id }}">&times;</span>
    <h2>Modifier l'annonce</h2>

    <form action="{{ route('agence.update', $property->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <label for="title">Titre :</label>
      <input type="text" id="title" name="title" value="{{ $property->title }}">

      <label for="description">Description :</label>
      <textarea id="description" name="description" rows="4">{{ $property->description }}</textarea>

      <label for="price">Prix :</label>
      <input type="number" id="price" name="price" value="{{ $property->price }}">

      <label for="type">Type :</label>
      <select id="type" name="type">
        <option value="appartement" {{ $property->type == 'appartement' ? 'selected' : '' }}>Appartement</option>
        <option value="bungalow" {{ $property->type == 'bungalow' ? 'selected' : '' }}>Bungalow</option>
        <option value="carcasse" {{ $property->type == 'carcasse' ? 'selected' : '' }}>Carcasse</option>
        <option value="villa" {{ $property->type == 'villa' ? 'selected' : '' }}>Villa</option>
      </select>

      <label for="status">Statut :</label>
     <select id="status" name="status">
    <option value="a_vendre" {{ $property->status == 'a_vendre' ? 'selected' : '' }}>À vendre</option>
    <option value="vendu" {{ $property->status == 'vendu' ? 'selected' : '' }}>Vendu</option>
    <option value="a_louer" {{ $property->status == 'a_louer' ? 'selected' : '' }}>À louer</option>
</select>
 @php
    $wilayas = config('wilayas');
    $allCommunes = config('communes');
    
    // Find the wilaya code for the property's wilaya
    $wilayaCode = array_search($property->wilaya, $wilayas);
    $communesList = $allCommunes[$wilayaCode] ?? [];
@endphp

<!-- Wilaya Dropdown -->
<label for="wilaya">Wilaya:</label>
<select id="wilaya" name="wilaya" required>
    <option value="">Select Wilaya</option>
    @foreach($wilayas as $code => $name)
        <option value="{{ $code }}" {{ $property->wilaya == $name ? 'selected' : '' }}>
            {{ $name }}
        </option>
    @endforeach
</select>

<!-- Commune Dropdown -->
<label for="commune">Commune:</label>
<select id="commune" name="commune" required>
    <option value="">Select Commune</option>
    @foreach($communesList as $commune)
        <option value="{{ $commune }}" {{ $property->commune == $commune ? 'selected' : '' }}>
            {{ $commune }}
        </option>
    @endforeach
</select>

      <label for="address">Adresse :</label>
      <input type="text" id="address" name="address" value="{{ $property->address }}">

      <label for="bedrooms">Chambres :</label>
      <input type="number" id="bedrooms" name="bedrooms" value="{{ $property->bedrooms }}">

      <label for="bathrooms">Salles de bain :</label>
      <input type="number" id="bathrooms" name="bathrooms" value="{{ $property->bathrooms }}">

      <label for="surface">Surface (m²) :</label>
      <input type="number" id="surface" name="surface" value="{{ $property->surface }}">

      <label for="etat_bien">État du bien :</label>
      <select id="etat_bien" name="etat_bien">
        <option value="neuf" {{ $property->etat_bien == 'neuf' ? 'selected' : '' }}>Neuf</option>
        <option value="renove" {{ $property->etat_bien == 'renove' ? 'selected' : '' }}>Rénové</option>
        <option value="bon-etat" {{ $property->etat_bien == 'bon-etat' ? 'selected' : '' }}>Bon état</option>
        <option value="a-renover" {{ $property->etat_bien == 'a-renover' ? 'selected' : '' }}>À rénover</option>
      </select>

      

      <div>
         <button type="submit" class="btn">Enregistrer</button>
      </div>
    </form>
  </div>
</div>

                           <form action="{{ route('agence.destroyy', $property->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vacation property?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="button red">
                    Delete
                  </button>
                
                </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                        No properties found for your agency.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    

    @if($properties->hasPages())
    <div class="pagination-container">
        <div class="pagination-info">
            Showing {{ $properties->firstItem() }} to {{ $properties->lastItem() }} of {{ $properties->total() }} properties
        </div>
        
        <ul class="pagination">
            @if($properties->onFirstPage())
                <li class="disabled"><span><</span></li>
            @else
                <li><a href="{{ $properties->previousPageUrl() }}"><</a></li>
            @endif

            @foreach($properties->getUrlRange(1, $properties->lastPage()) as $page => $url)
                @if($page == $properties->currentPage())
                    <li class="active"><span>{{ $page }}</span></li>
                @else
                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach

            @if($properties->hasMorePages())
                <li><a href="{{ $properties->nextPageUrl() }}">></a></li>
            @else
                <li class="disabled"><span>></span></li>
            @endif
        </ul>
    </div>
    @endif
@endsection
@push('scripts')
<script>
    document.querySelectorAll('.open-modal-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const modalId = this.getAttribute('data-target');
            document.getElementById(modalId).style.display = 'block';
        });
    });

    document.querySelectorAll('.close-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const modalId = this.getAttribute('data-target');
            document.getElementById(modalId).style.display = 'none';
        });
    });

    // Optional: Close modals if clicking outside content
    window.onclick = function(event) {
        document.querySelectorAll('.modal').forEach(modal => {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });
    }
    document.addEventListener('DOMContentLoaded', function() {
    const wilayaSelect = document.getElementById('wilaya');
    const communeSelect = document.getElementById('commune');
    
    // Load communes data from backend
    const communesData = @json($allCommunes);
    
    // Function to update communes dropdown
    function updateCommunes() {
        const wilayaCode = wilayaSelect.value;
        const communes = communesData[wilayaCode] || [];
        
        // Clear and repopulate communes dropdown
        communeSelect.innerHTML = '<option value="">Select Commune</option>';
        communes.forEach(commune => {
            const option = document.createElement('option');
            option.value = commune;
            option.textContent = commune;
            communeSelect.appendChild(option);
        });
    }
    
    // Update communes when wilaya changes
    wilayaSelect.addEventListener('change', updateCommunes);
    
    // Initialize communes if wilaya is already selected
    if (wilayaSelect.value) {
        updateCommunes();
        
        // If editing, select the saved commune
        @if($property->commune)
            setTimeout(() => {
                const savedCommune = "{{ $property->commune }}";
                if (savedCommune) {
                    const options = communeSelect.options;
                    for (let i = 0; i < options.length; i++) {
                        if (options[i].value === savedCommune) {
                            options[i].selected = true;
                            break;
                        }
                    }
                }
            }, 100);
        @endif
    }
});
</script>
@endpush


