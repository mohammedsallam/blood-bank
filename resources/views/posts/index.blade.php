@extends('layouts.app')
@inject('posts', 'App\Models\Post')
@inject('categories', 'App\Models\Category')
@section('content')

@section('page_title')
    List of posts
@endsection

@section('active_title')
    Posts
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
        <div class="box-body">
            {{-- Start search--}}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <h4 class="text-bold">Search in :<small class="text-red"> <b>Categories ( Required )</b></small></h4>
                    </h3>
                </div>
                <div class="panel-body">

                    {!! Form::model($posts, ['route' => ['posts.index'], 'method' => 'get']) !!}

                    <div class="form-group">
                        <select name="category_id" class="form-control">
                            <option value="">Chose Category</option>
                            @foreach ($categories->all() as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <h4 class="text-bold">Search in : <small><b class="text-blue">title ( Optional )</b></small></h4>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'title, or any words within post']) !!}
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
            <h3 class="box-title">List of posts</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body" style="">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">List of posts</h3>
                </div>

                <div class="panel-body">
                    <a class="btn btn-primary margin-bottom" data-toggle="modal" data-target="#create_posts_modal" href=""><i class="fa fa-plus"></i> Create new post</a>
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
                                <th>Title</th>
                                <th>Content</th>
                                <th>image</th>
                                <th>Category</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                                <th class="text-center">More</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($records as $record)
                                <tr class="tr_{{$record->id}}">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$record->title}}</td>
                                    <td>{{\Illuminate\Support\Str::limit($record->body, 60)}}</td>
                                    <td class="text-center"><img style="max-width: 100px" src="{{asset('images/posts/'.$record->id.'/'.$record->img)}}" alt=""></td>
                                    <td>{{$record->category->name}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-primary btn-sm posts_model_link" data-toggle="modal" data-target="#update_posts_modal" data-href="{{url(route('posts.show', $record->id))}}"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td class="text-center">
                                        {!! Form::open(['route' => ['posts.destroy', $record->id], 'method' => 'DELETE', 'class' => 'delete_post_form']) !!}
                                        <button class="btn btn-danger btn-sm delete_post_button" id="{{$record->id}}"><i class="fa fa-trash-o"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                    <td class="text-center"><a class="btn btn-primary btn-sm" href="{{url(route('posts.show', $record->id))}}"><i class="fa fa-angle-double-right"></i></a></td>
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

{{-- Start update post modal --}}
<div class="modal fade update_posts_modal" id="update_posts_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update post</h4>
            </div>
            <div class="alert alert-danger error_msg hidden">
                <strong>....</strong>
            </div>
            <div class="alert alert-success success_msg hidden">
                <strong>....</strong>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary update_post_button">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{-- End update post modal --}}

{{-- Start create post modal --}}
<div class="modal fade create_posts_modal" id="create_posts_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create post</h4>
            </div>
            <div class="alert alert-danger error_msg hidden">
                <strong>....</strong>
            </div>
            <div class="alert alert-success success_msg hidden">
                <strong>....</strong>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'posts.store', 'method' => 'POST', 'files' => true, 'class' => 'create_post_form']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'Post title', ['class' => 'control-label']) !!}
                    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Post title']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('body', 'Post body', ['class' => 'control-label']) !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Post body']) !!}
                </div>
                <div class="form-group">
                    <select name="category_id" class="form-control">
                        <option value="">Choose category</option>
                        @foreach ($categories->all() as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="position: relative;">
                    <label for="img" class="btn btn-primary btn-sm"><i class="fa fa-camera"></i> Choose image</label>
                    {!! Form::file('img', ['class' => 'hidden img', 'id' => 'img']) !!}
                    <span class="btn btn-danger btn-sm delete_img"><i class="fa fa-close"></i> Delete image</span>
                </div>

                <div class="img_content"></div>

                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary create_post_button">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- End create post modal --}}