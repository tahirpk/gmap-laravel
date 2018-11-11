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

    return view('welcome');
});

Route::get('/gmap', 'MapgController@index');
Route::post('/mapshow', 'MapgController@show_map');
Route::get('/addresses',function(){
	return view('addresses.index');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
