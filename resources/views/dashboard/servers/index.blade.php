@extends('layout.app')
@section('content')
    @include('layout.component')
    <!-- home -->
    <main role="main" class="container mt-5">
        <div class="container">
            <div class="row">
                <div class="col-sm with-background advancedGroupList">
                    <h1 class="light-writing">Manage server</h1>
                    <div class="md-form mt-0">
                        <input class="form-control dark-mode searchbar" type="text" placeholder="Search"
                               aria-label="Search">
                    </div>
                    <div class=" list-group list-group-flush">
                        @foreach ($InGuildList as $guild)
                            <label class="list-group-item d-flex justify-content-start align-items-center">
                                <a class="d-flex flex-row" href="{{route("dashboard.server",$guild->id)}}">
                                    <img
                                        @if($guild->icon != null)
                                        src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
                                        @else
                                        src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
                                        @endif
                                        alt="Image de guilde"
                                        class="rounded-circle">
                                    <div class="mx-2">
                                        <div class="text-nowrap text-truncate font-weight-bold">
                                            {{$guild->name}}<br>
                                            @if($guild->owner == true)
                                                <span class="badge badge-primary">Owner</span>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </label>
                        @endforeach

                    </div>
                </div>
                <div class="col-sm with-background advancedGroupList">
                    <h1 class="light-writing" >Add server</h1>
                    <div class="md-form mt-0">
                        <input class="form-control dark-mode searchbar" type="text" placeholder="Search"
                               aria-label="Search">
                    </div>
                    <div class="list-group list-group-flush">
                        <div data-spy="scroll" data-target="#navbar-example2" data-offset="0">
                            @foreach ($NotInGuildList as $guild)
                                <label class="list-group-item d-flex justify-content-start align-items-center">
                                    <a class="d-flex flex-row" href="{{route("add-bot",$guild->id)}}">
                                        <img
                                            @if($guild->icon != null)
                                            src="https://cdn.discordapp.com/icons/{{$guild->id}}/{{$guild->icon}}.png"
                                            @else
                                            src="https://cdn.discordapp.com/app-icons/761513537825669130/6436659f90801b9ac8b9a5e7dac56bfb.png"
                                            @endif
                                            alt="Image de guilde"
                                            class="rounded-circle mx-2">
                                        <div class="mx-2">
                                            <div class="text-nowrap text-truncate font-weight-bold">
                                                {{$guild->name}}<br>
                                                @if($guild->owner == true)
                                                    <span class="badge badge-primary">Owner</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </label>
                            @endforeach
                        </div>
                    </div>
{{--                    <script type="text/javascript">--}}
{{--                        $(document).ready(function () {--}}
{{--                            $("#searchAddedServer").on("keyup", function () {--}}
{{--                                var value = $(this).val().toLowerCase();--}}
{{--                                $("#listAdded label").filter(function () {--}}
{{--                                    if ($(this).text().toLowerCase().indexOf(value) > -1) {--}}
{{--                                        $(this).show();--}}
{{--                                    } else {--}}
{{--                                        $(this).attr('style', 'display: none !important');--}}
{{--                                    }--}}
{{--                                });--}}
{{--                            });--}}
{{--                            $("#searchNotAddedServer").on("keyup", function () {--}}
{{--                                var value = $(this).val().toLowerCase();--}}
{{--                                $("#listNotAdded label").filter(function () {--}}
{{--                                    if ($(this).text().toLowerCase().indexOf(value) > -1) {--}}
{{--                                        $(this).show();--}}
{{--                                    } else {--}}
{{--                                        $(this).attr('style', 'display: none !important');--}}
{{--                                    }--}}
{{--                                });--}}
{{--                            });--}}
{{--                        });--}}
{{--                    </script>--}}
                </div>
            </div>
        </div>

    </main>
@endsection
