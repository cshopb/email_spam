@foreach($customers as $customer)
    <div class="panel panel-primary">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-11">
                    <b>{!! $customer['name'] !!}</b>
                </div>
                <div class="col-md-1 text-right">
                    @include('partials._editCustomerLink')
                    @include('partials._deleteCustomerLink')
                </div>
            </div>
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
                    @include('partials._editEmailLink')
                    @include('partials._deleteEmailLink')
                </div>
            @endforeach
        </div>
    </div>
@endforeach