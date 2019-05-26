@extends('layouts.app')
@inject('client', "App\Models\Client")
@inject('governments', "App\Models\Government")
@inject('cities', "App\Models\City")
@inject('bloods', "App\Models\BloodType")

@section('content')

@section('page_title')
    List of clients
@endsection

@section('active_title')
    Clients
@endsection

<!-- Main content -->
<section class="content">

    @include('partials.messages')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Search options</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body" style="">
            {{-- Start search--}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <h4 class="text-bold">Search in :<small class="text-blue"> <b>Government, City, or blood type ( Optional )</b></small></h4>
                    </h3>
                </div>
                <div class="panel-body">

                    {!! Form::model($client, ['route' => ['clients.index'], 'method' => 'get']) !!}

                    <div class="form-group">
                        <select name="government" class="form-control">
                            <option value="">Chose government</option>
                            @foreach ($governments->all() as $government)
                                <option value="{{$government->name}}">{{$government->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="city" class="form-control">
                            <option value="">Chose City</option>
                            @foreach ($cities->all() as $city)
                                <option value="{{$city->name}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="blood" class="form-control">
                            <option value="">Chose Blood type</option>
                            @foreach ($bloods->all() as $blood)
                                <option value="{{$blood->name}}">{{$blood->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <h4 class="text-bold">Search in : <small><b class="text-red">name, email, or phone ( Required * )</b></small></h4>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'name, email, or phone']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Search', ['class' => 'btn btn-primary btn-sm']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            {{-- End search --}}
        </div>
        <!-- /.box-body -->
    </div>

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List of clients</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body" style="">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">List of Clients</h3>
                </div>
                <div class="panel-body">
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
                                <th class="text-center">Active</th>
                                <th class="text-center">Delete</th>
                                <th class="text-center">More</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($records as $record)
                                <tr class="tr_{{$record->id}}">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->name}}</td>
                                    <td class="text-center"><a class="btn btn-<?php if($record->active == 1) {echo 'success'; } else {echo 'warning'; } ?> btn-sm active_client_link" href="{{url(route('clients.edit', $record->id))}}"><i class="fa fa-<?php if($record->active == 1) {echo 'check'; } else {echo 'close'; } ?>"></i></a></td>
                                    <td class="text-center">
                                        {!! Form::open(['route' => ['clients.destroy', $record->id], 'method' => 'DELETE', 'class' => 'delete_client_form']) !!}
                                        <button class="btn btn-danger btn-sm delete_client_button" id="{{$record->id}}"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                    <td class="text-center"><a class="btn btn-primary btn-sm" href="{{url(route('clients.show', $record->id))}}"><i class="fa fa-angle-double-right"></i></a></td>
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
        </div>
        <!-- /.box-body -->
    </div>

</section>
<!-- /.content -->

@endsection
