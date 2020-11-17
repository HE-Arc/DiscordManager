@extends('layout.app')
@section('content')
    <!-- Begin page content -->
    <main role="main" class="container mt-5">
        <ul class="list-group">
            @foreach ($guilds as $guild)
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
                            class="img-thumbnail rounded-circle rounded-sm border-0" style="height: 50px; ">

                        {{$guild->name}}
                        @if($guild->owner == true)
                            <span class="badge badge-primary">Owner</span>
                        @endif
                    </a>
                </h5>
            </li>
            @endforeach
        </ul>

    </main>
@endsection
