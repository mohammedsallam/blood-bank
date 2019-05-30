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
                            <button  class="btn btn-default btn-sm delete_all_button"><i class="fa fa-trash-o"></i></button>
                        </div>
                        <!-- /.btn-group -->
                        <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    </div>
                    <div class="alert alert-success msg hidden"></div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table table-hover table-striped">
                            <tbody>

                                {!! Form::open(['route' => 'contacts.delete' , 'method' => 'DELETE', 'class' => 'delete_mail_form']) !!}
                                @if ($contacts->count() > 0)
                                @foreach ($contacts as $contact)
                                    <tr class="tr_{{$contact->id}}">
                                        <td>
                                            <input type="checkbox" name="id[]" class="check_delete" value="{{$contact->id}}">
                                        </td>
                                        <td><i class="fa fa-envelope text-yellow mark_as_read" style="cursor:pointer;" title="Mark as read" data-id="{{$contact->id}}" data-url="{{url(route('contacts.edit', $contact->id))}}"></i></td>
                                        <td class="mailbox-name"><a href="{{url(route('contacts.show', $contact->id))}}">{{$contact->name}}</a></td>
                                        <td class="mailbox-subject"><b><a href="{{url(route('contacts.show', $contact->id))}}">{{\Illuminate\Support\Str::limit($contact->title, 50)}}</a></b>
                                        </td>
                                        <td class="mailbox-date text-blue"><a href="{{url(route('contacts.show', $contact->id))}}"><i class="fa fa-clock-o"></i> {{$contact->created_at}}</a></td>
                                    </tr>
                                @endforeach

                                @else
                                <tr>
                                    <td class="text-center text-red"><i class="fa fa-envelope-open"></i> No Mails In Mailbox</td>
                                </tr>

                                 @endif

                                {!! Form::close() !!}
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-12 text-center">{{$contacts->links()}}</div>
                </div>

                <div class="box-footer no-padding">
                    <div class="mailbox-controls">
                        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm delete_all_button"><i class="fa fa-trash-o"></i></button>
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

