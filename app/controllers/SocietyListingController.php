<?php

namespace EventCal\Controllers;
use EventCal\Models\Society;
use EventCal\Models\User;

class SocietyListingController extends BaseController
{
	
	public function index()
	{
		// get societies, their events and localities, avoiding N+1 queries performance problem
		$societies = Society::getAllActiveSocietiesData();
		
		return \View::make('societies.listing')->with('societies', $societies);
	}
	
}