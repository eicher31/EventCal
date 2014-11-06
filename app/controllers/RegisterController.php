<?php
namespace EventCal\Controllers;

use EventCal\Models\User;
use EventCal\Models\Society;
use EventCal\Models\Locality;

class RegisterController extends BaseController {

	public function getIndex()
	{
		return \Redirect::action('EventCal\Controllers\RegisterController@getUser');
	}

	public function getUser()
	{
		return \View::make('register.user')->with('city',Locality::getLocalitiesArray());
	}

	public function postUser()
	{
		$input = \Input::all();
		
		if (($errors = User::createWithSociety($input)) !== true)
		{
			return \Redirect::back()->withErrors($errors)->withInput();
		}
		
		return \Redirect::to('/');		
	}
}
