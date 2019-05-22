<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', $model->name, ['class' => 'form-control', 'placeholder' => 'Category name']) !!}
</div>
<div class="form-group">
    {!! Form::submit('Save category', ['class' => 'btn btn-primary btn-sm']) !!}
</div>