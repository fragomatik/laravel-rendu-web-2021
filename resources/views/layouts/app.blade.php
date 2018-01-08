<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Extreme News
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Se connecter</a></li>
                        <li><a href="{{ route('register') }}">S'inscrire</a></li>
                        <li>
                            <a href="{{ route('contact.index') }}">
                                Contact
                            </a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('article.index') }}">
                                Articles
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('members') }}">
                                Membres
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('contact.index') }}">
                                Contact
                            </a>
                        </li>
                        @if(Auth::user()->isAdmin == true)
                            <li>
                                <a href="{{ route('administrateur.index') }}">
                                    Administration
                                </a>
                            </li>
                        @else
                        @endif
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                               role="button" aria-expanded="false">
                                {{ Auth::user()->name }}
                                <img src="/uploads/profile_pictures/{{ Auth::user()->picture }}"
                                     class="img-circle" width="25" height="25">
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('profile') }}">
                                        Mon Profil
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                        Se Déconnecter
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="container">
        <div class="row">
            <hr>
            <div class="col-lg-12">
                <div class="col-md-4">
                    <p class="muted">Rendu de projet Laravel 5.4</p>
                </div>
                <div class="col-md-5">
                    <p class="muted"><strong>BENHAMMOUDA Nacer-Eddine & BODIN Anthony.</strong></p>
                </div>
                <div class="col-md-3">
                    <p class="muted pull-right">© 2017 Tous droits réservés</p>
                </div>
            </div>
        </div>
    </footer>
</div>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<!-- Scripts -->

<script
        src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
<script src="/js/main.js"></script>
<script src="/js/app.js"></script>
</body>
</html>
