@extends('layout.app')

@section('content')
    @include('dashboard.component')

    @yield('nav2')
    <div class=" d-flex justify-content-around " id="dashboard">
        <div class="col-4">
            <div class="col-sm with-background info-body">
                <h1 class="py-2 px-3">Server Info</h1>
                <div class="py-2 px-5">
                    <p>Guild ID : {{$guild->id}}</p>
                    <p>Guild Name : {{$guild->name}}</p>
                    <p>Guild region : {{$guild->region}}</p>
                    <p>Number of members : {{$stats['nbMembers']}}</p>
                    <p>Number of roles : {{$stats['nbRoles']}}</p>
                    <p>Total number of channels : {{$stats['statsChannels']->get('0', 0) + $stats['statsChannels']->get('2', 0) + $stats['statsChannels']->get('4', 0)}}</p>
                    <p>Number of text channels : {{$stats['statsChannels']->get('0', 0)}}</p>
                    <p>Number of voice channels : {{$stats['statsChannels']->get('2', 0)}}</p>
                    <p>Number of categories : {{$stats['statsChannels']->get('4', 0)}}</p>
                    <p>Total number of Emojis : {{$stats['statsEmojis']->get('0', 0) + $stats['statsEmojis']->get('1', 0)}}</p>
                    <p>Number of Emojis: {{$stats['statsEmojis']->get('0', 0)}}</p>
                    <p>Number of animated Emojis : {{$stats['statsEmojis']->get('1', 0)}}</p>
                </div>
            </div>

        </div>
    </div>

@endsection

