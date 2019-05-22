<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $records = Category::paginate(20);

        return view('categories.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required'],
        ];

        $messages = [

            'name.required' => 'Category name is required'
        ];

        $this->validate($request, $rules, $messages);

        Category::create($request->all());

        return redirect(route('categories.index'))->with('success', 'Category added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Category::findOrFail($id);

        return view('categories.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param $id
     * @return $this
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => ['required'],
        ];

        $messages = [

            'name.required' => 'Category name is required'
        ];

        $this->validate($request, $rules, $messages);

        $record = Category::findOrFail($id);

        $record->update($request->all());

        return redirect(route('categories.index'))->with('success', 'Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Category::findOrFail($id);
        $record->delete();
        return redirect(route('categories.index'))->with('success', 'category deleted successfully');
    }
}
