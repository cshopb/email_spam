@extends('auth.authForm')

@section('body')
    {!! Form::open(['action' => 'Auth\AuthController@postLogin', 'class' => 'form-horizontal']) !!}
        <div class="panel panel-primary">
            <div class="panel-heading">Login</div>
            <div class="panel-body">
                @include('auth.partials._email')
                @include('auth.partials._password')
                @include('auth.partials._rememberMe')
                @include('auth.partials._submitButton', ['submitButtonText' => 'Login'])
            </div>
        </div>
    {!! Form::close() !!}
@stop