@extends('layouts.app')
@section('content')

@section('page_title')
    Show post details
@endsection

@section('active_title')
    Show post details
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Post details</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>Post title</th>
                    <td>{{$post->title}}</td>
                </tr>
                <tr>
                    <th>Post content</th>
                    <td>{{$post->body}}</td>
                </tr>
                <tr>
                    <th>Post category</th>
                    <td>{{$post->category->id}}</td>
                </tr>
                <tr>
                    <th>Post image</th>
                    <td>
                        <img style="max-width: 100px" src="{{asset('images/posts/'.$post->id.'/'.$post->img)}}" alt="">
                    </td>
                </tr>
                <tr>
                    <th>Created at</th>
                    <td>{{$post->created_at}}</td>
                </tr>
                <tr>
                    <th>Updated at</th>
                    <td>{{$post->updated_at}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</section>
<!-- /.content -->

@endsection
