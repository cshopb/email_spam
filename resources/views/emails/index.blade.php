@extends('app')

@section('content')
    <h1 class="page-header">Emails</h1>
    <div class="row">
        @include('emails.partials._indexSelectBox')
    </div>

    <div class="row">
        @include('emails.partials._indexEmailsDisplay')
    </div>

    @include('partials._deleteConfirmationModal')
@endsection