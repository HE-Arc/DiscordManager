@extends('layout.app')

@section('content')
    @include('dashboard.component')

    @yield('nav2')
    <div class=" d-flex justify-content-around " id="dashboard">
        <div class="col-8  " id="insidedb">
            <form method="POST" action="">
                @csrf
                <div class="row">

                    <div class="col-sm">
                        <h1 class="list-title">Users</h1>
                        <div class="md-form mt-0 dark-mode">
                            <input id="searchMember" class="form-control dark-mode" type="text" placeholder="Search"
                                   aria-label="Search">
                        </div>
                        <div id="membersList" class="list-group list-group-flush">
                            @foreach ($members as $member)
                                <label class="list-group-item d-flex justify-content-start align-items-center">
                                    <input class="form-check-input" type="checkbox" name="usersId[]"
                                           value="{{$member->user->id}}">
                                    <img
                                        @if($member->user->avatar != null)
                                        src="https://cdn.discordapp.com/avatars/{{$member->user->id}}/{{$member->user->avatar}}.png?size=128"
                                        @else
                                        src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
                                        @endif
                                        alt="Image de guilde"
                                        class="rounded-circle mx-2">
                                    <div id="memberName" class="mx-2">
                                        <div class="font-weight-bold">{{$member ->user->username}}
                                            #{{$member ->user->discriminator}}
                                            @if($member->user->bot == true)
                                                <span class="badge badge-primary">BOT</span>
                                            @endif
                                        </div>
                                        @if($member->nick != null)
                                            <small class="font-italic">{{$member->nick}}</small>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <div class="light-writing"><input type="checkbox"> select all</div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $("#searchMember").on("keyup", function () {

                                var value = $(this).val().toLowerCase();
                                $("#membersList label").filter(function () {
                                    if ($(this).text().toLowerCase().indexOf(value) > -1) {
                                        $(this).show();
                                        $(this).children().show();
                                    } else {
                                        $(this).hide();
                                        $(this).children().hide();
                                    }
                                });
                            });
                        });
                    </script>


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
                                    <input class="form-check-input" type="checkbox" name="rolesId[]"
                                           value="{{$role ->id}}">
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

