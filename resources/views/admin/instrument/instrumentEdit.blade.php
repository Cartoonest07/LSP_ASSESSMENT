@extends('layout.template')
@include('layout.navbar')

@section('content')

<div class="container mt-3 pt-4">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-12 m-auto">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <form action="{{ route('instrumentUpdate', ['id' => $instrument->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <h1>Edit Instrument</h1>
                        <p>You can change the content of the form to update the instrument details</p>
                        <label for="code" class="">Code</label>
                        <input type="text" name="code" id="code" class="form-control py-2 mb-4" placeholder="Instrument Code" value="{{ $instrument->code }}" required>
                        
                        <label for="name" class="">Name</label>
                        <input type="text" name="name" id="name" class="form-control py-2 mb-4" placeholder="Instrument Name" value="{{ $instrument->name }}" required>
                        
                        <label for="price" class="">Price</label>
                        <input type="number" name="price" id="price" class="form-control py-2 mb-3" placeholder="Instrument Price" value="{{ $instrument->price }}" required>

                        <div class="py-2 mb-3">
                            <label for="formFile" class="form-label">Images</label>
                            <input class="form-control" type="file" id="formFile" name="images">
                        </div>
                        
                        <div>
                            <label for="name" class="block mb-2 text-sm font-semibold">Categories</label>
                            <ul
                                class="w-48 text-sm font-medium text-gray-900 bg-white dark:text-white">
                                @foreach ($categories as $category)
                                    <li class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600">
                                        <div class="flex items-center">
                                            <input id="vue-checkbox" type="checkbox"
                                                {{ in_array($category->id, $instrument->categories->pluck('id')->toArray()) ? 'checked' : '' }}
                                                value="{{ $category->id }}"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                                name="category[]">
                                            <label for="vue-checkbox"
                                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->name }}</label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>

                        <div class="py-2 mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                            <input type="text" name="description" id="description" class="form-control py-2 mb-3" placeholder="Instrument Description" value="{{ $instrument->description }}" required>
                        </div>

                        <div class="text-center py-2 mb-3">
                            <button class="btn btn-primary">
                                Update Instrument
                            </button>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
