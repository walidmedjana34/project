@extends('layouts.user_type.auth')

@section('content')

    <div class="mf-5 col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-muted text-sm text-uppercase fw-bold mb-1">TOTAL AGENCY</p>
                            <h5 class="fw-bold mb-0 text-dark">{{$agencies->count()}}</h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-5 text-center">
        <h5 class="mb-0 fw-bold">AGENCY MANAGEMENT</h5>
    </div>

    <!-- Button trigger modal -->

    <!-- Modal -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Add New Agency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding a new agency -->
                    <form id="addAgencyForm" action="{{ route('agencies.store') }}" method="POST"  enctype="multipart/form-data">
                        @csrf <!-- CSRF token for security -->
                        <!-- Section: General Information -->
                        <fieldset class="border p-3 rounded mb-4">
                            <legend class="float-none w-auto px-2">GENERAL INFORMATION</legend>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="agencyName" class="form-label">AGENCY NAME</label>
                                    <input type="text" class="form-control" id="agencyName" name="name" placeholder="Agency Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phoneNumber" name="phone_number" placeholder="+213" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Full Address" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Agency Email" required>
                            </div>
                           <!-- Agency Type -->
<div class="mb-3">
    <label for="agency_type" class="form-label">Type de services</label>
    <select class="form-control" id="agency_type" name="agency_type" required>
        <option value="">-- Sélectionnez un type de service --</option>
        <option value="Vente">Vente</option>
        <option value="Location">Location</option>
        <option value="Consultation">Consultation</option>
        <option value="Multi-services">Multi-services</option>
    </select>
</div>
                        </fieldset>
    
                        <!-- Section: Security -->
                        <fieldset class="border p-3 rounded mb-4">
                            <legend class="float-none w-auto px-2">Security</legend>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required>
                                </div>
                            </div>
                        </fieldset>
                        <!-- Wilaya Selection -->
<div class="mb-3">
    <label for="wilaya" class="form-label">Wilaya</label>
    <select class="form-control" id="wilaya" name="wilaya" required>
        <option value="">Select a wilaya</option>
        @foreach(config('communes') as $wilaya => $communes)
            <option value="{{ $wilaya }}">{{ $wilaya }}</option>
        @endforeach
    </select>
</div>

<!-- Commune Selection -->
<div class="mb-3">
    <label for="commune" class="form-label">Commune</label>
    <select class="form-control" id="commune" name="commune" required>
        <option value="">Select a commune</option>
    </select>
</div>

    
                        <!-- Section: Administrative Information -->
                        <fieldset class="border p-3 rounded mb-4">
                            <legend class="float-none w-auto px-2">Administrative Information</legend>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="nomResponsable" class="form-label">Manager Name</label>
                                    <input type="text" class="form-control" id="nomResponsable" name="manager_name" placeholder="Full Name" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="identifiantFiscal" class="form-label">Tax Identifier (NIF / SIRET)</label>
                                    <input type="text" class="form-control" id="identifiantFiscal" name="tax_identifier" placeholder="Ex: 123456789" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="registreCommerce" class="form-label">Trade Register</label>
                                    <input type="text" class="form-control" id="registreCommerce" name="trade_register" placeholder="Registration Number" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="siteWeb" class="form-label">WEBSITE (optional)</label>
                                    <input type="url" class="form-control" id="siteWeb" name="website" placeholder="https://www.youragency.com">
                                </div>
                            </div>
                        </fieldset>
    
                        <!-- Logo -->
  <div class="form-field">
      <label for="logo">Logo de l'agence :</label>
      <input type="file" id="logo" name="logo" accept="image/*">
  </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="addAgencyForm" class="btn bg-gradient-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3">
                        <table id="example" class="table align-items-center mb-0">
                            <div class="center-button d-flex justify-content-center">
                                <button type="button" class="btn bg-gradient-success mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Add Agency
                                </button>
                            </div>
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        NAME
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Address
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($agencies as $agency)
                                <tr>
                                    <td class="ps-4">
                                        <p class="text-xs font-weight-bold mb-0">{{ $agency->id }}</p>
                                    </td>
                                    <td>
                                        <div>
                                            <p class="text-xs font-weight-bold mb-0">{{ $agency->name }}</p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $agency->email }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $agency->address }}</p>
                                    </td>
                                    <td class="text-center">
                                       <!-- Edit Button -->
<button type="button" class="btn bg-gradient-info btn-edit"
        data-id="{{ $agency->id }}"
        data-bs-toggle="modal"
        data-bs-target="#editAgencyModal{{ $agency->id }}">
    EDIT
</button>
                                        <!-- Delete Button -->
                                        <button type="button" class="btn bg-gradient-danger btn-delete" data-id="{{ $agency->id }}">
                                            DELETE
                                        </button>
                                    </td>

                                    <!-- Edit Agency Modal   value="Existing Name"-->
                                    <!-- Edit Agency Modal -->
                                    <div class="modal fade" id="editAgencyModal{{ $agency->id }}" tabindex="-1" aria-labelledby="editAgencyModalLabel{{ $agency->id }}" aria-hidden="true">

                                        <div class="modal-dialog modal-dialog-centered">
                                            @if ($errors->any())
                                              <div class="alert alert-danger">
                                                  <ul>
                                                      @foreach ($errors->all() as $error)
                                                          <li>{{ $error }}</li>
                                                      @endforeach
                                                  </ul>
                                              </div>
                                            @endif
                                            <div class="modal-content">
                                                <!-- Header -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editAgencyModalLabel">Edit Agency</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                    
                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <!-- Edit Form -->
                                                  <form id="editAgencyForm{{ $agency->id }}" action="{{ route('agencies.update', $agency->id) }}" method="POST" enctype="multipart/form-data">


                                                        @csrf
                                                        @method('PUT') <!-- Use PUT method for updates -->
                                                        <!-- Agency Name -->
                                                        <div class="mb-3">
                                                            <label for="editAgencyName" class="form-label">Agency Name</label>
                                                            <input type="text" class="form-control" id="editAgencyName" name="name" value="{{old('name',$agency->name)}}" required>

                                                        </div>
                                    
                                                        <!-- Phone Number -->
                                                        <div class="mb-3">
                                                            <label for="editPhoneNumber" class="form-label">Phone Number</label>
                                                            <input type="tel" class="form-control" id="editPhoneNumber" name="phone_number" value="{{ old('phone_number',$agency->phone_number)}}" required>
                                                        </div>
                                    
                                                        <!-- Address -->
                                                        <div class="mb-3">
                                                            <label for="editAddress" class="form-label">Address</label>
                                                            <input type="text" class="form-control" id="editAddress" name="address"  value="{{old('address',$agency->address)}}" required>
                                                        </div>
                                    
                                                        <!-- Email -->
                                                        <div class="mb-3">
                                                            <label for="editEmail" class="form-label">Email</label>
                                                            <input type="email" class="form-control" id="editEmail" name="email" value="{{old('email',$agency->email)}}" required>
                                                        </div>
                                    
                                                         <!-- Agency Type -->
<div class="mb-3">
    <label for="agency_type" class="form-label">Type de services</label>
    <select class="form-control" id="agency_type" name="agency_type" required>
        <option value="">-- Sélectionnez un type de service --</option>
        <option value="Vente">Vente</option>
        <option value="Location">Location</option>
        <option value="Consultation">Consultation</option>
        <option value="Multi-services">Multi-services</option>
    </select>
</div>
                                    
                                                        <!-- Manager Name -->
                                                        <div class="mb-3">
                                                            <label for="editNomResponsable" class="form-label">Manager Name</label>
                                                            <input type="text" class="form-control" id="editNomResponsable" name="manager_name"  value="{{old('manager_name',$agency->manager_name)}}"  required>
                                                        </div>
                                    
                                                        <!-- Tax Identifier -->
                                                        <div class="mb-3">
                                                            <label for="editIdentifiantFiscal" class="form-label">Tax Identifier (NIF / SIRET)</label>
                                                            <input type="text" class="form-control" id="editIdentifiantFiscal" name="tax_identifier" value="{{old('tax_identifier',$agency->tax_identifier)}}" required>
                                                        </div>
                                    
                                                        <!-- Trade Register -->
                                                        <div class="mb-3">
                                                            <label for="editRegistreCommerce" class="form-label">Trade Register</label>
                                                            <input type="text" class="form-control" id="editRegistreCommerce" name="trade_register"  value="{{old('trade_register', $agency->trade_register)}}" required>
                                                        </div>
                                    
                                                        <!-- Website -->
                                                        <div class="mb-3">
                                                            <label for="editSiteWeb" class="form-label">Website (optional)</label>
                                                            <input type="url" class="form-control" id="editSiteWeb" name="website" value="{{$agency->website}}">
                                                        </div>
                                    
                                                        <!-- Agency Logo -->
                                                        <div class="mb-3">
                                                            <label for="editLogo" class="form-label">Agency Logo</label>
                                                            <input type="file" class="form-control" id="editLogo" name="logo"  accept="image/*">
                                                        </div>
                                                    </form>
                                                </div>
                                    
                                                <!-- Modal Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" form="editAgencyForm{{ $agency->id }}" class="btn bg-gradient-primary">Update</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <!-- Initialize DataTable -->
    <script>
        $(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function () {
            // When the Delete button is clicked
            $('.btn-delete').on('click', function () {
                // Get the agency ID from the data attribute
                var agencyId = $(this).data('id');
    
                // Confirm the deletion
                if (confirm('Are you sure you want to delete this agency?')) {
                    // Send a DELETE request to the server
                    $.ajax({
                        url: '/agencies/' + agencyId, // Route to delete the agency
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}', // CSRF token for security
                        },
                        success: function (response) {
                            alert('Agency deleted successfully!');
                            location.reload(); // Reload the page to reflect changes
                        },
                        error: function (xhr) {
                            alert('An error occurred while deleting the agency.');
                        }
                    });
                }
            });
        });
    
    const allCommunes = @json(config('communes'));

    document.getElementById('wilaya').addEventListener('change', function () {
        const selectedWilaya = this.value;
        const communeSelect = document.getElementById('commune');

        // Clear existing options
        communeSelect.innerHTML = '<option value="">Select a commune</option>';

        if (allCommunes[selectedWilaya]) {
            allCommunes[selectedWilaya].forEach(function (commune) {
                const option = document.createElement('option');
                option.value = commune;
                option.textContent = commune;
                communeSelect.appendChild(option);
            });
        }
    });

    </script>

@endsection