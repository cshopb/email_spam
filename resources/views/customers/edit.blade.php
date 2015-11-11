@extends('app')

@section('content')
    <h1 class="page-header">Edit <b>{{ $customer['name'] }}</b></h1>

    {!! Form::model($customer, ['method' => 'PATCH', 'action' => ['CustomersController@update', $customer->id]]) !!}
    <div class="row">
        <div class="col-md-offset-2 col-md-5 form-group">
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="col-md-1 form-group">
            {!! Form::submit('Save', ['class' => 'btn btn-info form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection