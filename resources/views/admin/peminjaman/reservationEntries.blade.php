@extends('layout.template')
@include('layout.navbar')

@section('content')

<div class="entries-container pt-4 mt-4 text-center">
    <h1>Rental Submission</h1>
    <div class="input-group mt-4">
        <div class="col-md-12">
            <form action="{{ route('searchReservations') }}" method="post" class="d-flex">
                @csrf
                <input type="text" name="search" class="form-control form-search" placeholder="Search username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <button class="btn btn-primary py-2" type="submit" id="search-button">Search</button>
            </form>
        </div>
    </div>

    <!-- Table -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Username</th>
                <th>Instrument</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Dikembalikan</th>
                <th>Total Price</th>
                <th>Penalty</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->users->username }}</td>
                    <td>{{ $reservation->instrument->name }}</td>
                    <td>{{ $reservation->tanggal_peminjaman }}</td>
                    <td>{{ $reservation->tanggal_dikembalikan ?? '-' }}</td>
                    <td>{{ $reservation->total_price ?? '-' }}</td>
                    <td>
                        @if ($reservation->penalty)
                            {{ $reservation->penalty }}
                        @else
                            -
                        @endif
                    </td>
                    <td class="text-end">
                        @if (is_null($reservation->tanggal_dikembalikan))
                            <form action="{{ route('admin.returnInstrument', $reservation->id) }}" method="post">
                                @csrf
                                <button class="btn btn-primary">Returned</button>
                            </form>
                        @endif
                        <form action="{{ route('deleteReservation', $reservation->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
