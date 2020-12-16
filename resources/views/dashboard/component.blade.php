@extends('layout.component')
@section('guildtitle')
    <!-- guild Title -->

    <a> <img
            @if($guild->icon != null)
            src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
            @else
            src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
            @endif
            alt="Image de guilde"
            class="rounded-circle ">

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
        class="rounded-circle ">
@endsection

@section('openbody')
    <body>
    @endsection
    @section('nav2')
        <nav class="navbar navbar-expand-md navbar-dark light-writing">
            <a class="light-writing">@yield('guildtitle')</a>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
@endsection
