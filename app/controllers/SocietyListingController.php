<?php

namespace EventCal\Controllers;
use EventCal\Models\Society;

class SocietyListingController extends BaseController
{
	
	public function index()
	{
		// get societies and their events, avoid N+1 queries performance problem
		$societies = Society::with('events')->get();
		
		return \View::make('societies.listing')->with('societies', $societies);
	}
	
}