<!-- userEdit.blade.php -->
@extends('layout.template')
@include('layout.navbar')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-12 m-auto">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <form action="{{ route('userUpdate', ['id' => $user->id]) }}" method="POST">
                        @csrf
                        <h1>Edit User</h1>
                        <p>You can change the content of the form to update the user profile</p>

                        <label for="username" class="">Username</label>
                        <input type="text" name="username" id="username" class="form-control py-2 mb-4" placeholder="Username" value="{{ $user->username }}" required>
                        
                        <label for="email" class="">Email</label>
                        <input type="email" name="email" id="email" class="form-control py-2 mb-4" placeholder="Email" value="{{ $user->email }}" required>
                        
                        <label for="password" class="">Password</label>
                        <input type="password" name="password" id="password" class="form-control py-2 mb-4" placeholder="Password">

                        <!-- Other form fields... -->

                        <label for="role-check">Is Admin?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="userRole" value="user" {{ $user->is_admin ? '' : 'checked' }}>
                            <label class="form-check-label" for="userRole">
                                User
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="adminRole" value="admin" {{ $user->is_admin ? 'checked' : '' }}>
                            <label class="form-check-label" for="adminRole">
                                Admin
                            </label>
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
                        
                        <!-- Add a hidden input field to store the user ID -->
                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        <div class="text-center mt-3">
                            <button class="btn btn-primary">
                                Update User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
