<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::get('governments', 'MainController@governments');
    Route::get('cities', 'MainController@cities');
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('reset-password', 'AuthController@resetPassword');
    Route::post('new-password', 'AuthController@newPassword');
    Route::get('posts', 'MainController@posts');
    Route::post('blood-types', 'MainController@bloodTypes');
    Route::post('order-search', 'MainController@orderSearch');
    Route::post('post-search', 'MainController@postSearch');
    Route::group(['middleware' => 'auth:client'], function () {
        Route::get('categories', 'MainController@categories');
        Route::post('orders', 'MainController@orders');
        Route::post('favorite-post', 'MainController@favoritePost');
        Route::get('get-favorite-post', 'MainController@getFavoritePost');
        Route::post('register-token', 'AuthController@registerToken');
        Route::post('remove-token', 'AuthController@removeToken');
        Route::post('contact-us', 'MainController@contactUs');
        Route::post('notifications-settings', 'MainController@notificationsSettings');
        Route::post('get-notifications-settings', 'MainController@getNotificationsSettings');
        Route::post('profile', 'AuthController@profile');
    });
    Route::post('admin/login', 'AuthController@adminLogin');
    Route::group(['middleware' => 'auth:api', 'prefix' => 'admin'], function () {
        Route::post('settings', 'MainController@settings');
        Route::get('contact-us', 'MainController@getContactUs');
        Route::post('add-post', 'MainController@addPost');
//        Route::post('profile', 'AuthController@adminProfile');
    });

});