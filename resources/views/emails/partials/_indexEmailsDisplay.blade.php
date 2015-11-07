@foreach($customers as $customer)
    <div class="panel panel-info">
        <div class="panel-heading">
            <b>{!! $customer['name'] !!}</b>
        </div>
        <div class="panel-body">
            @foreach($customer['emails'] as $email)
                <div class="col-sm-7 {{ $email['list'] }}">
                    {!! $email['email'] !!}
                </div>
                <div class="col-sm-4 text-right {{ $email['list'] }}">
                    {{ ucwords(str_replace('_', ' ', $email['list'])) }}
                </div>
                <div class="col-md-1 text-right {{ $email['list'] }}">
                    <a href={{ action('EmailsController@edit', [$email['id']]) }} class="edit">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>
                    <a data-toggle="modal"
                       data-target="#deleteModal"
                       data-id="{{ $email['id'] }}"
                       data-email="{{ $email['email'] }}"
                       class="delete">
                            <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endforeach

@include('emails.partials._deleteConfirmationModal')