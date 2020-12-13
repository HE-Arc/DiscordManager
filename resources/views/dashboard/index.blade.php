@extends('layout.app')

@section('content')
    @include('dashboard.component')
    <div class="row " id="dashboard">
        <div class="col-2">

            @yield('sidebar')
        </div>

        <div class="col-8 " id="insidedb">
            <form method="POST" action="">
                @csrf
                <div class="row">
                    <div class="col-sm">
                        <ul class="list-group list-group-flush">
                            @foreach ($members as $member)
                                <li class="list-group-item">
                                    <input type="checkbox" name="usersId[]" value="{{$member ->user->id}}">
                                    {{$member ->user->username}}
                                    @if($member->nick != null)
                                        ({{$member->nick}})
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm">

                        <ul class="w3-ul ">
                            <li class="list-group-item">
                                <input type="radio" name="action" value="addRoles" checked onclick="document.getElementById('role_list').style.visibility = 'visible';">
                                add role
                            </li>
                            <li class="list-group-item">
                                <input type="radio" name="action" value="removeRoles" onclick="document.getElementById('role_list').style.visibility = 'visible';">
                                remove role
                            </li>
                            <li class="list-group-item">
                                <input type="radio" name="action" value="kick" onclick="document.getElementById('role_list').style.visibility = 'hidden';">
                                KICK
                            </li>

                        </ul>
                    </div>
                    <div class="col-sm" id="role_list">
                        <ul class="list-group list-group-flush">
                            @foreach ($roles as $role)
                                <li class="list-group-item">
                                    <input type="checkbox" name="rolesId[]" value="{{$role ->id}}">
                                    {{$role ->name}}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <input type="submit" value="OK">
            </form>

        </div>
    </div>
@endsection

