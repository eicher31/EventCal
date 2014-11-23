<?php

namespace EventCal\Controllers;
use EventCal\Models\User;
use EventCal\Models\Locality;
use EventCal\Models\Event;
use \Auth;
use EventCal\Models\Society;

class ProfileController extends BaseController {

	/**
	 * ID of the current logged user
	 * @var int
	 */
	private $currentUserId;
	
	/**
	 * Sets the ID of the current user which is given by the Auth instance
	 * @param Auth $auth
	 */
	public function __construct(Auth $auth)
	{
		$this->currentUserId = $auth::user()->id;
	}
	
	/**
	 * Display the profile
	 * @return Response
	 */
	public function getIndex()
	{
		$user = \Auth::user();
		$events = $user->society ? Society::extractEventsByDay($user->society->getAllEvents()) : array();
		
		return \View::make('profile.show')->with(array(
			'user'   => $user,
			'events' => $events,
		));
	}


	/**
	 * Show the editing profile
	 * @return Response
	 */
	public function getEdit()
	{
		return \View::make('profile.edit')->with(array(
			'user' => User::findWithSociety($this->currentUserId),
			'city' => Locality::getAsIdNameArray(),
		));
	}

	/**
	 * Update the profile
	 * @return Response
	 */
	public function putEdit()
	{
		$input = \Input::all();
		$errors = User::updateWithSociety($this->currentUserId, $input);
		
		if ($errors !== true)
		{
			return \Redirect::action('EventCal\Controllers\ProfileController@getEdit')->withErrors($errors)->withInput();			
		}
		
		return \Redirect::action('EventCal\Controllers\ProfileController@getIndex')->with('notification', 'Màj réussie');
	}

	
}
