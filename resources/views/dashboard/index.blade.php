@extends('layout.app')
@section('v1')
    YO1
@endsection

@section('content')
@include('layout.sidebar')


<div class="row">
<div class="col-sm">
<ul class="list-group list-group-flush" >
        @foreach ($members as $member)
            <li class="list-group-item" >

                    {{$member ->user->username}}
                @if($member->nick != null)
                    ({{$member->nick}})

                @endif
            </li>
        @endforeach
</ul>
</div>
<div class="col-sm">
<ul class="list-group list-group-flush" >
        @foreach ($roles as $role)
            <li class="list-group-item" >
                    {{$role ->name}}

            </li>
        @endforeach
</ul>
</div>
</div>
@endsection

