@extends('layouts.app')
@inject('governments' , 'App\Models\Government');
@section('content')

@section('page_title')
    List of cities
@endsection

@section('active_title')
    Cities
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">List of cities</h3>
        </div>
        <div class="panel-body">
            <a class="btn btn-primary margin-bottom" data-toggle="modal" data-target="#create_city_modal"><i class="fa fa-plus"></i> Add new city</a>
            <div class="alert alert-success success_delete_msg hidden">
                <strong></strong>
            </div>
            <div class="alert alert-danger error_delete_msg hidden">
                <strong></strong>
            </div>
            <div class="table-responsive governments_rows">
                    <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Government</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($records as $record)
                        <tr class="tr_{{$record->id}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$record->name}}</td>
                            <td>{{$record->government->name}}</td>
                            <td class="text-center"><a class="btn btn-primary btn-sm update_city_link" data-toggle="modal" data-target="#update_city_modal" data-href="{{url(route('cities.show', $record->id))}}"><i class="fa fa-edit"></i></a></td>
                            <td class="text-center">
                                {!! Form::open(['route' => ['cities.destroy', $record->id], 'method' => 'DELETE', 'class' => 'delete_city_form']) !!}
                                    <button class="btn btn-danger btn-sm delete_city_button" id="{{$record->id}}"><i class="fa fa-trash-o"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{$records->links()}}
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->

@endsection


<div class="modal fade create_city_modal" id="create_city_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create city</h4>
            </div>
            <div class="alert alert-success success_msg hidden">
                <strong></strong>
            </div>
            <div class="alert alert-danger error_msg hidden">
                <strong></strong>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'cities.store', 'class' => 'create_city_form']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'City name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'City name']) !!}
                </div>
                <div class="form-group">
                    <label for="government_id">Government name</label>
                    <select name="government_id" id="government_id" class="form-control">
                        <option value="">Government name</option>
                        @foreach ($governments->all() as $government)
                            {{--<option value="{{$government->id}}" @if($government->id == $model->government_id) selected @endif>{{$government->name}}</option>--}}
                            <option value="{{$government->id}}">{{$government->name}}</option>
                        @endforeach
                    </select>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary create_city_button">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade update_city_modal" id="update_city_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update city</h4>
            </div>
            <div class="alert alert-success success_msg hidden">
                <strong></strong>
            </div>
            <div class="alert alert-danger error_msg hidden">
                <strong></strong>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_city_button">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->