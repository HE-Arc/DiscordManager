<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Discord Manager</title>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome-->
    <script src="https://kit.fontawesome.com/60010d6147.js" crossorigin="anonymous"></script>
</head>

<body style="background-color:#2C2F33;">
<header>
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#23272A;">
        <a class="navbar-brand" href="#">Discord Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ml-auto">
{{--            @if (Session::has('discord_token'))--}}
            @if (\Illuminate\Support\Facades\Auth::check())
                @if (Route::has('home'))
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route("home")}}">Home <i class="fas fa-home"></i></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route("test")}}">TEST API<i class="fab fa-discord"></i></a>
                    </li>
                @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{\Illuminate\Support\Facades\Auth::user()->name}}
                            <img
                                src="{{\Illuminate\Support\Facades\Auth::user()->image}}"
                                alt="Image de profil"
                                class="rounded-circle" style="height: 25px; ">
                        </a>
                        <div class="dropdown-menu bg-danger" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item bg-danger text-white" href="{{route("logout")}}">Logout</a>
                        </div>
                    </li>

            @else
                <li class="nav-item active">
                    <a class="nav-link" href="{{route("login")}}">Login with Discord <i class="fab fa-discord"></i></a>
                </li>
            @endif
        </ul>
    </nav>
</header>

@yield('content')
@yield('content1')
</body>
</html>
