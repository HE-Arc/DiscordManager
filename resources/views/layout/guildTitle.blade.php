

@extends('layout.server_icone')
@section('guildtitle')
    <a class="btn btn-primary btn-lg  " href="{{route("login")}}" role="button">@yield('v1')</a>

    <!-- guild Title -->

    <nav class="navbar navbar-expand-md " >
        <img
            @if($guild->icon != null)
            src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
            @else
            src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
            @endif
            alt="Image de guilde"
            class="rounded-circle " >
        <a class="navbar-brand" href="#">{{$guild->name}}</a>
    </nav>

@endsection

