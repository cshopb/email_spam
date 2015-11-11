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
                <tr class="{{ $email['list'] }}">
                    <td>{{ $email['email'] }}</td>
                    <td>{{ $email['list'] }}</td>
                    <td>{{ $email['customer']['name'] }}</td>
                    <td class="text-right">
                        @include('partials._editEmailLink')
                        @include('partials._deleteEmailLink')
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>