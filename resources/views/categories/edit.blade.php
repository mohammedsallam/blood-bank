{!! Form::open(['route' => ['categories.update', $category->id], 'method' => 'PUT', 'class' => 'update_category_form']) !!}
<div class="form-group">
    {!! Form::label('name', 'Name') !!}
    {!! Form::text('name', $category->name, ['class' => 'form-control', 'placeholder' => 'Category name']) !!}
</div>
{!! Form::close() !!}