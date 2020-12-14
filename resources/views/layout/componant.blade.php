
@section('header')
<header>
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="#">Discord Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ml-auto">
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
@endsection

