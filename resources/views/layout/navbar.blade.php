<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-body pl-3 pr-3" data-bs-theme="dark">
    <div class="container-fluid custom-nav-container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('images/logo.png') }}" alt="Rumah Musik Logo" width="30" height="24">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                @auth
                    @if(auth()->user()->is_admin == 1)
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('dashboardPage') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('userPage') }}">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('categoryPage') }}">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('instrumentPage') }}">Instruments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reservationPage') }}">Reservation</a>
                        </li>
                    @elseif(auth()->user()->is_admin == 0)
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('homePage') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('viewReservationHistory') }}">My Reservation</a>
                        </li>
                    @endif
                @endauth
            </ul>
        </div>
        <div class="navbar-nav"> <!-- Adjust padding as needed -->
            <li class="nav-item dropdown" style>
                @auth
                @csrf
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ auth()->user()->username}}
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    @if(auth()->user()->is_admin == 1)
                        <a class="dropdown-item" href="{{ route('homePage') }}">Homepage</a>
                        <div class="dropdown-divider"></div>
                    @elseif(auth()->user()->is_admin == 0)
                        <a class="dropdown-item" href="{{ route('myProfilePage', ['id' => auth()->user()->id]) }}">Lihat Profile</a>
                        <div class="dropdown-divider"></div>
                    @endif
                    <a id="button-logout" class="dropdown-item btn btn-danger" style="border-color: #D4E9F7;" onclick="document.getElementById('logoutForm').submit();">Logout</a>
                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                        @csrf
                    </form>
                </div>
                @else
                <a class="nav-link" href="{{ route('landHandling') }}">Login</a>
                @endauth
            </li>
        </div>
    </div>
</nav>
