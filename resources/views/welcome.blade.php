<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Extreme News - Le meilleur de l'info</title>
    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Style spécifique à la home-->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        body {
            background: url("/uploads/home_pictures/wallpaper_home.png") no-repeat center/cover;
            height: 100vh;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: black;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        p {
            font-size: 26px;
            font-weight: 700;
        }
    </style>
</head>
    <body>
    <div class="flex-center position-ref full-height">

        <div class="top-left links">
            <a href="/">
                Extreme News
            </a>
        </div>
        @if (Route::has('login'))
            <div class="top-right links">
                @if (Auth::check())
                    <a href="{{ route('article.index') }}">Articles</a>
                    <a href="{{ route('members') }}">Membres</a>
                    <a href="{{ route('contact.index') }}">Contact</a>

                    @if(Auth::user()->isAdmin == true)
                        <a href="{{ route('administrateur.index') }}">Administration</a>
                    @endif
                    <a href="{{ route('profile') }}">Mon Profil</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                        Se Déconnecter
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                @else
                    <a href="{{ url('/login') }}">Se connecter</a>
                    <a href="{{ url('/register') }}">S'inscrire</a>
                    <a href="{{ route('contact.index') }}">Contact</a>
                @endif
            </div>
        @endif

        <div class="content">
            <div>
                <img class="home-img img-responsive " src="/uploads/home_pictures/logo.png">
                <p class="m-b-md home-hook">
                    La véracité de l'information comme principale quête</p>

                @if (!Auth::check())
                    <ul class="home-button">

                        <li>
                            <a class="btn btn-default btn-sm" href="{{url('/login')}}"
                               style="font-size:18px; text-decoration: none; color: grey">
                                Connectez-vous
                            </a>
                        </li>
                        <li> OU</li>

                        <li>
                            <a class="btn btn-default btn-sm" href="{{url('/register')}}"
                               style="font-size:18px; text-decoration: none; color: grey">
                                Inscrivez-vous
                            </a>
                        </li>

                    </ul>
                @endif
            </div>
        </div>

    </div>
</body>
</html>
