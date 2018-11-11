<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

<script type="text/javascript" src="{{ asset('js/gmap.js') }}"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAYf-Ztn_pL3wpxvpIW9bEZRTEJXbsc830&callback=initMap">
</script>
        <!-- Styles -->
        <style>
            .list-item{
                width: 220px;
                padding-top: 2px;
                height: 200px;
                float: left;
            }
            #map {
                height: 400px;
                width: 100%;
                background-color: grey;
            }
        </style>
    </head>
    <body>
        <div>
            <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/gmap') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4 container">
            <div class="row justify-content-center">
            <div class="col-md-8">

            @foreach($addresses as $address)
            
            <div class="card mb-2 mr-2 list-item">
                <div class="card-header">
                    Status: {{ $address->status}}</div>

                <div class="card-body">
                   {{ $address->address}}
                  
                </div>
            </div>
            
            @endforeach
           
            </div>
                <input type="hidden" id="zoom_data" value="8">
                <input type="hidden" id="clocations" value="{{ $locations }}">

                <div class="col-md-4" id="gmap">
                    <div id="map">
                    </div>
                </div>
                
                
            </div>
        <div class="col"> 
            <center>{{ $addresses->links() }}</center>
            </div>
    </main>
    </div>
    </body>
</html>
