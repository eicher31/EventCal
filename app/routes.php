<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// index
Route::get('/', function()
{
	return View::make('index');
});


// connection for guest
Route::group(array('before' => 'guest'), function() 
{
	Route::get('connexion', 'SessionController@showConnect');
	Route::post('connexion', 'SessionController@connect');
});

// disconnection for members
Route::get('deconnexion', array('before' => 'auth', 'uses' => 'SessionController@disconnect'));
