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
                        <h1 class="list-title">Users</h1>
                        <div class="md-form mt-0 dark-mode">
                            <input class="form-control dark-mode" type="text" placeholder="Search" aria-label="Search">
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($members as $member)
                                <li class="list-group-item">
                                    <input class="form-check-input" type="checkbox" name="usersId[]" value="{{$member ->user->id}}">
                                    {{$member ->user->username}}
                                    @if($member->nick != null)
                                        ({{$member->nick}})
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <div class="light-writing"><input type="checkbox"> select all</div>

                    </div>
                    <div class="col-sm">
                        <h1 class="list-title">Action</h1>
                        <ul class=" list-group big-list list-group-flush ">

                            <li class="list-group-item big-list">
                                <input class="form-check-input" type="radio" name="action" value="addRoles" checked
                                       onclick="document.getElementById('role_list').style.visibility = 'visible';">
                                Add roles
                            </li>
                            <li class="list-group-item big-list">
                                <input class="form-check-input" type="radio" name="action" value="removeRoles"
                                       onclick="document.getElementById('role_list').style.visibility = 'visible';">
                                Remove roles
                            </li>
                            <li class="list-group-item big-list">
                                <input class="form-check-input" type="radio" name="action" value="kick"
                                       onclick="document.getElementById('role_list').style.visibility = 'hidden';">
                                Kick user
                            </li>

                        </ul>
                    </div>
                    <div class="col-sm" id="role_list">
                        <h1 class="list-title">Roles</h1>
                        <div class="md-form mt-0">
                            <input class="form-control dark-mode" type="text" placeholder="Search" aria-label="Search">
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($roles as $role)
                                <li class="list-group-item">
                                    <input class="form-check-input" type="checkbox" name="rolesId[]" value="{{$role ->id}}">
                                    {{$role ->name}}
                                </li>
                            @endforeach
                        </ul>
                        <div class="light-writing"><input type="checkbox"> select all</div>
                    </div>
                </div>
                <input class="btn btn-primary btn-lg" type="submit" value="OK">
            </form>

        </div>
    </div>
@endsection

