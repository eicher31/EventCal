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
	//Register
	Route::controller('register',  'RegisterController');
});

// disconnection for members
Route::get('deconnexion', array('before' => 'auth', 'uses' => 'SessionController@disconnect'));

// password reminders
Route::controller('password', 'RemindersController');

// administration
Route::group(array('before' => 'auth.admin'), function()
{
	Route::get('admin', function(){
		return Redirect::to('admin/users');
	});
	Route::resource('admin/users', 'AdminUsersController');
});

// Routes unknown
App::missing(function(){return "404";});
//TODO
