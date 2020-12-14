@extends('layout.app')
@section('content')
    @include('home.component')
    <!-- home -->

        <div class="row " id="dashboard">
            <div class="col-2">
                @yield('sidebar_home')
            </div>
            <div class="col-8 " id="insidedb">
                <div class="row justify-content-around">
                    <div class="col-sm">
                        <h1 class="list-title">Manage server</h1>
                        <ul class=" list-group  large-list">
                            @foreach ($InGuildList as $guild)
                                <li class="list-group-item">
                                    <h5>
                                        <a href="{{route("dashboard",$guild->id)}}">
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
                                                <span class="badge badge-primary">Owner</span>
                                            @endif
                                        </a>
                                    </h5>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="col-sm ">
                        <h1 class="list-title">Add server</h1>
                        <ul class="list-group list-group-flush large-list" id="add_server_list">

                            @foreach ($NotInGuildList as $guild)
                                <li class="list-group-item">
                                    <h5>
                                        <a class="" href="{{route("add-bot",$guild->id) }}">
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
                                                <span class="badge badge-primary">Owner</span>
                                            @endif
                                        </a>
                                    </h5>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>


@endsection
