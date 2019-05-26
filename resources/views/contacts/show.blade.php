@extends('layouts.app')

@section('content')

@section('page_title')
    List of Contacts
@endsection

@section('active_title')
    Contacts
@endsection

<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">List of Contacts</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive governments_rows">
                    <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Title</th>
                        <th>Message content</th>
                        <th class="text-center">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="tr_{{$record->id}}">
                        <td>{{$record->name}}</td>
                        <td>{{$record->email}}</td>
                        <td>{{$record->phone}}</td>
                        <td>{{$record->title}}</td>
                        <td>{{\Illuminate\Support\Str::limit($record->body, 50)}}</td>
                        <td class="text-center">
                            {!! Form::open(['route' => ['contacts.destroy', $record->id], 'method' => 'DELETE']) !!}
                                <button class="btn btn-danger btn-sm" onclick="if (!confirm('Do you want delete?')){ return false} "><i class="fa fa-trash-o"></i></button>
                            {!! Form::close() !!}
                        </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->

@endsection
