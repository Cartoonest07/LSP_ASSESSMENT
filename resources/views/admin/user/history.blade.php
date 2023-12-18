@extends('layout.template')
@include('layout.navbar')

@section('content')

<div class="entries-container pt-4 mt-4">
    <h1>History Reservasi Pengguna</h1>

    @if ($userReservations->isEmpty())
        <p>Tidak ada history reservasi.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Instrumen</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Total Harga</th>
                    <th>Penalty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userReservations as $reservation)
                    <tr>
                        <td>{{ $reservation->instrument->name }}</td>
                        <td>{{ $reservation->tanggal_peminjaman }}</td>
                        <td>{{ $reservation->tanggal_dikembalikan ?? '-' }}</td>
                        <td>{{ $reservation->total_price ?? '-' }}</td>
                        <td>{{ $reservation->penalty ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>

@endsection
