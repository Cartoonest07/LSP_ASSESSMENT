@extends('layout.template')
@include('layout.navbar')

@section('content')

<div class="page-container">

    <div class="home-title">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Welcome to Rumah Musik!</h1>
                <p class="lead">Find the perfect rental for a musical day!</p>
            </div>
        </div>
    </div>

    <div class="input-group mt-2">
        <div class="col-md-12">
            <form action="{{ route('homepageSearch') }}" method="post" class="d-flex">
            @csrf
                <input type="text" name="search" class="form-control form-search" placeholder="Search instrument" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <button class="btn btn-primary py-2" type="submit" id="search-button">Search</button>
            </form>
        </div>
    </div>

    @if(session('reservation_success'))
        <div class="alert alert-success">
            {{ session('reservation_success') }}
        </div>
    @elseif(session('reservation_error'))
        <div class="alert alert-danger">
            {{ session('reservation_error') }}
        </div>
    @elseif(session('rent_max'))
        <div class="alert alert-danger">
            {{ session('rent_max') }}
        </div>
    @endif

    <div class="container pt-2">
        <div class="row">
            @foreach ($instruments as $instrument)
                <div class="col-md-3 mb-3">
                    <form id="newReservation_{{ $instrument->id }}" action="{{ route('createReservation', ['instrumentId' => $instrument->id]) }}" method="post">
                        @csrf

                        <div class="card card-container" style="width: 100%; height: 100%;">
                            <img src="{{ asset('images/' . $instrument->image) }}" class="card-img-top custom-card-img" alt="{{ $instrument->name }}">
                            <div class="card-body d-flex flex-column">
                                <h4 class="card-title">{{ $instrument->name }}</h4>
                                <p class="card-text">Rp{{ number_format($instrument->price, 0, ',', '.') }}</p>
                                <p class="card-text">{{ $instrument->description }}</p>
                                <p class="card-text">
                                    @foreach ($instrument->categories as $item)
                                        <span class="btn btn-outline-secondary btn-sm mb-1">{{ $item->name }}</span>
                                    @endforeach
                                </p>
                                @auth
                                    @if(auth()->user()->is_admin == 0)
                                    <div class="text-center mt-auto">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reservationModal_{{ $instrument->id }}">Order</a>
                                    </div>
                                    @elseif (auth()->user()->is_admin == 1)
                                    <div class="text-center mt-auto">
                                        <a href="#" class="btn btn-primary disabled" data-bs-toggle="modal" data-bs-target="#reservationModal_{{ $instrument->id }}">Order</a>
                                    </div>
                                @endif
                                @endauth
                                <!-- Modal -->
                                <div class="reservation-modal">

                                <div class="modal fade" id="reservationModal_{{ $instrument->id }}" tabindex="-1" aria-labelledby="reservationModal_{{ $instrument->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Reservation Details</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label for="datepicker">Select Date:</label>
                                            <input class="form-control" type="date" name="datepicker" id="datepicker" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a href="#" class="btn btn-primary" onclick="document.getElementById('newReservation_{{ $instrument->id }}').submit();">Order Now</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            @endforeach

            @if ($search && $instruments->isEmpty())
                <div class="col-md-12 mt-3">
                    <p>No instruments found for '{{ $search }}'</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
