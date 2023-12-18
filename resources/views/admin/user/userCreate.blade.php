@extends('layout.template')
@include('layout.navbar')

@section('content')

<div class="container mt-5 pt-5">
    <div class="row">
        <div class="col-12 col-sm-8 col-md-12 m-auto">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <form action="{{ route('admin.user.create') }}" method="post" onsubmit="return validateForm()">
                    @csrf
                        <h1>Create New User</h1>
                        <p>Please fill out the form below to create a new user!</p>
                        
                        <label for="username" class="">Username</label>
                        <input type="text" name="username" id="username" class="form-control py-2 mb-4" placeholder="Username" required>
                        
                        <label for="email" class="">Email</label>
                        <input type="email" name="email" id="email" class="form-control py-2 mb-4" placeholder="Email" required>
                        
                        <label for="password" class="">Password</label>
                        <input type="password" name="password" id="password" class="form-control py-2 mb-4" placeholder="Password" required>

                        <label for="confirmPassword" class="">Confirm Password</label>
                        <input type="password" name="confPassword" id="confPassword" class="form-control py-2 mb-4" placeholder="Confirm Password" minlength="8" required>

                        <label for="role-check">Select Role:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="userRole" value="user" checked>
                            <label class="form-check-label" for="userRole">
                                User
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="adminRole" value="admin">
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

                        <div class="text-center mt-3">
                            <button class="btn btn-primary">
                                Create User
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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

<script>
    function validateForm() {
        // Get all radio buttons with the name "role"
        var radioButtons = document.querySelectorAll('input[name="role"]');

        // Check if Password == confPassword
        var password = document.getElementById("password").value;
        var confPassword = document.getElementById("confPassword").value;

        if (password !== confPassword) {
            alert("Passwords do not match");
            return false;
        }

        return true;
        
        // Check if at least one radio button is checked
        var atLeastOneChecked = Array.prototype.slice.call(radioButtons).some(function(radioButton) {
            return radioButton.checked;
        });

        // Display an alert if no radio button is checked
        if (!atLeastOneChecked) {
            alert("Please select a role.");
            return false; // Prevent form submission
        }

        // Continue with form submission if at least one radio button is checked
        return true;

    }
</script>

@endsection
