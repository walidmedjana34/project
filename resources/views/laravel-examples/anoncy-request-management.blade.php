@extends('layouts.user_type.auth')

@section('title') Property Requests @endsection
@section('content')



<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">Demande d'annonce</h5>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Titre</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Wilaya</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prix</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Statut</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($properties as $property)
                            <tr>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{ $property->id }}</p>
                                </td>
                                <td>
                                    <div>
                                        <p class="text-xs font-weight-bold mb-0">{{ $property->title }}</p>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $property->type }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $property->wilaya }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ number_format($property->price) }} DA</p>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-gradient-{{ $property->admin_status == 'approved' ? 'success' : ($property->admin_status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ $property->admin_status == 'approved' ? 'Approuvé' : ($property->admin_status == 'rejected' ? 'Rejeté' : 'En attente') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($property->admin_status != 'approved')
                                    <form action="{{ route('properties.approve', $property->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn bg-gradient-success btn-sm">Accepter</button>
                                    </form>
                                    @endif
                                    @if($property->admin_status != 'rejected')
                                    <form action="{{ route('properties.reject', $property->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn bg-gradient-danger btn-sm">Réfuser</button>
                                    </form>
                                    @endif
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

@endsection