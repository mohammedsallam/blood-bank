<div class="form-group">
    {!! Form::label('name', 'City name') !!}
    {!! Form::text('name', $model->name, ['class' => 'form-control', 'placeholder' => 'City name']) !!}
</div>
<div class="form-group">
    <label for="government_id">Government name</label>
    <select name="government_id" id="government_id" class="form-control">
        <option value="">Government name</option>
        @foreach ($governments as $government)
            <option value="{{$government->id}}" @if($government->id == $model->government_id) selected @endif>{{$government->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    {!! Form::submit('Save city', ['class' => 'btn btn-primary btn-sm']) !!}
</div>