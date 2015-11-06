@foreach($customers as $customer)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <b>{!! $customer['name'] !!}</b>
        </div>
        <div class="panel-body">
            @foreach($customer['emails'] as $email)
                <div class="col-sm-8">
                    {!! $email['email'] !!}
                </div>
                <div class="col-sm-4 text-right">
                    {{ $email['list'] }}
                </div>
            @endforeach
        </div>
    </div>
@endforeach