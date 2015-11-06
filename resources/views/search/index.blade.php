@extends('app')

@section('content')
    <div class="row">
        <h1 class="page-header">Search result for: <b>{{ $search }}</b></h1>

        @if($emails != null)
            @include('search.partials._emailResults')
        @endif

        @if($customers != null)
            @include('search.partials._customerResults')
        @endif

    </div>
@endsection