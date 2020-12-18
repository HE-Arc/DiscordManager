@extends('layout.app')
@section('content')
    @include('welcome.component')
    @yield('banner')
    <!-- welcome -->
    <main role="main" class="container-fluid pt-5 ">
        <div class="container-fluid ">
            <div class="row">
                <div class="col">
                    <div class="jumbotron ">
                        <h1 class="display-4">Hello !</h1>
                        <p class="lead">
                            Have you ever dreamt of changing everyone's roles with only a few clicks ? Then look no further !
                            <br>Discord manager is a web dashboard who's objective is to provide users tools to simplify the management process.
                            <br>Want to learn more ?</p>

                        <div class="d-flex  ">
                            <a class="btn btn-primary btn-lg  " href="{{route("login")}}" role="button">Click here !</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                </div>
            </div>
        </div>


    </main>
@endsection
