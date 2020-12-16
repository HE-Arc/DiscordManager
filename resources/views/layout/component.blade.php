
@section('header')
<header>
    <nav class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" href="/">
            <img src="/logo.svg" alt="" width="30" height="30">
            Discord Manager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ml-auto">
            @if (\Illuminate\Support\Facades\Auth::check())
                @if (Route::has('dashboard'))
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route("dashboard")}}">Dashboard <i class="fas fa-home"></i></a>
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

@section('footer')
    <!-- Footer -->
    <footer class="page-footer fixed-bottom ">
        <!-- Copyright -->
{{--        <div class="footer-copyright text-center py-3 footer">--}}
{{--            <a href="">2020 <b>Discord Manager</b></a>--}}
{{--        </div>--}}
        <!-- Copyright -->

        @if(Session::has('status'))
        <div class="alert {{Session::get('status')}} alert-dismissible w-75 mx-auto fade show" role="alert">
            {{Session::get('status_msg')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
            <script type="text/javascript">
                $(".alert").fadeTo(2000, 500).slideUp(500, function(){
                    $(".alert").slideUp(500);
                });
            </script>
        @endif
    </footer>

@endsection
