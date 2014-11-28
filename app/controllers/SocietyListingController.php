<?php

namespace EventCal\Controllers;
use EventCal\Models\Society;
use EventCal\Models\User;
use EventCal\Models\Event;
use Carbon\Carbon;

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
		$society = Society::getActiveSociety($id);
		
		return \View::make('societies.show')->with(array(
			'society'			=> $society,
			'showSocietyEvents'	=> false,
			'eventsByMonths'	=> Event::getListingEvents(Carbon::today(), true, $society->id),
		));
	}
}