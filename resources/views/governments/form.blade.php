<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', $model->name, ['class' => 'form-control', 'placeholder' => 'Government name']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Save government', ['class' => 'btn btn-primary btn-sm']) !!}
</div>