@extends('layouts.agence.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title') Dashboard agence @endsection

@section("content")
    <header>
      <h1>Agency Dashboard</h1>
      <p>Welcome back, {{ $agency->name }}! Here's what's happening with your properties today.</p>
    </header>

    <div class="stats">
      <div class="stat-card">
        <h2><i class='bx bxs-home'></i> Total Properties</h2>
        <div class="value">{{ $stats['total_properties'] }}</div>
        <div class="change positive"><i class='bx bx-up-arrow-alt'></i> 8% from last month</div>
      </div>
      <div class="stat-card">
        <h2><i class='bx bxs-calendar'></i> Pending Visits</h2>
        <div class="value">{{ $stats['pending_visits'] }}</div>
        <div class="change positive"><i class='bx bx-up-arrow-alt'></i> 12% from last week</div>
      </div>
      <div class="stat-card">
        <h2><i class='bx bxs-message'></i> Unread Messages</h2>
        <div class="value">{{ $stats['unread_messages'] }}</div>
        <div class="change negative"><i class='bx bx-down-arrow-alt'></i> 3 from yesterday</div>
      </div>
      <div class="stat-card">
        <h2><i class='bx bxs-dollar-circle'></i> Monthly Revenue</h2>
        <div class="value">${{ number_format($stats['monthly_revenue'], 2) }}</div>
        <div class="change positive"><i class='bx bx-up-arrow-alt'></i> 5.4% from last month</div>
      </div>
    </div>

    <div class="charts">
      <div class="chart">
        <h3><i class='bx bxs-bar-chart-alt-2'></i> Property Views - Last 30 Days</h3>
        <canvas id="viewsChart" 
                data-labels="{{ json_encode($viewsData['labels']) }}" 
                data-data="{{ json_encode($viewsData['data']) }}"></canvas>
      </div>
      <div class="chart">
        <h3><i class='bx bxs-line-chart'></i> Visit Conversion Rate</h3>
        <canvas id="conversionChart" 
                data-labels="{{ json_encode($conversionData['labels']) }}" 
                data-data="{{ json_encode($conversionData['data']) }}"></canvas>
      </div>
    </div>

    <div class="visits-messages">
      <div class="card">
        <h3><i class='bx bxs-calendar-event'></i> Upcoming Visits <a href="{{ route('agence.visites') }}" class="btn-outline">View Calendar</a></h3>
        @foreach($upcomingVisits as $visit)
        <div class="item">
          <div class="info">
            <img src="{{ $visit->user->avatar ?? 'https://randomuser.me/api/portraits/women/'.rand(1,100).'.jpg' }}" />
            <div class="details">
              <strong>{{ $visit->user->name ?? 'Guest User' }}</strong>
              {{-- <span>{{ $visit->property->title }}, {{ $visit->property->address }}</span> --}}
            </div>
          </div>
          <div class="actions">
            <span class="status {{ $visit->status }}">{{ ucfirst($visit->status) }}</span>
            <button class="btn-outline">Reschedule</button>
            @if($visit->status == 'pending')
              <button class="btn-confirm update-status" data-status="confirmed" data-visit-id="{{ $visit->id }}">Confirm</button>
            @else
              <button class="btn-cancel update-status" data-status="canceled" data-visit-id="{{ $visit->id }}">Cancel</button>
            @endif
          </div>
        </div>
        @endforeach
      </div>
      
      <div class="card">
        <h3><i class='bx bxs-message'></i> Recent Messages <a href="{{ route('agence.messages') }}" class="btn-outline">View All</a></h3>
        @foreach($recentMessages as $message)
        <div class="item">
          <div class="info">
            <img src="{{ $message->user->avatar ?? 'https://randomuser.me/api/portraits/men/'.rand(1,100).'.jpg' }}" />
            <div class="details">
              <strong>{{ $message->user->name ?? 'Anonymous' }}</strong>
              <span>{{ Str::limit($message->content, 50) }}</span>
            </div>
          </div>
          <div class="actions">
            <a href="{{ route('agence.messages', $message->id) }}" class="btn-reply">Reply</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
@endsection

@push('scripts')
    


<script>
$(document).ready(function() {
    // Initialisation des graphiques
    function initChart(chartId) {
        const ctx = document.getElementById(chartId);
        const labels = JSON.parse(ctx.dataset.labels);
        const data = JSON.parse(ctx.dataset.data);
        
        new Chart(ctx, {
            type: chartId === 'viewsChart' ? 'bar' : 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: chartId === 'viewsChart' ? 'Property Views' : 'Conversion Rate (%)',
                    data: data,
                    backgroundColor: chartId === 'viewsChart' ? 'rgba(54, 162, 235, 0.5)' : 'rgba(75, 192, 192, 0.5)',
                    borderColor: chartId === 'viewsChart' ? 'rgba(54, 162, 235, 1)' : 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    initChart('viewsChart');
    initChart('conversionChart');

    // Gestion des boutons de statut
    $('.update-status').click(function() {
        const button = $(this);
        const visitId = button.data('visit-id');
        const status = button.data('status');
        const url = "{{ route('agence.visits.update-status', ':id') }}".replace(':id', visitId);
        
        $.ajax({
            url: url,
            method: 'PUT',
            data: {
                _token: "{{ csrf_token() }}",
                status: status
            },
            success: function() {
                location.reload();
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON?.message || 'Something went wrong');
            }
        });
    });
});
</script>
@endpush