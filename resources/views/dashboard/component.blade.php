
@extends('layout.componant')
@section('guildtitle')
    <!-- guild Title -->

        <a>  <img
                @if($guild->icon != null)
                src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
                @else
                src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
                @endif
                alt="Image de guilde"
                class="rounded-circle " >

            {{$guild->name}}</a>

@endsection
@section('img')
    <!-- img-->

    <img
        @if($guild->icon != null)
        src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
        @else
        src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
        @endif
        alt="Image de guilde"
        class="rounded-circle " >
@endsection

@section('sidebar')
    <div class="sidebar">

        <a>@yield('guildtitle')</a>
        <a  href="#home">Members</a>


    </div>
@endsection
@section('openbody')
    <body >
@endsection
