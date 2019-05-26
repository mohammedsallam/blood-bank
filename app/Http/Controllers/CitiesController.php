<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Government;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CitiesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $records = City::paginate(20);

        return view('cities.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $governments = Government::all();
        return view('cities.create', compact('governments'));
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
            'government_id' => ['required']
        ];

        $messages = [

            'name.required' => 'City name is required',
            'government_id.required' => 'Government name is required'
        ];

        $validation = Validator::make($request->all(),$rules, $messages);

        if ($validation->fails()){
            return responseJson(0, $validation->messages()->first(), $validation->messages());
        }

        City::create($request->all());

        return responseJson(1, 'City created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::findOrFail($id);
        $governments = Government::all();
        return view('cities.edit', compact(['city', 'governments']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = City::findOrFail($id);
        $governments = Government::all();

        return view('cities.edit', compact(['model', 'governments']));
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
            'government_id' => ['required']
        ];

        $messages = [

            'name.required' => 'City name is required',
            'government_id.required' => 'Government name is required'
        ];

        $validation = Validator::make($request->all(),$rules, $messages);

        if ($validation->fails()){
            return responseJson(0, $validation->messages()->first(), $validation->messages());
        }

        $record = City::findOrFail($id);

        $record->update($request->all());

        return responseJson(1, 'City updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = City::findOrFail($id);
        $record->delete();
        return responseJson(1, 'City ' . $record->id .' deleted successfully');
    }
}
