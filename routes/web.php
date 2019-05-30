<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::group(['middleware' => 'auth'], function () {

    Route::resource('governments', 'GovernmentsController');
    Route::resource('cities', 'CitiesController');
    Route::resource('categories', 'CategoriesController');
    Route::resource('clients', 'ClientsController');
    Route::resource('posts', 'PostsController');
    Route::resource('contacts', 'ContactsController');
    Route::delete('delete', 'ContactsController@delete')->name('contacts.delete');
    Route::delete('shift-delete', 'ContactsController@shiftDelete')->name('contacts.shiftdelete');
    Route::get('read', 'ContactsController@read')->name('read');
    Route::get('movetoread/{id}', 'ContactsController@moveToRead')->name('movetoread');
    Route::get('movetounread/{id}', 'ContactsController@moveToUnRead')->name('movetounread');
    Route::get('trash', 'ContactsController@trash')->name('trash');

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
