@extends('layout.template')
@include('layout.navbar')

@section('content')

<div class="entries-container pt-4 mt-4">
    <div class="button justify-content-center">
        <a class="btn btn-primary" href="{{ route('instrumentCreatePage') }}" role="button">Create New Instrument</a>
    </div>
    <div class="input-group mt-4">
        <div class="col-md-12">
            <form action="{{ route('instrumentSearch') }}" method="post" class="d-flex">
            @csrf
                <input type="text" name="search" class="form-control form-search" placeholder="Search categories name" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <button class="btn btn-primary py-2" type="submit" id="search-button">Search</button>
            </form>
        </div>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif

    <!-- Table -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Category</th>
                <th>Description</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($instruments as $instrument)
                <tr>
                    <td>{{ $instrument->code }}</td>
                    <td>{{ $instrument->name }}</td>
                    <td>Rp{{ number_format($instrument->price, 0, ',', '.') }}</td>
                    <td><img class="custom-img-entries" src="{{ asset('images/' . $instrument->image) }}" alt="{{ $instrument->name }}"></td>
                    <td>
                        <div class="flex justify-center flex-wrap w-[100px]">
                            @foreach ($instrument->categories as $item)
                                <span class="btn btn-outline-secondary btn-sm mb-1">{{ $item->name }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td>{{ $instrument->description }}</td>
                    <td class="text-end">
                        <!-- Add action buttons here -->
                        <a class="btn btn-primary" href="{{ route('instrumentEditPage', $instrument->id) }}">Edit</a>
                        <a class="btn btn-danger" href="{{ route('instrumentDelete', $instrument->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        
        </tbody>
    </table>
</div>

@endsection
