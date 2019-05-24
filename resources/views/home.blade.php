@extends('layouts.app')

@inject('clients', 'App\Models\Client')
@inject('governments', 'App\Models\Government')
@inject('cities', 'App\Models\City')
@inject('categories', 'App\Models\Category')
@inject('posts', 'App\Models\Post')
@inject('orders', 'App\Models\Order')

@section('content')

    @section('page_title')
        Dashboard
    @endsection

    @section('active_title')
        Dashboard
    @endsection

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">clients</span>
                    <span class="info-box-number">{{$clients->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Governments</span>
                    <span class="info-box-number">{{$governments->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-line-chart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Cities</span>
                    <span class="info-box-number">{{$cities->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Categories</span>
                    <span class="info-box-number">{{$categories->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-line-chart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Posts</span>
                    <span class="info-box-number">{{$posts->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-line-chart"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">donations</span>
                    <span class="info-box-number">{{$orders->count()}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
</div>

@endsection
