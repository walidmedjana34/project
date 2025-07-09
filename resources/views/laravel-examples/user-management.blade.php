@extends('layouts.user_type.auth')

@section('title') User Management @endsection

@section('content')
<div>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">All Users</h5>
                        </div>
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            Add User
                        </button> 
                       <!-- MODAL D'AJOUT D'UTILISATEUR -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                    <!-- Section: User Information -->
                    <fieldset class="border p-3 rounded mb-4">
                        <legend class="float-none w-auto px-2">User Information</legend>

                        <div class="mb-3">
                            <label for="userName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="userName" name="name" placeholder="Enter full name" required>
                        </div>

                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmail" name="email" placeholder="Enter email" required>
                        </div>

                        <div class="mb-3">
                            <label for="userPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="userPassword" name="password" placeholder="Enter password" required>
                        </div>

                        <div class="mb-3">
                            <label for="userPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="userPhone" name="phone" placeholder="Enter phone" required>
                        </div>

                        <div class="mb-3">
                            <label for="userLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="userLocation" name="location" placeholder="Enter Location" required>
                        </div>
                    </fieldset>

                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-3">
                        <table id="example" class="table align-items-center mb-0" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 text-center">ID</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 text-center">name</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 text-center">email</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 text-center">Password</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 text-center">phone</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 text-center">Location</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                              
                                <tr>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->id }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">********</p> 
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->phone }}</p>
                                    </td>
                                    <td class="text-center">
                                        <p class="text-xs font-weight-bold mb-0">{{ $user->location }}</p>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn bg-gradient-info" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editUserModal"
                                        data-id="{{ $user->id }}" 
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-phone="{{ $user->phone }}"
                                        data-location="{{ $user->location }}">
                                        EDITE
                                    </button>
                                         <!-- Bouton DELETE -->
    <form method="POST" action="{{ route('user.destroy', $user->id) }}" class="d-inline delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn bg-gradient-danger delete-user-btn">DELETE</button>
    </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MODAL DE MODIFICATION -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Modifier l'utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulaire d'édition -->
                <form method="POST" id="editUserForm">
                    @csrf
                    @method('PUT') 
                    <input type="hidden" name="user_id" id="user_id">

                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Téléphone</label>
                        <input type="text" class="form-control" id="edit_phone" name="phone" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" class="form-control" id="edit_location" name="location" required>
                    </div>

                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var editButtons = document.querySelectorAll(".bg-gradient-info");
    
        editButtons.forEach(function (button) {
            button.addEventListener("click", function () {
                var userId = this.getAttribute("data-id");
    
                document.getElementById("user_id").value = userId;
                document.getElementById("edit_name").value = this.getAttribute("data-name");
                document.getElementById("edit_email").value = this.getAttribute("data-email");
                document.getElementById("edit_phone").value = this.getAttribute("data-phone");
                document.getElementById("edit_location").value = this.getAttribute("data-location");
    
                // Modifier dynamiquement l'action du formulaire
                var form = document.getElementById("editUserForm");
                form.action = "/user/" + userId;
            });
        });
    });
    </script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    var deleteForms = document.querySelectorAll(".delete-form");

    deleteForms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault(); // Empêche l'envoi immédiat

            if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.")) {
                form.submit(); // Envoie le formulaire si l'utilisateur confirme
            }
        });
    });
});
</script>

    

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

<!-- Initialize DataTable -->
<script>
    $(document).ready(function (){
        $('#example').DataTable();
    });
</script>
@endsection