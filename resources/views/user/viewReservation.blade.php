@extends('layout.template')
@include('layout.navbar')

@section('content')
<div class="page-container">
    <div class="home-title">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="mt-5">Your Reservation History</h1>
                <p class="lead">Thank you for using our service!</p>
            </div>
        </div>
    </div>

    <!-- Table -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Instrument</th>
                <th>Rented at</th>
                <th>Returned at</th>
                <th>Price</th>
                <th>Penalty</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <td>{{ $reservation->instrument->name }}</td>
                <td>{{ $reservation->tanggal_peminjaman }}</td>
                <td>{{ $reservation->tanggal_dikembalikan ?? '-' }}</td>
                <td>Rp{{ $reservation->total_price }}</td>
                <td>{{ $reservation->penalty ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
