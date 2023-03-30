<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" crossorigin="anonymous">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Taxi_Bokko
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('clients.create') }}">Compte Passager</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('chauffeurs.create') }}">Compte Chauffeur</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('mon_compte', [Auth::user()->id]) }}">
                                        Mon Compte
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                @auth
                <div class="d-flex flex-column flex-shrink-0 p-3 bg-light col-md-3 col-lg-2 d-md-block sidebar collapse" style="width: 200px;">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
            <span class="fs-4">Sidebar</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                @if (Auth::check() && Auth::user()->type == 'client')
                <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                Home
                </a>
            </li>
            <li>
                <a href="{{route('client.reservations')}}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                Mes Reservations
                </a>
            </li>
            <li>
                <a href="{{route('reservations.create')}}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                Nouvelle reservation
                </a>
            </li>
            @endif
                @if (Auth::check() && Auth::user()->type == 'chauffeur')
            <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                Home
                </a>
            </li>
            <li>
                <a href="{{route('chauffeur.reservations')}}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                Mes Reservations
                </a>
            </li>
                @endif
                @if (Auth::check() && Auth::user()->type == 'admin')
            <li class="nav-item">
                <a href="#" class="nav-link active" aria-current="page">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                Home
                </a>
            </li>
            <li>
                <a href="{{route('reservations.index')}}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"/></svg>
                Reservations
                </a>
            </li>
            <li>
                <a href="{{route('clients.index')}}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"/></svg>
                Clients
                </a>
            </li>
            <li>
                <a href="{{route('chauffeurs.index')}}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                Chauffeurs
                </a>
            </li>
            <li>
                <a href="{{route('vehicules.index')}}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                Vehicules
                </a>
            </li>
            <li>
                <a href="{{route('paiements.index')}}" class="nav-link link-dark">
                <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                Transactions
                </a>
            </li>
                @endif
            </ul>
            <hr>
        </div>
        @endauth
            
            <main class="py-4 col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
                @yield('scripts')
            </main>
        </div>
      </div>
    </div>
</body>
</html>
