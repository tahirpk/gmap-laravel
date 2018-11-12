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

Route::get('/', 'MapgController@mindex');

Route::get('/gmap', 'MapgController@index');
Route::post('/mapshow', 'MapgController@show_map');
Route::get('/addresses',function(){
	return view('addresses.index');
});
Route::post('search','MapgController@search');
Route::post('search-ajax','MapgController@searchAjax');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/glocs',function ()
{
	$config = array();
	$config['map_height'] = "100%";
	$config['center'] = 'Office 902, Green Tower, opposit Dubai Creek, Dubai';

	GMaps::initialize($config); // Initialize Map with custom configuration
	$map = GMaps::create_map(); // This object will render javascript files and map view; you can call JS by $map['js'] and map view by $map['html']
	$marker['position']='Office 902, Green Tower, opposit Dubai Creek, Dubai';
	$marker['infowindow_content']='Office 902, Green Tower, opposit Dubai Creek, Dubai';
	GMaps::add_marker($marker);

        return view('welcome0', ['map' => $map]);
	
});
