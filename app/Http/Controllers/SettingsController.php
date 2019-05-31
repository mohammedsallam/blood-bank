<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::first();
        return view('settings.index', compact('settings'));
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


    public function store(Request $request)
    {


        $rules = [
            'email' => ['required','email', 'regex:/^[a-z0-9.]+@[a-z]+.[a-z]{3,4}$/'],
            'phone' => ['required', 'regex:/^[0-9]{11,14}$/', 'min:11', 'max:14'],
            'google_plus' => ['required'],
            'instagram' => ['required'],
            'facebook' => ['required'],
            'whatsapp' => ['required', 'regex:/^[0-9]{11,14}$/', 'min:11', 'max:14'],
            'about_us' => ['required'],
            'twitter' => ['required'],
            'youtube' => ['required'],
            'terms_conditions' => ['required'],
        ];


        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()){
            return responseJson(0, $validation->messages()->first());
        }

        Setting::create($request->all());
        return responseJson(1, 'Settings added successfully');


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
            'email' => ['required','email', 'regex:/^[a-z0-9.]+@[a-z]+.[a-z]{3,4}$/'],
            'phone' => ['required', 'regex:/^[0-9]{11,14}$/', 'min:11', 'max:14'],
            'google_plus' => ['required'],
            'instagram' => ['required'],
            'facebook' => ['required'],
            'whatsapp' => ['required', 'regex:/^[0-9]{11,14}$/', 'min:11', 'max:14'],
            'about_us' => ['required'],
            'twitter' => ['required'],
            'youtube' => ['required'],
            'terms_conditions' => ['required'],
        ];


        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()){
            return responseJson(0, $validation->messages()->first());
        }

        $settings = Setting::find($id);
        $settings->update($request->all());
        return responseJson(1, 'Settings updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
