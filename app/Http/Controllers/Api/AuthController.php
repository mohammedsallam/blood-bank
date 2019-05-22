<?php

namespace App\Http\Controllers\Api;

use App\Mail\ResetPasswordMail;
use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Client;

class AuthController extends Controller
{
    /**
     * Register for clients
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[

            'name' => 'required|min:3',
            'email' => 'required|unique:clients',
            'phone' => 'required|min:11|max:14',
            'password' => 'required|confirmed',
            'birth_date' => 'required',
            'city_id' => 'required',
            'blood_type_id' => 'required',

        ]);

        if ($validation->fails()){
            return responseJson(0, $validation->messages(), $validation->messages());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);
        $client->save();
        return responseJson(1, 'تم الإضافة بنجاح', [
            'api_token' => $client->api_token,
            'client' => $client
        ]);

    }

    /**
     * Login for clients
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => ['required', 'min:11', 'max:14', 'regex:/^[0-9]{11,14}$/'],
            'password' => ['required']
        ]);

        if ($validation->fails()){
            return responseJson(0, $validation->messages(), $validation->messages());
        }

        $client = Client::where('phone', $request->phone)->first();

//        $remember = request('remember') == 1 ? true : false;
//        $credential = ['phone' => $request->phone, 'password' => $request->password];
//        $attempt = auth()->guard('client')->attempt($credential, $remember);

        if ($client){
            if (Hash::check($request->password, $client->password)){
                return responseJson(1,'تم تسجيل الدخول بنجاح', [
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            } else {
                return responseJson(1,'بيانات الدخول غير صحيحة');
            }
        } else {
            return responseJson(1,'بيانات الدخول غير صحيحة');
        }
    }


    /**
     * Reset password by phone
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'phone' => 'required',
        ]);

        if ($validation->fails()){
            return responseJson(0, $validation->messages(), $validation->messages());
        }

        $client = Client::where('phone', $request->phone)->first();


        if ($client){
            $code = rand(1111,9999);
            $client->update(['code' => $code]);
//            smsMisr($client->phone, 'Your rest code is: '.$code);
            Mail::to($client->email)->send(new ResetPasswordMail($client));
            return responseJson(0, 'we recent send code to your email Please check your email');

        } else {
            return responseJson(0, 'This credentials not found');
        }

    }

    /**
     * New password
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function newPassword(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'code' => 'required|min:4',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validation->fails()){
            return responseJson(0, $validation->messages());
        }

        $client = Client::where('code', $request->code)->first();

        if ($client){

            $hashPassword = bcrypt($request->password);
            $client->update(['code' => null, 'password' => $hashPassword]);
            return responseJson(0, 'Password reset successfully');

        } else {
            return responseJson(0, 'This code not valid');
        }
    }

    /**
     * Update client profile
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        $user = auth('client')->user();

        $validation = Validator::make($request->all(),[

            'name' => ['required', 'string', 'min:3'],
            'phone' => ['required', Rule::unique('clients', 'phone')->ignore($user->id), 'regex:/^[0-9]{11,14}$/', 'min:11', 'max:14'],
            'email' => ['required','email', Rule::unique('clients', 'email')->ignore($user->id), 'regex:/^[a-z0-9.]+@[a-z]+.[a-z]{3,4}$/'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'birth_date' => 'required',
            'government_id' => 'required',
            'city_id' => 'required',
            'blood_type_id' => 'required',

        ]);

        if ($validation->fails()){
            return responseJson(0, $validation->messages());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::find($user->id);

        if ($client){

            $client->update($request->all());
            $client->save();
        }
        return responseJson(1, 'تم التعديل بنجاح', [
            'api_token' => $client->api_token,
            'client' => $client
        ]);
    }


    /**
     * Register device firebase token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerToken(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'token' => ['required'],
            'type' => ['required', 'in:android,ios']
        ]);

        if ($validation->fails()){
            return responseJson(0, $validation->messages(), $validation->messages());
        }

        Token::where('token', $request->token)->delete();

        $request->user()->tokens()->create($request->all());

        return responseJson(1,'تم التسجيل بنجاح');


    }

    /**
     * Remove device firebase token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeToken(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'token' => ['required'],
        ]);

        if ($validation->fails()){
            return responseJson(0, $validation->messages(), $validation->messages());
        }
        Token::where('token', $request->token)->delete();

        return responseJson(1,'تم الحذف بنجاح');


    }

    /**
     * Admin login
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function adminLogin(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => ['required', 'email', 'regex:/^[a-z0-9.]+@[a-z]+.[a-z]{3,4}$/'],
            'password' => ['required']
        ]);

        if ($validation->fails()){
            return responseJson(0, $validation->messages(), $validation->messages());
        }


        $remember = request('remember') == 1 ? true : false;
        $credential = ['email' => $request->email, 'password' => $request->password];
        $attempt = auth()->guard()->attempt($credential, $remember);

        if ($attempt){
            $admin = auth()->user();
            $admin->api_token = Str::random(60);
            $admin->save();
            return responseJson(1,'تم تسجيل الدخول بنجاح', [
                'api_token' => $admin->api_token,
                'admin' => $admin
            ]);
        } else {
            return responseJson(1,'بيانات الدخول غير صحيحة');
        }
    }

    /**
     *Update admin profile
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
//    public function adminProfile(Request $request)
//    {
//        $user = auth()->user();
//
//        $validation = Validator::make($request->all(),[
//
//            'name' => ['required', 'string', 'min:3'],
//            'email' => ['required','email', Rule::unique('users', 'email')->ignore($user->id), 'regex:/^[a-z0-9.]+@[a-z]+.[a-z]{3,4}$/'],
//            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
//
//        ]);
//
//        if ($validation->fails()){
//            return responseJson(0, $validation->messages());
//        }
//
//        $request->merge(['password' => bcrypt($request->password)]);
//        $user = User::find($user->id);
//
//        if ($user){
//
//            $user->update($request->all());
//            $user->save();
//        }
//        return responseJson(1, 'تم التعديل بنجاح', [
//            'api_token' => $user->api_token,
//            'client' => $user
//        ]);
//    }

}
