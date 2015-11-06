<div class="panel panel-primary">
    <div class="panel-heading">
        Emails
    </div>
    <div class="panel-body">
        <table class="table">
            <tr>
                <th>Email:</th>
                <th>List:</th>
                <th>Customer:</th>
            </tr>
            @foreach($emails as $email)
                <tr>
                    <td>{{ $email['email'] }}</td>
                    <td>{{ $email['list'] }}</td>
                    <td>{{ $email['customer']['name'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
</div>