@extends('auth.authForm')

@section('body')
    {!! Form::open(['action' => 'Auth\AuthController@postRegister', 'class' => 'form-horizontal']) !!}
        <div class="panel panel-primary">
            <div class="panel-heading">Register</div>
            <div class="panel-body">
                @include('auth.partials._name')
                @include('auth.partials._email')
                @include('auth.partials._password')
                @include('auth.partials._confirmPassword')
                @include('auth.partials._rememberMe')
                @include('auth.partials._submitButton', ['submitButtonText' => 'Register'])
            </div>
        </div>
    {!! Form::close() !!}
@stop