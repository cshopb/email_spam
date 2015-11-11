<div class="panel panel-primary">
    <div class="panel-heading">
        Customers
    </div>
    <div class="panel-body">
        <table class="table">
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer['name'] }}</td>
                    <td class="text-right">
                        @include('partials._editCustomerLink')
                        @include('partials._deleteCustomerLink')
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>