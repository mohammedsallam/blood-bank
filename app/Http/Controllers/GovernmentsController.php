<?php

namespace App\Http\Controllers;

use App\Models\Government;
use Illuminate\Http\Request;

class GovernmentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Government::paginate(20);

        return view('governments.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('governments.create');
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
            'name' => ['required']
        ];

        $messages = [

            'name.required' => 'Government name is required'
        ];

        $this->validate($request, $rules, $messages);

        Government::create($request->all());

        return redirect(route('governments.index'))->with('success', 'Government added successfully');

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
        $model = Government::findOrFail($id);

        return view('governments.edit', compact('model'));
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
            'name' => ['required']
        ];

        $messages = [

            'name.required' => 'Government name is required'
        ];

        $this->validate($request, $rules, $messages);

        $record = Government::findOrFail($id);

        $record->update($request->all());

        return redirect(route('governments.index'))->with('success', 'Government updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Government::findOrFail($id);
        $record->delete();
        return redirect(route('governments.index'))->with('success', 'Government deleted successfully');
    }
}
