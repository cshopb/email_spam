@extends('app')

@section('content')
    <h1 class="page-header">Edit email for <b>{{ $customer_name }}</b> customer</h1>

    {!! Form::model($email, ['method' => 'PATCH', 'action' => ['EmailsController@update', $email->id]]) !!}
        <div class="row">
            <div class="col-md-offset-2 col-md-5 form-group">
                {!! Form::text('email', null, ['class' => 'form-control']) !!}
            </div>
            <div class="col-md-2 form-group">
                {!! Form::select('list', ['white_list' => 'White List', 'black_list' => 'Black List'],
                                         $email->list,
                                         ['class' => 'form-control', 'id' => 'list']) !!}
            </div>

            <div class="col-md-1 form-group">
                {!! Form::submit('Save', ['class' => 'btn btn-info form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    <script>
        $('#list').select2({
            theme: 'bootstrap'
        });
    </script>
@endsection