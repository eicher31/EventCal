<?php

namespace EventCal\Controllers;

use EventCal\Models;

class SocietyListingController extends BaseController
{
	
	public function index()
	{
		
		$societies = \EventCal\Models\Society::all();	
		//$events = \EventCal\Models\Event::all();
		
		$events = \EventCal\Models\Event::get();
		
		return \View::make('societies.listing',array('societies'=>$societies))->with('events',$events);
		//return View::make('societies.listing',array('societies'=>$societies),array('societies'=>$events));
	}
	
}