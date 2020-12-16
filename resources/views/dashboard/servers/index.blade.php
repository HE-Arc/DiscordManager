@extends('layout.app')
@section('content')
    @include('layout.componant')
    <!-- home -->
    <main role="main" class="container mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h1 class="light-writing">Manage server</h1>
                    <ul class=" list-group list-group-flush">
                        @foreach ($InGuildList as $guild)
                            <li class="list-group-item" >
                                <h5 >
                                    <a href="{{route("dashboard.server",$guild->id)}}">
                                        <img
                                            @if($guild->icon != null)
                                            src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
                                            @else
                                            src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
                                            @endif
                                            alt="Image de guilde"
                                            class="rounded-circle ">
                                        {{$guild->name}}

                                        @if($guild->owner == true)
                                            <span class="badge badge-primary" >Owner</span>
                                        @endif
                                    </a>
                                </h5>
                            </li>
                        @endforeach

                    </ul>
                </div>
                <div class="col-sm">
                    <h1 class="light-writing" >Add server</h1>
                    <ul class="list-group list-group-flush" >
                        <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                        @foreach ($NotInGuildList as $guild)
                            <li class="list-group-item" >
                                <h5>
                                    <a class=""  href="{{route("add-bot",$guild->id) }}">
                                        <img
                                            @if($guild->icon != null)
                                            src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
                                            @else
                                            src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
                                            @endif
                                            alt="Image de guilde"
                                            class="rounded-circle " >

                                        {{$guild->name}}
                                        @if($guild->owner == true)
                                            <span class="badge badge-primary" >Owner</span>
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
