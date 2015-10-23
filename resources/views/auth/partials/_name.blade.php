<div class="form-group">
    {!! Form::label('name', 'Name:', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8 text-center">
        {!! Form::input('text', 'name', old('name') , ['class' => 'form-control']) !!}
    </div>
</div>