@extends('layouts.user_type.auth')

@section('title') Vacation Requests @endsection
@section('content')



<div class="row mt-4">
    <div class="col-12">
        <div class="card mb-4 mx-4">
            <div class="card-header pb-0">
                <div class="d-flex flex-row justify-content-between">
                    <div>
                        <h5 class="mb-0">Vacation Rental Requests</h5>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Title</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Location</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price/Night</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vacances as $vacance)
                            <tr>
                                <td class="ps-4">
                                    <p class="text-xs font-weight-bold mb-0">{{ $vacance->id }}</p>
                                </td>
                                <td>
                                    <div>
                                        <p class="text-xs font-weight-bold mb-0">{{ $vacance->titre }}</p>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $vacance->type }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ $vacance->wilaya }}</p>
                                </td>
                                <td class="text-center">
                                    <p class="text-xs font-weight-bold mb-0">{{ number_format($vacance->prix_nuit) }} DA</p>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-gradient-{{ $vacance->admin_status == 'approved' ? 'success' : ($vacance->admin_status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ $vacance->admin_status == 'approved' ? 'Approved' : ($vacance->admin_status == 'rejected' ? 'Rejected' : 'Pending') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($vacance->admin_status != 'approved')
                                    <form action="{{ route('vacance.approve', $vacance->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn bg-gradient-success btn-sm">Approve</button>
                                    </form>
                                    @endif
                                    @if($vacance->admin_status != 'rejected')
                                    <form action="{{ route('vacance.reject', $vacance->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn bg-gradient-danger btn-sm">Reject</button>
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