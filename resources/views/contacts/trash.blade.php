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
                            <a href="{{url(route('contacts.index'))}}"><i class="fa fa-envelope text-yellow"></i> Inbox
                                <span class="label label-primary pull-right no_read">{{$contacts->count()}}</span>
                            </a>
                        </li>
                        <li><a href="{{url(route('read'))}}"><i class="fa fa-envelope-open"></i> Read
                                <span class="label label-primary pull-right read">{{$reads->count()}}</span>
                            </a>
                        </li>
                        <li><a href="{{url(route('trash'))}}"><i class="fa fa-trash text-red"></i> Trash
                                <span class="label label-primary pull-right trash">{{$trash->count()}}</span>
                            </a>
                        </li>
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
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                            <i class="fa fa-square-o"></i>
                        </button>
                        <div class="btn-group">
                            <button href="" class="btn btn-default btn-sm shift_delete">
                                <i class="fa fa-trash-o"></i> حذف نهائي
                            </button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    </div>
                    <div class="alert alert-success msg hidden"></div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>
                            {!! Form::open(['route' => 'contacts.delete' , 'method' => 'DELETE', 'class' => 'delete_mail_form']) !!}

                            @if ($trash->count() > 0)
                                @foreach ($trash as $item)
                                    <tr class="tr_{{$item->id}}">
                                        <td>
                                            <input type="checkbox" name="id[]" class="check_delete" value="{{$item->id}}">
                                        </td>
                                        <td><i class="fa fa-envelope-open text-dark mark_as_unread" style="cursor:pointer;" title="Mark as un read" data-id="{{$item->id}}" data-url="{{url(route('contacts.edit', $item->id))}}"></i></td>
                                        <td class="mailbox-name"><a href="{{url(route('contacts.show', $item->id))}}">{{$item->name}}</a></td>
                                        <td class="mailbox-subject"><b><a href="{{url(route('contacts.show', $item->id))}}">{{\Illuminate\Support\Str::limit($item->title, 50)}}</a></b>
                                        </td>
                                        <td class="mailbox-date text-blue"><a href="{{url(route('contacts.show', $item->id))}}"><i class="fa fa-clock-o"></i> {{$item->created_at}}</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center text-red"><i class="fa fa-envelope-open"></i> No Mails in trash</td>
                                </tr>
                            @endif

                            {!! Form::close() !!}
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 text-center">{{$trash->links()}}</div>
                </div>

                <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm shift_delete"><i class="fa fa-trash-o"></i> حذف نهائي</button>
                        </div>
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

