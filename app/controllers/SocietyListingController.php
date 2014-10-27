<?php

namespace EventCal\Controllers;
use EventCal\Models\Society;

class SocietyListingController extends BaseController
{
	
	public function index()
	{
		// get societies, their events and localities, avoiding N+1 queries performance problem
		$societies = Society::with(array('events', 'locality'))->get();
		
		return \View::make('societies.listing')->with('societies', $societies);
	}
	
}