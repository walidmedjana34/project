@extends('layouts.agence.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title') Visites @endsection

@section("content")
    <header>
      <h1>Property Visits</h1>
      <p>Manage and track all scheduled property visits.</p>
    </header>
  
    <div class="visit-card">
      <!-- Tabs -->
      <div class="visit-tabs">
        <button class="visit-tab-button {{ !request()->has('status') ? 'active' : '' }}" data-tab="all">All Visits</button>
        <button class="visit-tab-button {{ request('status') == 'pending' ? 'active' : '' }}" data-tab="pending">Pending</button>
        <button class="visit-tab-button {{ request('status') == 'confirmed' ? 'active' : '' }}" data-tab="confirmed">Confirmed</button>
        <button class="visit-tab-button {{ request('status') == 'completed' ? 'active' : '' }}" data-tab="completed">Completed</button>
        <button class="visit-tab-button {{ request('status') == 'canceled' ? 'active' : '' }}" data-tab="canceled">Canceled</button>
      </div>
    
      <!-- Info and Sort -->
      <div class="visit-toolbar">
        <span id="visit-count">Showing {{ $visits->firstItem() }} to {{ $visits->lastItem() }} of {{ $visits->total() }} visits</span>
        <label>
          Sort by:
          <select class="visit-sort-select" id="sort-select">
            <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>Date (Newest)</option>
            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Date (Oldest)</option>
          </select>
        </label>
      </div>
    </div>

    <div class="visit-list">
      @foreach($visits as $visit)
        <div class="visit-item">
          <div class="visit-info">
            <img class="visit-avatar" src="https://cdn-icons-png.flaticon.com/512/4712/4712027.png" alt="Robot Guest">

            <div class="visit-details">
              <h4>{{ $visit->user->name ?? 'Guest User' }}</h4>
              
              <div class="property">
                <i class='bx bx-building-house'></i>
                @if($visit->property)
                  {{ $visit->property->title }}, {{ $visit->property->address }}
                @elseif($visit->vacance)
                  {{ $visit->vacance->title }}, {{ $visit->vacance->address }}
                @else
                  Property not available
                @endif
              </div>
              <div class="meta">
                <i class='bx bx-calendar'></i>
                {{ $visit->scheduled_date->format('l, F j, Y g:i A') }}
              </div>
              @if($visit->notes)
              <div class="note">
                <i class='bx bx-message-rounded-dots'></i>
                {{ $visit->notes }}
              </div>
              @endif
            </div>
          </div>
          <div class="visit-actions">
            <span class="visit-status {{ $visit->status }}">{{ ucfirst($visit->status) }}</span>
            <div class="visit-buttons">
              @if($visit->status == 'pending')
                <button class="btn btn-confirm update-status" data-status="confirmed" data-visit-id="{{ $visit->id }}">Confirm</button>
                <button class="btn btn-cancel update-status" data-status="canceled" data-visit-id="{{ $visit->id }}">Cancel</button>
              @elseif($visit->status == 'confirmed')
                <button class="btn btn-complete update-status" data-status="completed" data-visit-id="{{ $visit->id }}">Mark Complete</button>
                <button class="btn btn-cancel update-status" data-status="canceled" data-visit-id="{{ $visit->id }}">Cancel</button>
              @endif
            </div>
            <button class="menu-button"><i class='bx bx-dots-vertical-rounded'></i></button>
          </div>
        </div>
      @endforeach
    </div>

    <div class="pagination-container">
      <div class="pagination-info">Showing {{ $visits->firstItem() }} to {{ $visits->lastItem() }} of {{ $visits->total() }} visits</div>
      
      <ul class="pagination">
          <li class="{{ $visits->onFirstPage() ? 'disabled' : '' }}">
              <a href="{{ $visits->previousPageUrl() }}"><</a>
          </li>
          
          @foreach(range(1, $visits->lastPage()) as $i)
              @if($i == 1 || $i == $visits->lastPage() || abs($i - $visits->currentPage()) < 3)
                  <li class="{{ $visits->currentPage() == $i ? 'active' : '' }}">
                      <a href="{{ $visits->url($i) }}">{{ $i }}</a>
                  </li>
              @elseif(abs($i - $visits->currentPage()) == 3)
                  <li><a href="#">...</a></li>
              @endif
          @endforeach
          
          <li class="{{ !$visits->hasMorePages() ? 'disabled' : '' }}">
              <a href="{{ $visits->nextPageUrl() }}">></a>
          </li>
      </ul>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Tab filtering
    $('.visit-tab-button').click(function() {
        const tab = $(this).data('tab');
        if(tab === 'all') {
            window.location.href = "{{ route('agence.visites') }}";
        } else {
            window.location.href = "{{ route('agence.visites') }}?status=" + tab;
        }
    });

    // Sort select change
    $('#sort-select').change(function() {
        const sort = $(this).val();
        const url = new URL(window.location.href);
        url.searchParams.set('sort', sort);
        window.location.href = url.toString();
    });

    // Status update - version améliorée avec feedback
    $(document).on('click', '.update-status', function() {
        const button = $(this);
        const visitId = button.data('visit-id');
        const status = button.data('status');
        const url = "{{ route('agence.visits.update-status', ':id') }}".replace(':id', visitId);
        
        // Désactive le bouton pendant la requête
        button.prop('disabled', true).addClass('loading');
        
        $.ajax({
            url: url,
            method: 'PUT',
            data: {
                _token: "{{ csrf_token() }}",
                status: status
            },
            success: function(response) {
                if(response.success) {
                    // Recharge après 1 seconde pour voir le feedback
                    setTimeout(() => location.reload(), 1000);
                } else {
                    alert(response.message || 'Erreur lors de la mise à jour');
                    button.prop('disabled', false).removeClass('loading');
                }
            },
            error: function(xhr) {
                let errorMsg = 'Erreur inconnue';
                if(xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                } else if(xhr.statusText) {
                    errorMsg = xhr.statusText;
                }
                alert('Erreur: ' + errorMsg);
                button.prop('disabled', false).removeClass('loading');
            }
        });
    });
});
</script>
@endpush