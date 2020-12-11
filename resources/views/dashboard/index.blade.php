
@extends('layout.guildTitle')

@section('content1')


    <!-- Begin page content -->

    <main role="main" class="container-fluid  " style=" background-color:#23272A; color : #FFFFFF; ">
        <div class="container pl-0 ml-0  container-fluid" >
            <div class="row " >
                <div class="col-sm-4 pb-0 " style=" background-color:#23272A; color: #FFFFFF; ">

                    <ul class="nav flex-column" style=" background-color:#23272A; color: #FFFFFF; ">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-8" style="background-color:#2C2F33;">
                    <h2>{{$guild->name}}</h2>

                </div>
                <div class="panel panel-primary" id="result_panel">
                    <div class="panel-heading"><h3 class="panel-title">Result List</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group" >
                            <li class="list-group-item"><strong>Signature
                                    Accommodations</strong>(1480m)
                            </li>
                            @foreach ($member as $members)
                                <li class="list-group-item" style="background-color:#23272A;">
                                    <h5 >
                                        {{$member->name}}
                                    </h5>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
