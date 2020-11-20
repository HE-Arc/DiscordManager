@extends('layout.app')
@section('content')
    <!-- Begin page content -->
    <main role="main" class="container mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1 style="color:#ffffff;">Manage server</h1>
                    <ul class=" list-group list-group-flush">
                        @foreach ($InGuildList as $guild)
                            <li class="list-group-item" style="background-color:#23272A;">
                                <h5 >
                                    <a style="color:#7289DA;" href="{{route("add-bot",$guild->id) }}">
                                        <img
                                            @if($guild->icon != null)
                                            src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
                                            @else
                                            src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
                                            @endif
                                            alt="Image de guilde"
                                            class="rounded-circle " style="height: 50px; ">
                                        {{$guild->name}}
                                        @if($guild->owner == true)
                                            <span class="badge badge-primary" style="background-color:#7289DA;">Owner</span>
                                        @endif
                                        <a class="btn btn-primary btn-lg justify-content-right  " href="{{route("dashboard")}}" role="button">WIP path</a>
                                    </a>
                                </h5>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-sm">
                    <h1 style="color:#ffffff;">Add server</h1>
                    <ul class="list-group list-group-flush" >
                        @foreach ($NotInGuildList as $guild)
                            <li class="list-group-item" style="background-color:#23272A;">
                                <h5>
                                    <a class="" style="color:#7289DA;" href="{{route("add-bot",$guild->id) }}">
                                        <img
                                            @if($guild->icon != null)
                                            src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
                                            @else
                                            src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
                                            @endif
                                            alt="Image de guilde"
                                            class="rounded-circle " style="height: 50px; ">

                                        {{$guild->name}}
                                        @if($guild->owner == true)
                                            <span class="badge badge-primary" style="background-color:#7289DA;">Owner</span>
                                        @endif
                                    </a>
                                </h5>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>


    </main>
@endsection
