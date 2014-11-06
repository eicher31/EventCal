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
	return \View::make('index');
});

// connection for guest
Route::group(array('before' => 'guest'), function() 
{
	Route::get('connexion', 'EventCal\Controllers\SessionController@showConnect');
	Route::post('connexion', 'EventCal\Controllers\SessionController@connect');
	//Register
	Route::controller('register',  'EventCal\Controllers\RegisterController');
});

// disconnection for members
Route::get('deconnexion', array('before' => 'auth', 'uses' => 'EventCal\Controllers\SessionController@disconnect'));

// password reminders
Route::controller('password', 'EventCal\Controllers\RemindersController');

// administration
Route::group(array('before' => 'auth.admin'), function()
{
	Route::get('admin', function(){
		return Redirect::to('admin/users');
	});
	Route::resource('admin/users', 'EventCal\Controllers\AdminUsersController');
	Route::controller('admin/users', 'EventCal\Controllers\AdminUsersController');
});

//
Route::get('societies','EventCal\Controllers\SocietyListingController@index');

// Routes unknown
App::missing(function(){return "404";});
//TODO

