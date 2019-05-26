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
    <div class="row">

        <div class="col-md-3">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Go to</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding" style="">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="active">
                            <a href="{{url(route('contacts.index'))}}"><i class="fa fa fa-envelope text-yellow"></i> Inbox
                                <span class="label label-primary pull-right no_read">{{$contacts->count()}}</span>
                            </a>
                        </li>
                        <li><a href="{{url(route('read'))}}"><i class="fa fa-envelope-open"></i> Read
                                <span class="label label-primary pull-right read">{{$reads->count()}}</span>
                            </a>
                        </li>
                        <li><a href="{{url(route('trash'))}}"><i class="fa fa-trash text-red"></i> Trash</a></li>
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Inbox</h3>

                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input type="text" class="form-control input-sm" placeholder="Search Mail">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                    <div class="mailbox-controls">
                        <!-- Check all button -->
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                            @if ($reads->count() > 0)
                                @foreach ($reads as $read)
                                    <tr class="tr_{{$read->id}}">
                                        <td><input type="checkbox"></td>
                                        <td><i class="fa fa-envelope-open text-dark mark_as_unread" style="cursor:pointer;" title="Mark as un read" data-id="{{$read->id}}" data-url="{{url(route('contacts.edit', $read->id))}}"></i></td>
                                        <td class="mailbox-name"><a href="{{url(route('contacts.show', $read->id))}}">{{$read->name}}</a></td>
                                        <td class="mailbox-subject"><b><a href="{{url(route('contacts.show', $read->id))}}">{{\Illuminate\Support\Str::limit($read->title, 50)}}</a></b>
                                        </td>
                                        <td class="mailbox-date text-blue"><a href="{{url(route('contacts.show', $read->id))}}"><i class="fa fa-clock-o"></i> {{$read->created_at}}</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center text-red"><i class="fa fa-envelope-open"></i> No Mails is read</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 text-center">{{$reads->links()}}</div>
                </div>

                <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                        </div>
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{--<div class="panel panel-default col-lg-9">--}}
    {{--<div class="panel-heading">--}}
    {{--<h3 class="panel-title">List of Contacts</h3>--}}
    {{--</div>--}}
    {{--<div class="panel-body">--}}
    {{--<div class="table-responsive governments_rows">--}}
    {{--<table class="table table-hover table-bordered">--}}
    {{--<thead>--}}
    {{--<tr>--}}
    {{--<th>#</th>--}}
    {{--<th>Name</th>--}}
    {{--<th>Email</th>--}}
    {{--<th>Phone</th>--}}
    {{--<th>Title</th>--}}
    {{--<th>Message content</th>--}}
    {{--<th class="text-center">Delete</th>--}}
    {{--<th class="text-center">Read</th>--}}
    {{--<th class="text-center">Mark as read</th>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach ($reads as $read)--}}
    {{--<tr class="tr_{{$read->id}}">--}}
    {{--<td>{{$loop->iteration}}</td>--}}
    {{--<td>{{$read->name}}</td>--}}
    {{--<td>{{$read->email}}</td>--}}
    {{--<td>{{$read->phone}}</td>--}}
    {{--<td>{{$read->title}}</td>--}}
    {{--<td>{{\Illuminate\Support\Str::limit($read->body, 50)}}</td>--}}
    {{--<td class="text-center">--}}
    {{--{!! Form::open(['route' => ['contacts.destroy', $read->id], 'method' => 'DELETE']) !!}--}}
    {{--<button class="btn btn-danger btn-sm" onclick="if (!confirm('Do you want delete?')){ return false} "><i class="fa fa-trash-o"></i></button>--}}
    {{--{!! Form::close() !!}--}}
    {{--</td>--}}
    {{--<td class="text-center">--}}
    {{--<a class="btn btn-primary btn-sm" href="{{url(route('contacts.show', $read->id))}}"><i class="fa fa-angle-double-right"></i></a>--}}
    {{--</td>--}}
    {{--<td class="text-center">--}}
    {{--<a class="btn btn-primary btn-sm" href="{{url(route('contacts.edit', $read->id))}}"><i class="fa fa-eye"></i></a>--}}
    {{--</td>--}}
    {{--</tr>--}}

    {{--@endforeach--}}
    {{--</tbody>--}}
    {{--</table>--}}
    {{--<div class="text-center">--}}
    {{--{{$contacts->links()}}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
</section>
<!-- /.content -->

@endsection

