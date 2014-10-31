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
		$locality = Locality::orderBy('code')->get();
		
		$local = array();
		
		foreach ($locality as $l)
		{
			$local[$l->id] = $l->codeCity();
					
		}
			
			

		return \View::make('register.user')->with('city',$local);
	}

	public function postUser()
	{
		$input = \Input::all();
		$validatorUser = User::validate($input);
		$validatorSociety = Society::validate($input);
		
		if ($validatorUser->fails() || $validatorSociety->fails())
		{
			$notValid = $validatorUser->messages()->merge($validatorSociety->messages());
			return \Redirect::back()->withErrors($notValid)->withInput();
		}
		
		$user = new User();
		$user->fill($input);
		$user->is_admin = 0;
		$user->is_actif = 0;
		$user->save();
		
		$society = new Society();
		$society->fill($input);
		$society->user_id = $user->id;
		$society->is_public = 1;
		$society->save();
		
		return \Redirect::to('/');
		
	}
}
