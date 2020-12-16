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
                        <p class="lead">Welcome on Discord Manager, have you ever dream changing everyone's roles with
                            only four clicks ? You are at the best place for this ! Just click on the button to start this marvelous adventure !</p>
                        <hr class="my-4">
                        <p></p>
                        <div class="d-flex  ">
                            <a class="btn btn-primary btn-lg  " href="{{route("login")}}" role="button">Let's Go !</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                </div>
            </div>
        </div>


    </main>
@endsection
