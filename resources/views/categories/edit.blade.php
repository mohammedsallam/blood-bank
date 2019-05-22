@extends('layouts.app')

@section('content')

@section('page_title')
    Edit category
@endsection

@section('active_title')
    Edit category
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit category</h3>
        </div>
        <div class="panel-body">
            {!! Form::model($model, ['route' => ['categories.update', $model->id], 'method' => 'PUT']) !!}
{{--            {!! Form::hidden('_method', 'PUT') !!}--}}
                @include('categories.form')
            {!! Form::close() !!}
        </div>
    </div>

</section>
<!-- /.content -->

@endsection
