@extends('layout.template')
@include('layout.navbar')

@section('content')

<div class="entries-container pt-4 mt-4">
    <div class="button justify-content-center">
        <a class="btn btn-primary" href="{{ route('categoryCreatePage') }}" role="button">Create New Category</a>
    </div>
    <div class="input-group mt-4">
        <div class="col-md-12">
            <form action="{{ route('categorySearch') }}" method="post" class="d-flex">
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
                <th>Categories</th>
                <th class="text-end">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td class="text-end">
                        <!-- Add action buttons here -->
                        <a class="btn btn-primary" href="{{ route('categoryEditPage', ['id' => $category->id]) }}">Edit</a>
                        <a class="btn btn-danger" href="{{ route('categoryDelete', ['id' => $category->id]) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Display pagination links -->
    <div class="d-flex justify-content-between align-items-center mt-2 mb-2">
        <div>
            @if ($categories->lastPage() > 1)
                <div class="pagination">
                    {{ $categories->links('pagination') }}
                </div>
            @endif
        </div>
        <div>
            Showing {{ $categories->firstItem() }} - {{ $categories->lastItem() }} of {{ $categories->total() }} results
        </div>
    </div>

</div>

@endsection
