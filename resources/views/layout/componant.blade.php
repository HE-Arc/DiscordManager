






@section('header')
<header>
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="#">Discord Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ml-auto">
            @if (Session::has('discord_token'))
                @if (Route::has('home'))
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route("home")}}">Home <i class="fas fa-home"></i></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route("test")}}">TEST API<i class="fab fa-discord"></i></a>
                    </li>
                @endif
                <li class="nav-item active">
                    <a class="nav-link" href=""> <i class="fas fa-home"></i></a>
                </li>

            @else
                <li class="nav-item active">
                    <a class="nav-link" href="{{route("login")}}">Login with Discord <i class="fab fa-discord"></i></a>
                </li>
            @endif
        </ul>
    </nav>
</header>
@endsection

