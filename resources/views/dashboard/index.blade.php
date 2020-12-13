
@extends('layout.app')

@section('content')
@include('dashboard.component')
<div class="row " id="dashboard">
    <div class="col-2">
        @yield('sidebar')
    </div>
    <div class="col-8 ">
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

                    <ul class="list-group " >
                            <li class="list-group-item" >
                                KICK
                            </li>
                        <li class="list-group-item" >
                            remove role
                        </li>
                        <li class="list-group-item" >
                            add role
                        </li>
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
    </div>
</div>
@endsection

