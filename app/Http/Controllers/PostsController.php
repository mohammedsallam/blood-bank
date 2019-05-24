<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        if ($request->has('category_id')){
            $rules = [
                'search' => ['nullable'],
                'category_id' => ['required'],
            ];

            $messages = [

                'search.required' => 'Search field required',
                'category_id.required' => 'Category name field required'
            ];

            $this->validate($request, $rules, $messages);

            $records = Post::with('category')
            ->where('title', 'LIKE', "%$request->search%")
            ->where('category_id', $request->category_id)
            ->paginate(20);


        } else {

            $records = Post::with('category')->paginate(20);
        }

        return view('posts.index', compact('records'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => ['required'],
            'body' => ['required'],
            'img' => ['image', 'mimes:jpg,jpeg,png'],
            'category_id' => ['required'],
        ];

        $messages = [

            'title.required' => 'Post title required',
            'body.required' => 'Post Content required',
            'category_id.required' => 'Post category required',
        ];

        $validation = Validator::make($request->all(),$rules, $messages);

        if ($validation->fails()){
            return responseJson(0, $validation->messages()->first(), $validation->messages());
        }

        $post = Post::create($request->all());

        if ($request->hasFile('img')){
            $file = $request->file('img');
            $size = $file->getSize();
            $name = $file->getClientOriginalName();
            $newName = Str::random(15) . '_' . time() . '_' . $size . '_' . $name;
            File::deleteDirectory(public_path('images/posts/'.$post->id));
            $file->move(public_path('images/posts/'.$post->id.'/'), $newName);
            $post->img = $newName;
            $post->save();
        }

        return responseJson(1, 'Post Created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('category')->where('id', $id)->first();
        $categories = Category::all();

        if (request()->ajax()){
            return view('posts.get-post', compact(['post', 'categories']));
        } else {
            return view('posts.show', compact(['post', 'categories']));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => ['required'],
            'body' => ['required'],
            'img' => ['image', 'mimes:jpg,jpeg,png'],
            'category_id' => ['required'],
        ];

        $messages = [

            'title.required' => 'Post title required',
            'body.required' => 'Post Content required',
            'category_id.required' => 'Post category required',
        ];

        $validation = Validator::make($request->all(),$rules, $messages);

        if ($validation->fails()){
            return responseJson(0, $validation->messages()->first(), $validation->messages());
        }

        $post = Post::find($id);
        $post->update($request->all());

        if ($request->hasFile('img')){
            $file = $request->file('img');
            $size = $file->getSize();
            $name = $file->getClientOriginalName();
            $newName = Str::random(15) . '_' . time() . '_' . $size . '_' . $name;
            File::deleteDirectory(public_path('images/posts/'.$post->id));
            $file->move(public_path('images/posts/'.$post->id.'/'), $newName);
            $post->img = $newName;
            $post->save();
        }

        return responseJson(1, 'Post update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $post->delete();

        File::deleteDirectory(public_path('images/posts/'.$post->id));

        return responseJson(1, 'Post ' . $post->id . ' deleted successfully');
    }


}
