@extends('layouts.app')
@inject('model', "App\Models\City")
@section('content')

@section('page_title')
    Create City
@endsection

@section('active_title')
    Create City
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Create city</h3>
        </div>
        <div class="panel-body">
            {!! Form::model($model, ['route' => ['cities.store']]) !!}
                @include('cities.form')
            {!! Form::close() !!}
        </div>
    </div>

</section>
<!-- /.content -->

@endsection
