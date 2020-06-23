<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'HDE') }}</title>

    <!-- Scripts -->
        
    <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.compatibility.js"></script>
    <script  src="/mdbjs/popper.min.js"></script>
    <script  src="/mdbjs/bootstrap.min.js"></script>
    <script  src="/mdbjs/mdb.min.js"></script>

    <link href="/mdbcss/bootstrap.min.css" rel="stylesheet">
    <link href="/mdbcss/mdb.min.css" rel="stylesheet">
    <link href="/mdbcss/style.css" rel="stylesheet">
    <link href="/mdbcss/addons-pro/timeline.min.css" rel="stylesheet">

    <script src="/mdbjs/addons-pro/timeline.min.js"> </script>

    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <script src="https://kit.fontawesome.com/e44a6095a3.js" ></script>

    <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css' rel='stylesheet' />
    <script src="js/toastr.js"></script>

    <script >
        $('.datepicker').pickadate();

        if( $('#nav_u').hasClass('text-dark')){
                    $('#nav_u').removeClass('text-dark');
                };

    </script>
   

</head>
<body>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark  scrolling-navbar">
            <div class="container-fluid">
                <a class="navbar-brand text-dark" id="nav_u" href="{{ url('/home') }}">
                    {{ config('app.name', 'Human Detection Robot') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav nav-flex-icons ml-auto text-default">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item ">
                            <a class="nav-link text-dark" href="/home">{{ __('Robot') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/evidence">{{ __('Evidence') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/report">{{ __('Report') }}</a>
                        </li>
                       
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="/userImages/{{Auth::user()->picture}}" alt="User Photo" class="img-fluid rounded-circle hoverable" width="22" height="22"> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/user/{{Auth::user()->id}}" >User Page</a>
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

      
        
            @yield('content')
      
    </div>

    
</body>
</html>
