@extends('layouts.user_type.auth')

@section('title') Agency requests @endsection
@section('content')

<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Demandes acceptées</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $counts['approved'] ?? 0 }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-check-bold text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Demandes rejetées</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $counts['rejected'] ?? 0 }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-fat-remove text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Demandes En attentes</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $counts['pending'] ?? 0 }}
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                            <i class="ni ni-watch-time text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success mt-4 mx-4">
    {{ session('success') }}
</div>
@endif

<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">Demande d'agence</h5>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Agence</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Wilaya</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de création</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Statut</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
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
                                    <p class="text-xs font-weight-bold mb-0">{{ $agency->wilaya }}</p>
                                </td>
                                <td class="text-center">
                                    <span class="text-secondary text-xs font-weight-bold">
                                        @if($agency->created_at)
                                            {{ $agency->created_at->format('d/m/Y') }}
                                        @else
                                            Date non disponible
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-gradient-{{ $agency->status == 'approved' ? 'success' : ($agency->status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ $agency->status == 'approved' ? 'Approuvé' : ($agency->status == 'rejected' ? 'Rejeté' : 'En attente') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($agency->status != 'approved')
                                    <form action="{{ route('agencies.approve', $agency->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn bg-gradient-success btn-sm">Accepter</button>
                                    </form>
                                    @endif
                                    @if($agency->status != 'rejected')
                                    <form action="{{ route('agencies.reject', $agency->id) }}" method="POST" class="d-inline">
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