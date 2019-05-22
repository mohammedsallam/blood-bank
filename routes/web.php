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

Route::resource('governments', 'GovernmentsController');
Route::resource('cities', 'CitiesController');
Route::resource('categories', 'CategoriesController');
Route::resource('clients', 'ClientsController');
Route::any('search', 'ClientsController@search');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
