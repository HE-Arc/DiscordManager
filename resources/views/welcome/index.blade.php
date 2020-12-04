@extends('layout.app')
@section('content')

    <!-- Begin page content -->
    <main role="main" class="container-fluid pt-5 ">
        <div class="container-fluid ">
            <div class="row">
                <div class="col">
                    <div class="jumbotron container-fluid h-100 ml-5 " style="border-radius: 0px ;" >
                        <h1 class="display-4">Hello !</h1>
                        <p class="lead">Bienvenue sur Discord Manager. Le meilleur gestionnaire de serveur Discord pour les administrateurs</p>
                        <hr class="my-4">
                        <p>Changer les pseudos de tout le monde en "coin-coin", faire un full-wipe des membres ou attribuez le rôle "Gros débile" en masse.
                            Avec Discord Manager tu peux ! Alors c'est vendu ? ;)</p>
                        <div class="d-flex justify-content-center align-items-center ">
                        <a class="btn btn-primary btn-lg justify-content-center  " href="{{route("login")}}" role="button">LET'S GOOOOOOOO</a>

                    </div>
                    </div>
                </div>

                <div class="col">
                    <div id="carouselExampleSlidesOnly " class="carousel slide  h-100 mr-5" data-ride="carousel">
                        <div class="carousel-inner ">
                            <div class="carousel-item active ">
                                <img src="https://miro.medium.com/max/3840/1*bNYZYQisFmGr8TpCtCaPTQ.jpeg" style= "height:500px;" class="img d-block w-100 " alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="https://www.xda-developers.com/files/2018/11/discord-logo.jpg"  style= "height:500px;" class="img d-block w-100 " alt="...">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>




    </main>
@endsection
