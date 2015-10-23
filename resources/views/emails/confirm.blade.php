@extends('app')

@section('content')
<h1 class="page-header">Confirm</h1>

{!! Form::open(['action' => 'EmailsController@store']) !!}

    <div class='{!! $panel !!}'>
        <div class="panel-heading">
            The e-mails for the {{ $customer_name }} customer will be added to the {{ $list_type }}
        </div>
        <div class="panel-body">
            @include('emails.partials._emailTextFields')

            <!-- Confirm Form Input -->
            <div class="form-group">
                {!! Form::submit('Confirm', ['class' => $button .' form-control']) !!}
            </div>
        </div>
    </div>

    @include('emails.partials._checkEmailScript')
{!! Form::close() !!}
@endsection