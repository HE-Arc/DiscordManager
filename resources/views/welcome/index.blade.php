@extends('layout.app')
@section('content')
    <!-- Begin page content -->
    <main role="main" class="container mt-5">

        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://www.verossaz.ch/verossaz/images/menu0/administration.jpg" style="height: 300px;" class="img-fluid d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="https://www.kevinmd.com/blog/wp-content/uploads/shutterstock_61663207.jpg" style="height: 300px;" class="img-fluid d-block w-100" alt="...">
                </div>
            </div>
        </div>


        <div class="jumbotron">
            <h1 class="display-4">Hello !</h1>
            <p class="lead">Bienvenue sur Discord Manager. Le meilleur gestionnaire de serveur Discord pour les administrateurs</p>
            <hr class="my-4">
            <p>Changer les pseudos de tout le monde en "coin-coin", faire un full-wipe des membres ou attribuez le rôle "Gros débile" en masse.
            Avec Discord Manager tu peux ! Alors c'est vendu ? ;)</p>
            <a class="btn btn-primary btn-lg" href="{{route("login")}}" role="button">LET'S F*CKING GOOOOOOOO</a>
        </div>
    </main>
@endsection
