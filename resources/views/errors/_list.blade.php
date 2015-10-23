@if ($errors->any())
<div class="container">
    <ul class="alert alert-danger">
        <div class="container">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    </ul>
</div>
@endif
