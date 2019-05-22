@extends('layouts.app')

@section('content')

@section('page_title')
    Create governments
@endsection

@section('active_title')
    Create governments
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Create governments</h3>
        </div>
        <div class="panel-body">
            {!! Form::model($model, ['route' => ['governments.update', $model->id], 'method' => 'PUT']) !!}
{{--            {!! Form::hidden('_method', 'PUT') !!}--}}
                @include('governments.form')
            {!! Form::close() !!}
        </div>
    </div>

</section>
<!-- /.content -->

@endsection
