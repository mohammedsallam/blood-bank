@extends('layouts.app')
@inject('model', "App\Models\Government")
@section('content')

@section('page_title')
    Edit governments
@endsection

@section('active_title')
    Edit governments
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit governments</h3>
        </div>
        <div class="panel-body">
            {!! Form::model($model, ['route' => ['governments.store']]) !!}
                @include('governments.form')
            {!! Form::close() !!}
        </div>
    </div>

</section>
<!-- /.content -->

@endsection
