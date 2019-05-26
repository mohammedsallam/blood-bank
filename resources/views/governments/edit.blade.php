{!! Form::open(['route' => ['governments.update', $government->id], 'class' => 'update_government_form', 'method' => 'PUT']) !!}
<div class="form-group">
    {!! Form::label('name', 'Government name :') !!}
    {!! Form::text('name', $government->name, ['class' => 'form-control', 'placeholder' => 'Government name']) !!}
</div>
{!! Form::close() !!}
