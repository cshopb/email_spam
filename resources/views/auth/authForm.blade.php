@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                @yield('body')
            </div>
        </div>
    </div>
@stop