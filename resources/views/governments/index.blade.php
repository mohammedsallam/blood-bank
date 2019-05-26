@extends('layouts.app')
@inject('model', 'App\Models\Government');
@section('content')

@section('page_title')
    List of governments
@endsection

@section('active_title')
    Governments
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">List of governments</h3>
        </div>
        <div class="panel-body">
            <a data-toggle="modal" data-target="#create_government_modal" class="btn btn-primary margin-bottom"><i class="fa fa-plus"></i> Add new government</a>
            <div class="alert alert-success success_delete_msg hidden">
                <strong></strong>
            </div>
            <div class="alert alert-success error_delete_msg hidden">
                <strong></strong>
            </div>
            <div class="table-responsive governments_rows">
                    <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($records as $record)
                        <tr class="tr_{{$record->id}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$record->name}}</td>
                            <td class="text-center"><a data-toggle="modal" data-target="#update_government_modal" class="btn btn-primary btn-sm update_government_link" data-href="{{url(route('governments.show', $record->id))}}"><i class="fa fa-edit"></i></a></td>
                            <td class="text-center">
                                {!! Form::open(['route' => ['governments.destroy', $record->id], 'method' => 'DELETE', 'class' => 'delete_government_form']) !!}
                                    <button class="btn btn-danger btn-sm delete_government_button" id="{{$record->id}}"><i class="fa fa-trash-o"></i></button>
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

<div class="modal fade create_government_modal" id="create_government_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create government</h4>
            </div>
            <div class="alert alert-success success_msg hidden">
                <strong></strong>
            </div>
            <div class="alert alert-danger error_msg hidden">
                <strong></strong>
            </div>
            <div class="modal-body">
                {!! Form::model($model, ['route' => 'governments.store', 'class' => 'create_government_form']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Government name :') !!}
                    {!! Form::text('name', $model->name, ['class' => 'form-control', 'placeholder' => 'Government name']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary create_government_button">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade update_government_modal" id="update_government_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update government</h4>
            </div>
            <div class="alert alert-success success_msg hidden">
                <strong></strong>
            </div>
            <div class="alert alert-danger error_msg hidden">
                <strong></strong>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_government_button">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
