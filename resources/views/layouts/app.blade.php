<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
</head>
<body>

    <style type="text/css">

         td{
            color: brown;
         }
          th{
                color: grey;
            }
    </style>




    <div id="app">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                <img src="/img/unicallogo.jpg" alt="logo" style="width:300px; background-color:grey;"/>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news') }}" style="color:brown; font-size:17px; font-weight:bold;">
                            {{ __('News/Events') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}" style="color:brown; font-size:17px; font-weight:bold;">
                             {{ __('Contact Us') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}" style="color:brown; font-size:17px; font-weight:bold;">
                            {{ __('About Us') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="color:white; font-size:17px;">
                                <i class="fa fa-user"></i> {{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}" style="color:white; font-size:17px;">
                                <i class="fa fa-plus"></i> {{ __('Sign Up') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" 
                                href="#" role="button" data-toggle="dropdown" 
                                aria-haspopup="true" aria-expanded="false" v-pre style="color:white; font-size:17px;">
                                  Welcome  {{ Auth::user()->lastName }} <span class="caret"></span>
                                </a>


                                <!-- <ul class="dropdown-menu dropdown-menu-right">
                            

                                 @if(Auth::guard('web'))
                                    <li>
                                        <a href="{{ route('home') }}">
                                            Dashboard
                                        </a>
                                    </li>

                                 @elseif(Auth::guard('admin'))
                                    <li>
                                        <a href="{{ route('myAdminHomePage.index') }}">
                                            Dashboard
                                        </a>
                                    </li>
                                @endif 
                                </ul> -->

                                                   

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>

                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
        
    </div>
    <footer>
    @include('footer')
    </footer>
</body>
</html>
