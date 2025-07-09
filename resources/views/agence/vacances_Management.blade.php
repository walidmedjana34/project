@extends('layouts.agence.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/Dashboard-agence.css') }}">
@endpush 
@section('title') Vacations Management @endsection
@section("content")
    <header>
      <h1>Vacations Management</h1>
      <p>Manage all your agency's vacation properties in one place.</p>
    </header>
    
    <div class="search-container">
      <div class="search-bar">
        <input type="text" placeholder="Search by property name, location, ID..." />
      </div>
      <div class="filters">
        <select>
          <option>All Status</option>
          <option>Approved</option>
          <option>Pending</option>
          <option>Rejected</option>
        </select>
        <select>
          <option>All Types</option>
          <option>Apartment</option>
          <option>House</option>
          <option>Villa</option>
          <option>Cottage</option>
        </select>
      </div>
    </div>

    <div class="property-container">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Property</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price/Night</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin Status</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Listed Date</th>
            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($Vacances as $vacance)
          <tr class="property-list-item">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-14">
                  @if($vacance->main_image)
                    <img class="h-10 w-14 rounded object-cover" src="{{ asset(json_decode($vacance->main_image)[0] ?? '') }}" alt="{{ $vacance->titre }}">
                  @else
                    <div class="h-10 w-14 bg-gray-200 rounded flex items-center justify-center">
                      <span class="text-xs text-gray-500">No Image</span>
                    </div>
                  @endif
                </div>
                <div class="ml-4">
                  <div class="text-sm font-medium text-gray-900">{{ $vacance->titre }}</div>
                  <div class="text-sm text-gray-500">{{ $vacance->chambres }} beds • {{ $vacance->salles_bain }} baths • {{ $vacance->superficie ?? 'N/A' }} sq ft</div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm text-gray-900">{{ $vacance->wilaya }}, {{ $vacance->commune }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="text-sm font-medium text-gray-900">${{ number_format($vacance->prix_nuit) }}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              @if($vacance->statut == 'disponible')
                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full bg-green-100 text-green-800">Available</span>
              @elseif($vacance->statut == 'reserve')
                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full bg-yellow-100 text-yellow-800">Reserved</span>
              @else
                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full bg-red-100 text-red-800">Rented</span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap">
              @if($vacance->admin_status == 'approved')
                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full bg-green-100 text-green-800">Approved</span>
              @elseif($vacance->admin_status == 'pending')
                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full bg-yellow-100 text-yellow-800">Pending</span>
              @else
                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full bg-red-100 text-red-800">Rejected</span>
              @endif
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $vacance->created_at->format('M d, Y') }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
              <div class="flex justify-end space-x-2">
                <button class="openModalBtn" data-id="{{ $vacance->id }}">Edit</button>

<!-- Modal -->
<div id="editModal-{{ $vacance->id }}" class="modal">
  <div class="modal-content">
    <span class="closeModalBtn" data-target="editModal-{{ $vacance->id }}">&times;</span>
    <h2>Modifier l'annonce</h2>

    <form id="editForm-{{ $vacance->id }}" action="{{ route('agence.updatee', $vacance->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      
      <label for="title-{{ $vacance->id }}">Titre :</label>
      <input type="text" id="title-{{ $vacance->id }}" name="titre" value="{{ $vacance->titre }}" required>

      <label for="description-{{ $vacance->id }}">Description :</label>
      <textarea id="description-{{ $vacance->id }}" name="description" rows="4" required>{{ $vacance->description }}</textarea>

      <label for="price-{{ $vacance->id }}">Prix par nuit :</label>
      <input type="number" id="price-{{ $vacance->id }}" name="prix_nuit" value="{{ $vacance->prix_nuit }}" required>

      <label for="type-{{ $vacance->id }}">Type :</label>
      <select id="type-{{ $vacance->id }}" name="type" required>
        <option value="appartement" {{ $vacance->type == 'appartement' ? 'selected' : '' }}>Appartement</option>
        <option value="maison" {{ $vacance->type == 'maison' ? 'selected' : '' }}>Maison</option>
        <option value="villa" {{ $vacance->type == 'villa' ? 'selected' : '' }}>Villa</option>
        <option value="chalet" {{ $vacance->type == 'chalet' ? 'selected' : '' }}>Chalet</option>
      </select>

      <label for="status-{{ $vacance->id }}">Statut :</label>
      <select id="status-{{ $vacance->id }}" name="statut" required>
        <option value="disponible" {{ $vacance->statut == 'disponible' ? 'selected' : '' }}>Disponible</option>
        <option value="reserve" {{ $vacance->statut == 'reserve' ? 'selected' : '' }}>Réservé</option>
        <option value="loue" {{ $vacance->statut == 'loue' ? 'selected' : '' }}>Loué</option>
      </select>

       @php
    $wilayas = config('wilayas');
    $allCommunes = config('communes');
    
    // Find the wilaya code for the property's wilaya
    $wilayaCode = array_search($vacance->wilaya, $wilayas);
    $communesList = $allCommunes[$wilayaCode] ?? [];
@endphp

<!-- Wilaya Dropdown -->
<label for="wilaya">Wilaya:</label>
<select id="wilaya" name="wilaya" required>
    <option value="">Select Wilaya</option>
    @foreach($wilayas as $code => $name)
        <option value="{{ $code }}" {{ $vacance->wilaya == $name ? 'selected' : '' }}>
            {{ $name }}
        </option>
    @endforeach
</select>

<!-- Commune Dropdown -->
<label for="commune">Commune:</label>
<select id="commune" name="commune" required>
    <option value="">Select Commune</option>
    @foreach($communesList as $commune)
        <option value="{{ $commune }}" {{ $vacance->commune == $commune ? 'selected' : '' }}>
            {{ $commune }}
        </option>
    @endforeach
</select>

      <label for="address-{{ $vacance->id }}">Adresse :</label>
      <input type="text" id="address-{{ $vacance->id }}" name="localisation" value="{{ $vacance->localisation }}" required>

      <label for="bedrooms-{{ $vacance->id }}">Chambres :</label>
      <input type="number" id="bedrooms-{{ $vacance->id }}" name="chambres" value="{{ $vacance->chambres }}" required>

      <label for="bathrooms-{{ $vacance->id }}">Salles de bain :</label>
      <input type="number" id="bathrooms-{{ $vacance->id }}" name="salles_bain" value="{{ $vacance->salles_bain }}" required>

      <label for="capacity-{{ $vacance->id }}">Capacité :</label>
      <input type="text" id="capacity-{{ $vacance->id }}" name="capacite" value="{{ $vacance->capacite }}" required>

      <label for="surface-{{ $vacance->id }}">Surface (m²) :</label>
      <input type="number" id="surface-{{ $vacance->id }}" name="superficie" value="{{ $vacance->superficie }}">

      <label for="type_annonce-{{ $vacance->id }}">Type d'annonce :</label>
      <select id="type_annonce-{{ $vacance->id }}" name="type_annonce" required>
        <option value="location" {{ $vacance->type_annonce == 'location' ? 'selected' : '' }}>Location</option>
        <option value="vente" {{ $vacance->type_annonce == 'vente' ? 'selected' : '' }}>Vente</option>
      </select>

      <label for="disponible_de-{{ $vacance->id }}">Disponible de :</label>
      <input type="date" id="disponible_de-{{ $vacance->id }}" name="disponible_de" value="{{ $vacance->disponible_de ? \Carbon\Carbon::parse($vacance->disponible_de)->format('Y-m-d') : '' }}">

      <label for="disponible_jusqua-{{ $vacance->id }}">Disponible jusqu'à :</label>
      <input type="date" id="disponible_jusqua-{{ $vacance->id }}" name="disponible_jusqua" value="{{ $vacance->disponible_jusqua ? \Carbon\Carbon::parse($vacance->disponible_jusqua)->format('Y-m-d') : '' }}">

      <input type="hidden" name="agency_id" value="{{ $vacance->agency_id }}">

      <div>
        <button type="submit" class="btn">Enregistrer</button>
      </div>
    </form>
  </div>
</div>

                  
                <form action="{{ route('agence.destroy', $vacance->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this vacation property?')">
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
              No vacation properties found. <a href="{{ route('home.type-annonce') }}" class="text-blue-500 hover:text-blue-700">Create one now</a>.
            </td>
          </tr>
         
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="pagination-container">
      <div class="pagination-info">Showing {{ $Vacances->firstItem() }} to {{ $Vacances->lastItem() }} of {{ $Vacances->total() }} properties</div>
      
      <ul class="pagination">
        @if ($Vacances->onFirstPage())
          <li class="disabled"><span><</span></li>
        @else
          <li><a href="{{ $Vacances->previousPageUrl() }}"><</a></li>
        @endif

        @foreach ($Vacances->getUrlRange(1, $Vacances->lastPage()) as $page => $url)
          @if ($page == $Vacances->currentPage())
            <li class="active"><span>{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach

        @if ($Vacances->hasMorePages())
          <li><a href="{{ $Vacances->nextPageUrl() }}">></a></li>
        @else
          <li class="disabled"><span>></span></li>
        @endif
      </ul>
    </div>
   
  
@endsection
{{-- @push('scripts')
<script>
  function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) modal.classList.remove('hidden');
  }

  function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) modal.classList.add('hidden');
  }

  // Optional: Close modal on background click
  document.addEventListener('click', function (event) {
    const modals = document.querySelectorAll('.modal');
    modals.forEach(modal => {
      if (!modal.classList.contains('hidden') && event.target === modal) {
        modal.classList.add('hidden');
      }
    });
  });
</script>
@endpush --}}
<script>
  document.addEventListener("DOMContentLoaded", function () {
  // Handle all open buttons
  document.querySelectorAll('.openModalBtn').forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      document.getElementById(`editModal-${id}`).style.display = 'block';
    });
  });

  // Handle all close buttons
  document.querySelectorAll('.closeModalBtn').forEach(button => {
    button.addEventListener('click', function() {
      const id = this.getAttribute('data-id');
      document.getElementById(`editModal-${id}`).style.display = 'none';
    });
  });

  // Close when clicking outside any modal
  window.addEventListener('click', function(event) {
    if (event.target.classList.contains('modal')) {
      event.target.style.display = 'none';
    }
  });
});
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
        @if($vacance->commune)
            setTimeout(() => {
                const savedCommune = "{{ $vacance->commune }}";
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
