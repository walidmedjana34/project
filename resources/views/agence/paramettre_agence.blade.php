@extends('layouts.agence.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/accueil.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/agences.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/annonces.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/vacances.css') }}">
@endpush
@section('title') parametre  @endsection
@section("content")
<div class="card">
  <h2>Profile Information</h2>
  <div class="profile-photo">
      @if($agency->logo)
          <img src="data:image/png;base64,{{ $agency->logo }}" alt="Profile Photo">
      @else
          <img src="https://via.placeholder.com/60" alt="Profile Photo">
      @endif
      <a href="#">Change Photo</a>
  </div>
  <div class="row">
      <div class="field">
          <label>Manager Name</label>
          <input type="text" value="{{ $agency->manager_name }}" readonly>
      </div>
      <div class="field">
          <label>Email Address</label>
          <input type="email" value="{{ $agency->email }}" readonly>
      </div>
      <div class="field">
          <label>Phone Number</label>
          <input type="text" value="{{ $agency->phone_number }}" readonly>
      </div>
  </div>
</div>
  
<div class="card">
  <h2>Password Settings</h2>
  
  @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
  
  @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
  @endif
  
  @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <form action="{{ route('passwordupdate') }}" method="POST">
      @csrf
      <div class="row">
          <div class="field">
              <label>Current Password</label>
              <input type="password" name="current_password" required>
              @error('current_password')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          <div class="field">
              <label>New Password</label>
              <input type="password" name="new_password" required>
              @error('new_password')
                  <span class="text-danger">{{ $message }}</span>
              @enderror
          </div>
          <div class="field">
              <label>Confirm New Password</label>
              <input type="password" name="new_password_confirmation" required>
          </div>
      </div>
      <button type="submit" class="button">Update Password</button>
  </form>
</div>
  
    <div class="card">
      <h2>Agency Information</h2>
      <div class="agency-logo">
          @if($agency->logo)
              <img src="data:image/png;base64,{{ $agency->logo }}" alt="Agency Logo" width="100">
          @else
              <img src="https://via.placeholder.com/100?text=Logo" alt="Agency Logo">
          @endif
          <a href="#">Upload Logo</a>
      </div>
      <div class="row">
          <div class="field">
              <label>Agency Name</label>
              <input type="text" value="{{ $agency->name }}" readonly>
          </div>
          <div class="field">
              <label>Tax Identifier</label>
              <input type="text" value="{{ $agency->tax_identifier }}" readonly>
          </div>
          <div class="field">
              <label>Trade Register</label>
              <input type="text" value="{{ $agency->trade_register }}" readonly>
          </div>
          <div class="field">
              <label>Agency Type</label>
              <input type="text" value="{{ $agency->agency_type }}" readonly>
          </div>
          <div class="field">
              <label>Business Phone</label>
              <input type="text" value="{{ $agency->phone_number }}" readonly>
          </div>
          <div class="field" style="flex: 1 1 100%;">
              <label>Business Address</label>
              <input type="text" value="{{ $agency->address }}" readonly>
          </div>
          <div class="field">
              <label>Wilaya</label>
              <input type="text" value="{{ $agency->wilaya }}" readonly>
          </div>
          <div class="field">
              <label>Commune</label>
              <input type="text" value="{{ $agency->commune }}" readonly>
          </div>
          <div class="field" style="flex: 1 1 100%;">
              <label>Website</label>
              <input type="text" value="{{ $agency->website ?? 'N/A' }}" readonly>
          </div>
      </div>
  </div>
  

@endsection