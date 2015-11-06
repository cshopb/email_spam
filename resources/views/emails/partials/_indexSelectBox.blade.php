<div class="col-md-offset-10 form-group">
    <!-- I used the select instead of Form::select because that way there is no placeholder -->
    {!! Form::open(['method' => 'GET', 'action' => 'EmailsController@index']) !!}
    <select name = "customer_id" id="customer_id" class="form-control" onchange="this.form.submit()">
        <!-- This is needed for the placeholder to show up -->
        <option></option>
        @foreach($customers_list as $key => $val)
            <option value="{{ $key }}">{{ $val }}</option>
        @endforeach
    </select>
    {!! Form::close() !!}

    <script>
        $('#customer_id').select2({
            placeholder: 'Choose a customer',
            theme: 'bootstrap'
        });
    </script>
</div>