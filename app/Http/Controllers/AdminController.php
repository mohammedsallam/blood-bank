<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

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
            'password' => ['required', 'confirmed'],
        ];


        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()){
            return responseJson(0, $validation->messages()->first());
        }

        $settings = User::find($id);
        $settings->update(['password' => bcrypt($request->password)]);
        return responseJson(1, 'password updated successfully');
    }

    public function forgetPassword()
    {
        return view('auth.passwords.email');
    }

    public function resetPassword(Request $request)
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed'],
        ];


        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()){
            return responseJson(0, $validation->messages()->first());
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->update(['password' => bcrypt($request->password)]);
            return responseJson(1, 'password updated successfully you can login now');
        } else {
            return responseJson(0, 'This email not found');
        }
    }
}
