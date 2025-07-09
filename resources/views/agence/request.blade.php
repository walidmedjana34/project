@extends('layouts.agence.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/Dashboard-agence.css') }}">
@endpush 
@section('title') properties  @endsection
@section("content")
    <header>
      <h1>Request managment</h1>
      <p>Manage and monitor all your request in one place.</p>
    </header>
    <div class="search-container">
      <div class="search-bar">
        <input type="text" placeholder="Search by property name, address..." />
      </div>
      <div class="filters">
        
        <select>
          <option>Price Range</option>
        </select>
        <select name="status">
          <option value="">All Statuses</option>
          <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
          <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
          <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wilaya</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"> Statut</th> 
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Listed Date</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($properties as $property)
              <tr>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $property->title }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $property->type }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $property->wilaya }}, {{ $property->commune }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ number_format($property->price) }} DZD</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                    {{ $property->admin_status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                             ($property->admin_status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                          {{ ucfirst($property->admin_status) }}
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">{{ $property->created_at }}</td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                          <form action="{{ route('properties.approve', $property->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="button">
                              Approve
                              </button>
                              
                          </form>
                          <form action="{{ route('properties.reject', $property->id) }}" method="POST">
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
      <div class="pagination-info">Showing 1 to 6 of 42 properties</div>
      
      <ul class="pagination">
          <li class="disabled"><a href="#"><</a></li>
          <li class="active"><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">...</a></li>
          <li><a href="#">7</a></li>
          <li><a href="#">></a></li>
      </ul>
  </div>
@endsection
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Get the status filter select element
    const statusFilter = document.querySelector('select[name="status"]');
    
    // Add change event listener to the status filter
    if (statusFilter) {
      statusFilter.addEventListener('change', function() {
        applyFilters();
      });
    }
    
    function applyFilters() {
      // Get current filter value
      const status = document.querySelector('select[name="status"]').value;
      
      // Build query string
      let queryParams = [];
      if (status) queryParams.push(`status=${status}`);
      
      // Reload page with new query parameters
      window.location.href = window.location.pathname + (queryParams.length ? '?' + queryParams.join('&') : '');
    }
    
    // If the page was loaded with a status filter, ensure the select reflects this
    const urlParams = new URLSearchParams(window.location.search);
    const statusParam = urlParams.get('status');
    if (statusParam && statusFilter) {
      statusFilter.value = statusParam;
    }
  });
</script>
@endpush