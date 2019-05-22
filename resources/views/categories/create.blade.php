@extends('layouts.app')
@inject('model', "App\Models\Government")
@section('content')

@section('page_title')
    Create categories
@endsection

@section('active_title')
    Create categories
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Create categories</h3>
        </div>
        <div class="panel-body">
            {!! Form::model($model, ['route' => ['categories.store']]) !!}
                @include('categories.form')
            {!! Form::close() !!}
        </div>
    </div>

</section>
<!-- /.content -->

@endsection
