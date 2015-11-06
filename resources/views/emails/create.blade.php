@extends('app')

@section('content')
    <h1 class="page-header">Add new e-mails</h1>

    {!! Form::open(['method' => 'GET', 'action' => 'EmailsController@confirm']) !!}

        <!-- White_list Form Input -->
        <div class="form-group">
            {!! Form::radio('list', 'white_list', true) !!}
            {!! Form::label('white_list', 'White list') !!}
        </div>

        <!-- Black_list Form Input -->
        <div class="form-group">
            {!! Form::radio('list', 'black_list') !!}
            {!! Form::label('black_list', 'Black list') !!}
        </div>

        <!-- Name Form Input -->
        <div class="form-group">
            {!! Form::label('customer_name', 'Customer Name:') !!}
            <select name="customer_name" id="customer_id" class="form-control">
                <!-- This is needed for the placeholder to show up -->
                <option></option>
                @foreach($customers as $key => $val)
                    <option value="{{ $key }}">{{ $val }}</option>
                @endforeach
            </select>
        </div>

        <script>
            $('#customer_id').select2({
                placeholder: 'Select from existing or make a new one',
                tags: true,
                theme: 'bootstrap'
            });
        </script>

        <!-- Email Form Input -->
        <div class="form-group">
            {!! Form::label('emails', 'Email:') !!}
            {!! Form::text('emails', null,
                ['class' => 'form-control', 'placeholder' => 'Add emails. Separate with semicolons.'])
            !!}
        </div>

        <!-- Add Emails Form Input -->
        <div class="form-group">
            {!! Form::submit('Add Emails', ['class' => 'btn btn-success form-control']) !!}
        </div>

    {!! Form::close() !!}

@endsection