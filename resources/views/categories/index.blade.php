@extends('layouts.app')

@section('content')

@section('page_title')
    List of categories
@endsection

@section('active_title')
    Categories
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">List of Categories</h3>
        </div>
        <div class="panel-body">
            <a class="btn btn-primary margin-bottom" data-toggle="modal" data-target="#create_category_modal"><i class="fa fa-plus"></i> Add new category</a>
            <div class="table-responsive governments_rows">
                <div class="alert alert-success success_delete_msg hidden">
                    <strong></strong>
                </div>
                <div class="alert alert-danger error_delete_msg hidden">
                    <strong></strong>
                </div>
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
                            <td class="text-center"><a class="btn btn-primary btn-sm update_category_link" data-toggle="modal" data-target="#update_category_modal" data-href="{{url(route('categories.show', $record->id))}}"><i class="fa fa-edit"></i></a></td>
                            <td class="text-center">
                                {!! Form::open(['route' => ['categories.destroy', $record->id], 'method' => 'DELETE', 'class' => 'delete_category_form']) !!}
                                    <button class="btn btn-danger btn-sm delete_category_button" id="{{$record->id}}"><i class="fa fa-trash-o"></i></button>
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


<div class="modal fade" id="create_category_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Create category</h4>
            </div>
            <div class="alert alert-success success_msg hidden">
                <strong></strong>
            </div>
            <div class="alert alert-danger error_msg hidden">
                <strong></strong>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'categories.store', 'class' => 'create_category_form']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Category name']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary create_category_button">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade update_category_modal" id="update_category_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Update category</h4>
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
                <button type="button" class="btn btn-primary update_category_button">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
