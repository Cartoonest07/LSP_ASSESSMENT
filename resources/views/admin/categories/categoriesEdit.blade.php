@extends('layout.template')
@include('layout.navbar')

@section('content')

<div class="container mt-3 pt-4">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-12 m-auto">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <form action="{{ route('categoryUpdate', ['id' => $category->id]) }}" method="post">
                        @csrf
                        <h1>Edit Category</h1>
                        <p>Please fill out the form below to update the Category</p>
                        <label for="category" class="">Category</label>
                        <input type="text" name="category" id="category" class="form-control py-2 mb-4" placeholder="Category Name" required value="{{ $category->name }}">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="text-center py-2 mb-3">
                            <button class="btn btn-primary">
                                Update Category
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
