<?php

namespace App\Http\Controllers\Api;

use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\Government;
use App\Models\Order;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class MainController extends Controller
{
    /**
     * List all governments
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function governments()
    {
        $governments = Government::all();

        return responseJson(1, 'success', $governments);
    }

    /**
     * List all cities
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cities(Request $request)
    {
//        if ($request->has('government_id')) {
//            $cities = City::where('government_id', $request->government_id)->get();
//        } else {
//            $cities = City::all();
//        }

        $cities = City::where(function ($query) use($request) {
            if ($request->has('government_id')){
                $query->where('government_id', $request->government_id);
            }
        })->get();

        return responseJson(1, 'success', $cities);
    }

    /**
     * List all categories
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories()
    {
        $cats = Category::all();

        return responseJson(1, 'success', $cats);
    }

    /**
     * List all posts and posts with favorite
     * @return \Illuminate\Http\JsonResponse
     */
    public function posts()
    {

        $posts = Post::with('category')->get();
        return responseJson(1, 'success', ['posts' => $posts]);
    }

    /**
     * List blood type when client auth or not
     * @return \Illuminate\Http\JsonResponse
     */
    public function bloodTypes()
    {
        $client = auth('client')->user();

        if ($client){
            $bloodTypes = $client->bloodTypes()->get();
        } else {
            $bloodTypes = BloodType::all();
        }

        return responseJson(1, '', $bloodTypes);


    }

    /**
     * Send contacts to admin
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function contactUs(Request $request)
    {
        $validation = Validator::make($request->all(),[

            'name' => 'required|min:3',
            'email' => 'required',
            'phone' => 'required|min:11|max:14',
            'title' => 'required',
            'body' => 'required',

        ]);

        if ($validation->fails()){
            return responseJson(0, $validation->messages(), $validation->messages());
        }

        $contact = Contact::create($request->all());

        return responseJson(1, 'تم إرسال رسالتك بنجاح', $contact);
    }

    /**
     * Get contacts
     * @return \Illuminate\Http\JsonResponse
     */
    public function getContactUs()
    {
        $contacts = Contact::all();

        return responseJson(1, '', $contacts);
    }

    /**
     * Settings
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function settings(Request $request)
    {
        $validation = Validator::make($request->all(),[

            'email' => ['required','email', 'regex:/^[a-z0-9.]+@[a-z]+.[a-z]{3,4}$/'],
            'phone' => ['required', 'regex:/^[0-9]{11,14}$/', 'min:11', 'max:14'],
            'google_plus' => ['required'],
            'instagram' => ['required'],
            'facebook' => ['required'],
            'whatsapp' => ['required'],
            'about_us' => ['required'],
            'twitter' => ['required'],
            'youtube' => ['required'],
            'terms_conditions' => ['required'],

        ]);

        if ($validation->fails()){
            return responseJson(0, $validation->messages());
        }

        if ($request->has('id')){
            $id = $request->id;
            $settings = Setting::find($id);
            $settings->update($request->all());
            return responseJson(1, 'تم تعديل الإعدادت بنجاح', $settings);
        } else {
            $settings = Setting::create($request->all());
            return responseJson(1, 'تم إضافة الإعدادت بنجاح', $settings);
        }
    }

    /**
     * Send order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orders(Request $request)
    {
        $validation = Validator::make($request->all(),[

            'name' => ['required', 'min:3'],
            'age' => ['required', 'integer'],
            'blood_type_id' => ['required', 'integer'],
            'bags_num' => ['required', 'integer'],
            'hospital_name' => ['required', 'string'],
            'hospital_address' => ['required', 'string'],
            'longitud' => ['required'],
            'latitude' => ['required'],
            'city_id' => ['required', 'integer'],
            'client_id' => ['required', 'integer'],
            'phone' => ['required', 'min:11', 'max:14', 'regex:/^[0-9]{11,14}$/'],
            'description' => ['required']

        ]);

        if ($validation->fails()){
            return responseJson(0, 'Validation ERROR', $validation->messages());
        }

        $order = Order::create($request->all());

        $clientsIds = $order->city->government->clients()->whereHas('bloodTypes', function ($que) use ($request){
            $que->where('blood_types.id', $request->blood_type_id);
        })->pluck('clients.id')->toArray();

        if(count($clientsIds) > 0){
            $id = $request->blood_type_id;
            $bloodType = BloodType::find($id)->name;
            $notifications = $order->notifications()->create([
                'title' => 'حالة تحتاج للتبرع بالدم قريبة منك',
                'body' => ' يحتاج ' . $order->name . ' للتبرع بالدم لفصيلة ' . $bloodType,
                'order_id' => $order->id

            ]);

            $notifications->clients()->attach($clientsIds);

            $tokens = Token::whereIn('client_id', $clientsIds)->where('token', '!=', '')->pluck('token')->toArray();

            if(count($tokens) > 0){
                $title = $notifications->title;
                $body = $notifications->body;
                $data =[

                    'order_id' => $order->id
                ];

                $send = notifyByFireBase($title, $body, $tokens, $data);
                info("firebase result: " . $send);
                return responseJson(1, 'تم الإرسال بنجاح', $send);
            }
        }

    }

    /**
     * Toggle favorites
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function favoritePost(Request $request)
    {
        $validation = Validator::make($request->all(),[

            'client_id' => ['required', 'integer'],
            'post_id' => ['required', 'integer'],

        ]);

        if ($validation->fails()){
            return responseJson(0, 'Validation ERROR', $validation->messages());
        }

        $id = $request->client_id;
        $postId = $request->post_id;
        $user = Client::find($id);

        $post = $user->posts()->toggle($postId);

        return responseJson(1, $post);

    }

    /**
     * Get favorites posts
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFavoritePost()
    {

        $id = auth()->user()->id;

        $client = Client::find($id);

        $posts = $client->posts()->get();

        return responseJson(1, 'Favorites posts get successfully', ['posts' => $posts]);



    }

    /**
     * Update notifications settings
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function notificationsSettings(Request $request){

        $validation = Validator::make($request->all(),[

            'government_id' => ['array', 'required'],
            'blood_type_id' => ['array', 'required'],

        ]);

        if ($validation->fails()){
            return responseJson(0, 'Validation ERROR', $validation->messages());
        }

        $client = auth()->user();

        $client->bloodTypes()->sync($request->blood_type_id);
        $client->governments()->sync($request->government_id);

        return responseJson(1, 'Settings updated sucessfully', [$client->bloodTypes()->get(), $client->governments()->get()]);


    }

    /**
     * Search in orders
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderSearch(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'blood_type_id' => ['nullable'],
            'city_id' => ['nullable']
        ]);

        if ($validation->fails()){
            return responseJson(0, 'Validation ERROR', $validation->messages());
        }

        $orders = Order::where('blood_type_id', $request->blood_type_id)->orWhere('city_id', $request->city_id)->get();

        if (count($orders) > 0){

            return responseJson(1, '', $orders);

        } else {

            $orders = Order::all();
            return responseJson(1, '', $orders);
        }


    }

    /**
     * Search in orders
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postSearch(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'category_id' => ['nullable'],
            'title' => ['nullable']
        ]);

        if ($validation->fails()){
            return responseJson(0, 'Validation ERROR', $validation->messages());
        }

        $posts = Post::where('category_id', $request->category_id)->orWhere('title', 'LIKE', "%$request->title%")->orWhere('body', 'LIKE', "%$request->title%")->get();


        if (count($posts) > 0){

            return responseJson(1, '', $posts);

        } else {

            $posts = Post::all();
            return responseJson(1, '', $posts);
        }


    }

    /**
     * Add post by admin
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addPost(Request $request){
        $validation = Validator::make($request->all(),[

            'title' => ['required', 'min:3'],
            'body' => ['required'],
            'img' => ['nullable'],
            'category_id' => ['required'],
        ]);

        if ($validation->fails()){
            return responseJson(0, $validation->messages());
        }

        $post = Post::create($request->all());

        return responseJson(1, 'تم إضافة المقال بنجاح', $post);
    }

    /**
     * Get notifications settings
     * @return \Illuminate\Http\JsonResponse
     */
    public function getNotificationsSettings()
    {
        $client = auth('client')->user();
        $bloodTypesSettings = $client->bloodTypes()->get();
        $governmentsSettings = $client->governments()->get();

        return responseJson(1, 'success', [$bloodTypesSettings, $governmentsSettings]);
    }














}
