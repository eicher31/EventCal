<?php

namespace EventCal\Controllers;
use EventCal\Models\Society;
use EventCal\Models\User;

class SocietyListingController extends BaseController
{
	
	public function index()
	{
		$societies = Society::getActiveSociety();
		$events = Society::extractEventsByDayFromSocieties($societies);
		
		return \View::make('societies.listing')->with(array(
			'societies'	=> $societies,
			'events'	=> $events,
		));
	}
	
	public function show($id)
	{
		
	}
}