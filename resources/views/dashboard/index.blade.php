@extends('layout.app')

@section('content')
    @include('dashboard.component')

    @yield('nav2')
    <div class=" d-flex justify-content-around " id="dashboard">
        <div class="col-10" id="insidedb">
            <form method="POST" action="" onsubmit="$('#myModal').modal('show'); $('#submitBtn').attr('disabled', true);">
                @csrf
                <div class="row">

                    <div class="col-sm with-background advancedGroupList">
                        <h1 class="list-title">Users</h1>
                        <div class="md-form mt-0 dark-mode">
                            <input id="searchMember" class="form-control dark-mode searchbar" type="text"
                                   placeholder="Search"
                                   aria-label="Search">
                        </div>
                        <div class="light-writing"><input id="selectAllMembers" class="selectAll" type="checkbox">
                            Select all
                        </div>
                        <div id="listMembers" class="list-group list-group-flush">
                            @foreach ($members as $member)
                                <label class="list-group-item d-flex justify-content-start align-items-center">
                                    <input class="form-check-input" type="checkbox" name="usersId[]"
                                           value="{{$member->user->id}}">
                                    <img
                                        @if($member->user->avatar != null)
                                        src="https://cdn.discordapp.com/avatars/{{$member->user->id}}/{{$member->user->avatar}}.png?size=128"
                                        @else
                                        src="/logo.svg"
                                        @endif
                                        alt="Image de guilde"
                                        class="rounded-circle mx-2">
                                    <div id="memberName" class="mx-2">
                                        <div class="text-nowrap text-truncate font-weight-bold">
                                            {{$member ->user->username}}#{{$member ->user->discriminator}}
                                        </div>
                                        @if($member->nick != null)
                                            <small
                                                class="text-nowrap text-truncate font-italic">{{$member->nick}}</small>
                                            <br>
                                        @endif
                                        @if($member->user->bot == true)
                                            <span class="badge badge-primary">BOT</span>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#selectAllMembers').change(function () {
                                checkboxSelectAll = this;
                                $("#listMembers label:visible .form-check-input").filter(function () {
                                    if (checkboxSelectAll.checked) {
                                        $(this).prop('checked', true);
                                    } else {
                                        $(this).prop('checked', false);
                                    }
                                });
                            });
                        });
                    </script>


                    <div class="col-sm">
                        <h1 class="list-title">Action</h1>
                        <ul class=" list-group big-list list-group-flush ">
                            <input id="action" name="action" value="addRoles" hidden>


                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active"
                                   onclick="document.getElementById('role_list').style.visibility = 'visible';
                                   document.getElementById('action').value = 'addRoles';"
                                   data-toggle="list" href="#"
                                   role="tab" aria-controls="home">Add roles</a>
                                <a class="list-group-item list-group-item-action"
                                   onclick="document.getElementById('role_list').style.visibility = 'visible';
                                   document.getElementById('action').value = 'removeRoles';"
                                   data-toggle="list" href="#" role="tab"
                                   aria-controls="profile">Remove roles</a>
                                <a class="list-group-item list-group-item-action"
                                   onclick="document.getElementById('role_list').style.visibility = 'hidden';
                                   document.getElementById('action').value = 'kick';"
                                   data-toggle="list" href="#" role="tab"
                                   aria-controls="messages">Kick user</a>
                            </div>
                        </ul>
                    </div>

                    <div class="col-sm with-background advancedGroupList" id="role_list">
                        <h1 class="list-title">Roles</h1>
                        <div class="md-form mt-0">
                            <input id="searchRole" class="form-control dark-mode searchbar" type="text"
                                   placeholder="Search" aria-label="Search">
                        </div>
                        <div class="light-writing"><input id="selectAllRoles" class="selectAll" type="checkbox"> Select
                            all
                        </div>
                        <div id="listRoles" class="list-group list-group-flush">
                            @foreach ($roles as $role)
                                <label class="list-group-item d-flex justify-content-start align-items-center">
                                    <input class="form-check-input" type="checkbox" name="rolesId[]"
                                           value="{{$role ->id}}">
                                    <div class="text-nowrap text-truncate font-weight-bold mx-2 "
                                         style="color: #{{dechex($role->color)}}">
                                        {{$role->name}}
                                    </div>
                                </label>

                            @endforeach
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('#selectAllRoles').change(function () {
                                checkboxSelectAll = this;
                                $("#listRoles label:visible .form-check-input").filter(function () {
                                    if (checkboxSelectAll.checked) {
                                        $(this).prop('checked', true);
                                    } else {
                                        $(this).prop('checked', false);
                                    }
                                });
                            });
                        });
                    </script>

                </div>
                <div class="apply-button-container">
                    <input class="btn btn-primary btn-lg apply-button" type="button" value="Apply changes" id="submitBtn" onclick="$('#myModal').modal('show');">
                </div>
            </form>

            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center " >
                            <h5 class="modal-title " id="exampleModalLabel"><img src="/logo.svg" alt="" width="100" height="100"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Please wait, our owls are working on your request.
                        </div>
{{--                        <div class="modal-footer">--}}
{{--                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                            <button type="button" class="btn btn-primary">Save changes</button>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

