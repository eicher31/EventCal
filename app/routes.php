<?php

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the Closure to execute when that URI is requested.
 * |
 */
Route::get('/', 'EventCal\Controllers\EventsController@index');

// connection for guest
Route::group(array('before' => 'guest'), function ()
{
	Route::get('connexion', 'EventCal\Controllers\SessionController@showConnect');
	Route::post('connexion', 'EventCal\Controllers\SessionController@connect');
	// Register
	Route::controller('register', 'EventCal\Controllers\RegisterController');
});

// password reminders
Route::controller('password', 'EventCal\Controllers\RemindersController');

// administration
Route::group(array('before' => 'auth.admin'), function ()
{
	Route::get('admin', function ()
	{
		return Redirect::to('admin/users');
	});
	Route::resource('admin/users', 'EventCal\Controllers\Admin\UsersController');
	Route::controller('admin/users', 'EventCal\Controllers\Admin\UsersController');
	Route::resource('admin/category', 'EventCal\Controllers\Admin\EventCategoryController');
});

// routes for listing entreprise with there events
Route::get('societies', 'EventCal\Controllers\SocietyListingController@index');
Route::get('societies/{id}', 'EventCal\Controllers\SocietyListingController@show');

// routes for connected users, like profile and event management
Route::group(array('before' => 'auth'), function ()
{
	// disconnection for members
	Route::get('deconnexion', 'EventCal\Controllers\SessionController@disconnect');
	// profile
	Route::controller('profile', 'EventCal\Controllers\ProfileController');
});

// event managing
// do itself the route filtering for the user logged functions
Route::resource('event', 'EventCal\Controllers\EventsController');

// about contact
Route::controller('about', 'EventCal\Controllers\AboutController');

// applies CSRF protection at every post/put/delete request (token automatically written in form)
Route::when('*', 'csrf', array('post', 'put', 'delete'));

// Services
Route::get('localitysearch', 'EventCal\Controllers\Services\LocalitySearchController@search');


// Routes unknown
/*
App::missing(function ()
{
	return Route::make('error','error.missing');
	//return "404";
});

// Server Error
App::error(function()
{
	return "500";
});*/

// Routes errors (404 / server error )
App::error(function($exception, $code)
{
	if(App::environment('production'))
	{
	    switch ($code)
	    {
	        case 403:
	        case 404:
	            return Response::view('error.missing', array(), $code);
	
	        default:
	            return Response::view('error.serverError', array(), $code);
	    }
	}
});
