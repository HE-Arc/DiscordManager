@extends('layout.app')
@section('content')
    @include('welcome.component')
    @yield('banner')
    <!-- welcome -->
    <main role="main" class="container-fluid pt-5 ">
        <div class="container-fluid ">
            <div class="row">
                <div class="col">
                    <div class="jumbotron "  >
                        <h1 class="display-4">Hello !</h1>
                        <p class="lead">Bienvenue sur Discord Manager. Le meilleur gestionnaire de serveur Discord pour les administrateurs</p>
                        <hr class="my-4">
                        <p></p>
                        <div class="d-flex  ">
                            <a class="btn btn-primary btn-lg  " href="{{route("login")}}" role="button">GO</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                </div>
            </div>
        </div>


    </main>
@endsection
