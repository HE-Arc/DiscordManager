@extends('layout.app')
@section('content')
    <!-- Begin page content -->
    <main role="main" class="container mt-5">
        <a class="btn btn-primary btn-lg" href="{{route("add-bot")}}" role="button">Add Bot to server</a>

        <ul class="list-group">
            @foreach ($guilds as $guild)
            <li class="list-group-item">
                <img src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
                    alt="Image de guilde"
                    class="img-thumbnail">
                <h5>
                    {{$guild->name}}
                    @if($guild->owner == true)
                        <span class="badge badge-primary">Owner</span>
                    @endif
                </h5>
            </li>
            @endforeach
        </ul>

    </main>
@endsection
