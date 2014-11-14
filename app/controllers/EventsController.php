<?php

namespace EventCal\Controllers;

use Carbon\Carbon;
use EventCal\Models\Event;
use EventCal\Models\Society;
use EventCal\Models\EventCategory;
use EventCal\Models\Locality;

class EventsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//TODO a changer une fois le calendrier est en place
		$date = Carbon::today();
		return \View::make('index')->with('weekEvents',Event::getEventPerWeek($date));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data = $this->createViewEditData(new Event(), 'store', 'post');
		return \View::make('events.edit')->with($data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = \Input::all();
		$error = Event::creatEvent($input);
		
		if($error !== true)
		{
			return \Redirect::action('EventCal\Controllers\EventsController@create')->withErrors($error)->withInput();
		}
		//TODO redirriger vers event creer
		return \Redirect::action('EventCal\Controllers\EventsController@index')->with('notification','creation reussite');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function show($id)
	{
		$event = Event::findWithData($id); //categor, societe
		return \View::make('event.show')->with(array(
			'event'		=> $event,
			'locality' 	=> $event->locality,
			'society' 	=> $event->society,
			'category' 	=> $event->category,
			));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function edit($id)
	{
		$data = $this->createViewEditData(Event::findWithData($id), 'update', 'put');
		return \View::make('events.edit')->with($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function update($id)
	{
		$input = \Input::all();
		$error = Event::editEvent($id, $input);
		
		if($error !== true)
		{
			return \Redirect::action('EventCal\Controllers\EventsController@edit',array($id))->withErrors($error)->withInput();
		}
		
		// TODO redirect to @show
		return \Redirect::action('EventCal\Controllers\EventsController@index',array($id))->with('notification','maj');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function destroy($id)
	{
		Event::deleteEvent($id);
		return \Redirect::action('EventCal\Controllers\EventsController@index')->with('notification','delete');
	}
	
	/**
	 * Creates array of data passed to a edit view
	 * @param Event $event
	 * @param string $action
	 * @param string $method
	 * @return array
	 */
	private function createViewEditData($event, $action, $method)
	{
		return array(
			'event' 	=> 	$event,
			'societies' => 	\Auth::user()->is_admin ? Society::getAsIdNameArray() : array(),
			'categories'=> 	EventCategory::getAsIdNameArray(),
			'localities'=> 	Locality::getAsIdNameArray(), 
			'action' 	=> 'EventCal\Controllers\EventsController@' . $action,
			'method'	=> $method,
		);
	}
}
