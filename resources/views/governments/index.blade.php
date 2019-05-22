@extends('layouts.app')

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
            <a class="btn btn-primary margin-bottom" href="{{url(route('governments.create'))}}"><i class="fa fa-plus"></i> Add new government</a>
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
                            <td class="text-center"><a class="btn btn-primary btn-sm" href="{{url(route('governments.edit', $record->id))}}"><i class="fa fa-edit"></i></a></td>
                            <td class="text-center">
                                {!! Form::open(['route' => ['governments.destroy', $record->id], 'method' => 'DELETE']) !!}
                                    <button class="btn btn-danger btn-sm" onclick="if (!confirm('Do you want delete?')){ return false} "><i class="fa fa-trash-o"></i></button>
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
