<?php

namespace EventCal\Controllers;
use EventCal\Models\Society;
use EventCal\Models\User;

class SocietyListingController extends BaseController
{
	
	public function index()
	{
		
		// get societies, their events and localities, avoiding N+1 queries performance problem
		$societies = Society::with(array('events', 'locality','user'))
								->whereHas('user', function($req)
								{
									$req->where('users.is_actif','=','1');
								})->get();
		
		return \View::make('societies.listing')->with('societies', $societies);
	}
	
}