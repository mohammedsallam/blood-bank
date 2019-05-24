<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        if ($request->has('search')){
            $rules = [

                'search' => ['required'],
                'government' => ['nullable'],
                'city' => ['nullable'],
                'blood' => ['nullable'],
            ];


            $this->validate($request, $rules);

            $records = Client::whereHas('government', function($query) use ($request){
                $query->where('governments.name', 'LIKE', "%$request->government%");
            })

                ->whereHas('city', function($query) use ($request){
                    $query->where('cities.name', 'LIKE', "%$request->city%");
                })
                ->whereHas('bloodType', function($query) use ($request){
                    $query->where('blood_types.name', 'LIKE', "%$request->blood%");
                })
                ->where('name','LIKE', "%$request->search%")
                ->orWhere('phone', 'LIKE', "%$request->search%")
                ->orWhere('email', 'LIKE', "%$request->search%")
                ->paginate(20);

        } else {

            $records = Client::paginate(20);
        }

        return view('clients.index', compact('records'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Client::findOrFail($id);

        return view('clients.show', compact('record'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Client::findOrFail($id);

        if($model->active == 1){

            $model->active = 0;
        } else {
            $model->active = 1;
        }

        $model->save();

        return redirect(route('clients.index'))->with('success', 'Client updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        $record->delete();
        return redirect(route('clients.index'))->with('success', 'Client deleted successfully');
    }


}
