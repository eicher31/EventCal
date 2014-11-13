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
		return \View::make('register.user')->with('city', Locality::getLocalitiesArray());
	}

	public function getConfirm()
	{
		return \View::make('register.confirm')->with('email', \Session::get('email'));
	}

	public function postUser()
	{
		$input = \Input::all();
		
		list ($errors, $user) = User::createWithSociety($input);
		
		if ($errors !== true)
		{
			return \Redirect::back()->withErrors($errors)->withInput();
		}
		else
		{
			return \Redirect::action('EventCal\Controllers\RegisterController@getConfirm')->with('email', $input['email']);
		}
	}
}
