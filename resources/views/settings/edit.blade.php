{!! Form::open(['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => true, 'class' => 'update_post_form']) !!}
    <div class="form-group">
        {!! Form::label('title', 'Post title', ['class' => 'control-label']) !!}
        {!! Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Post title']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body', 'Post body', ['class' => 'control-label']) !!}
        {!! Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Post body']) !!}
    </div>
    <div class="form-group">
        <select name="category_id" class="form-control">
            <option value="">Choose category</option>
            @foreach ($categories as $category)
                <option @if ($category->id == $post->category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group" style="position: relative;">
        <label for="img" class="btn btn-primary btn-sm"><i class="fa fa-camera"></i> Choose image</label>
        {!! Form::file('img', ['class' => 'hidden img', 'id' => 'img']) !!}
        <span class="btn btn-danger btn-sm delete_img"><i class="fa fa-close"></i> Delete image</span>
    </div>
    <div class="img_content">
        <img style="max-width: 100px" src="{{asset('images/posts/'.$post->id.'/'.$post->img)}}" alt="">
    </div>

{!! Form::close() !!}