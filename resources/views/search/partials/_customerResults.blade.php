<div class="panel panel-primary">
    <div class="panel-heading">
        Customers
    </div>
    <div class="panel-body">
        <table class="table">
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer['name'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>