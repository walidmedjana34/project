@extends('layouts.agence.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/Dashboard-agence.css') }}">
@endpush 
@section('title') Vacances @endsection
@section("content")
    <header>
      <h1>Vacance Request Management</h1>
      <p>Manage and monitor all your vacance requests in one place.</p>
    </header>
    <div class="search-container">
      <div class="search-bar">
        <input type="text" placeholder="Search by property name, address..." />
      </div>
      <div class="filters">
        <select name="status">
          <option value="">All Statuses</option>
          <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
          <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
      </div>
    </div>

    <div class="property-container">
       <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th> 
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request Date</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($vacances as $vacance)
              <tr>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $vacance->titre }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $vacance->type }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $vacance->wilaya }}, {{ $vacance->commune }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ number_format($vacance->price) }} DZD</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                    {{ $vacance->admin_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                             ($vacance->admin_status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                          {{ ucfirst($vacance->admin_status) }}
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">{{ $vacance->created_at->format('Y-m-d') }}</td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">

                          <form action="{{ route('vacance.approve', $vacance->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="button">
                              Approve
                              </button>
                          </form>
                          <form action="{{ route('vacance.reject', $vacance->id) }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <button type="submit" class="button red">
                                  Reject
                              </button>
                          </form>
                          
                         
                      </div>
                  </td>
              </tr>
              @endforeach
          </tbody>
        </table>
    </div>

    <div class="pagination-container">
      <div class="pagination-info">Showing {{ $vacances->firstItem() }} to {{ $vacances->lastItem() }} of {{ $vacances->total() }} requests</div>
      
      <ul class="pagination">
          @if($vacances->onFirstPage())
              <li class="disabled"><span><</span></li>
          @else
              <li><a href="{{ $vacances->previousPageUrl() }}"><</a></li>
          @endif

          @foreach(range(1, $vacances->lastPage()) as $i)
              <li class="{{ $vacances->currentPage() == $i ? 'active' : '' }}">
                  <a href="{{ $vacances->url($i) }}">{{ $i }}</a>
              </li>
          @endforeach

          @if($vacances->hasMorePages())
              <li><a href="{{ $vacances->nextPageUrl() }}">></a></li>
          @else
              <li class="disabled"><span>></span></li>
          @endif
      </ul>
  </div>
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const statusFilter = document.querySelector('select[name="status"]');
    
    if (statusFilter) {
      statusFilter.addEventListener('change', function() {
        applyFilters();
      });
    }
    
    function applyFilters() {
      const status = document.querySelector('select[name="status"]').value;
      
      let queryParams = [];
      if (status) queryParams.push(`status=${status}`);
      
      window.location.href = window.location.pathname + (queryParams.length ? '?' + queryParams.join('&') : '');
    }
    
    const urlParams = new URLSearchParams(window.location.search);
    const statusParam = urlParams.get('status');
    if (statusParam && statusFilter) {
      statusFilter.value = statusParam;
    }
  });
</script>
@endpush