@extends('layouts.app')
@inject('client', "App\Models\Client")
@inject('governments', "App\Models\Government")
@inject('cities', "App\Models\City")
@inject('bloods', "App\Models\BloodType")
@section('content')

@section('page_title')
    Search results
@endsection

@section('active_title')
    Search results
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')

    {{-- Start search--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Search in clients
            </h3>
        </div>
        <div class="panel-body">
            {!! Form::model($client, ['action' => ['ClientsController@search'], 'method' => 'post']) !!}

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
            <hr>
            <h4>Search in <small><b>name, email, or phone</b></small></h4>
            <div class="form-group">
                {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Search in clients']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Search', ['class' => 'btn btn-primary btn-sm']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    {{-- End search --}}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">List of Clients</h3>
        </div>
        <div class="panel-body">
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
                    @foreach ($searches as $search)
                        <tr class="tr_{{$search->id}}">
                            <td>{{$loop->iteration}}</td>
                            <td>{{$search->name}}</td>
                            <td class="text-center"><a class="btn btn-<?php if($search->active == 1) {echo 'success'; } else {echo 'warning'; } ?> btn-sm" href="{{url(route('clients.edit', $search->id))}}"><i class="fa fa-<?php if($search->active == 1) {echo 'check'; } else {echo 'close'; } ?>"></i></a></td>
                            <td class="text-center">
                                {!! Form::open(['route' => ['clients.destroy', $search->id], 'method' => 'DELETE']) !!}
                                    <button class="btn btn-danger btn-sm" onclick="if (!confirm('Do you want delete?')){ return false} "><i class="fa fa-trash-o"></i></button>
                                {!! Form::close() !!}
                            </td>
                            <td class="text-center"><a class="btn btn-primary btn-sm" href="{{url(route('clients.show', $search->id))}}"><i class="fa fa-angle-double-right"></i></a></td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{$searches->links()}}
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->

@endsection
