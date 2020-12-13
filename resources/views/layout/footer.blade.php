
@extends('layout.app')
@section('footer')
    <footer class="fixed-bottom w-75 mx-auto">
        @if (Session::has('status'))
            <div class="alert {{Session::get('status')}} alert-dismissible fade show" role="alert">
                {{Session::get('status_msg')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </footer>
@endsection
