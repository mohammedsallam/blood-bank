@extends('layouts.app')

@section('content')

@section('page_title')
    Edit city
@endsection

@section('active_title')
    Edit city
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit city</h3>
        </div>
        <div class="panel-body">
            {!! Form::model($model, ['route' => ['cities.update', $model->id], 'method' => 'PUT']) !!}
{{--            {!! Form::hidden('_method', 'PUT') !!}--}}
                @include('cities.form')
            {!! Form::close() !!}
        </div>
    </div>

</section>
<!-- /.content -->

@endsection
