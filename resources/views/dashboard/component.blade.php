@extends('layout.component')
@section('guildtitle')
    <!-- guild Title -->

    <a> <img
            @if($guild->icon != null)
            src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
            @else
            src="/logo.svg"
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
        src="/logo.svg"
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
                        {{ $pageName }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/dashboard/{{$guild->id}}">Members</a></li>
                        <li><a class="dropdown-item" href="/dashboard/about-server/{{$guild->id}}">Server info</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
@endsection
