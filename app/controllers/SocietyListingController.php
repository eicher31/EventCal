<?php

namespace EventCal\Controllers;
use EventCal\Models\Society;
use EventCal\Models\User;
use EventCal\Models\Event;
use Carbon\Carbon;

class SocietyListingController extends BaseController
{
	
	/**
	 * Lists all societies
	 * @return \View
	 */
	public function index()
	{	
		return \View::make('societies.listing')->with(array(
			'societiesByName'	=> Society::getSocietiesByName(),
		));
	}
	
	/**
	 * Show a specific society
	 * @param int $id
	 * @return \View
	 */
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