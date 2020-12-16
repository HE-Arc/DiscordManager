@extends('layout.app')

@section('content')
    @include('dashboard.component')

    @yield('nav2')
    <div class=" d-flex justify-content-around " id="dashboard">
        <div class="col-8" id="inside-db"></div>
    </div>

@endsection

