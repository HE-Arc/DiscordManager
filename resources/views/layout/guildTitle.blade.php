
@extends('layout.app')
@section('content')
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#23272A;">
        <img
            @if($guild->icon != null)
            src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
            @else
            src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
            @endif
            alt="Image de guilde"
            class="rounded-circle " style="height: 50px; ">
        <a class="navbar-brand" href="#">{{$guild->name}}</a>
    </nav>
@endsection
