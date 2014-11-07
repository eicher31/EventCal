<?php

namespace EventCal\Controllers;

use Carbon\Carbon;
use EventCal\Models\Event;

class EventsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$today = Carbon::today();
		$nextWeek = Carbon::today()->addWeek();
		
		$day = Carbon::today();
		
		$events = Event::with('society', 'category')
			->where('datetime', '>=', $today)
			->where('datetime', '<', $nextWeek)
			->get();
		
		$dataEvent = array();
		
		for ($i = 0; $i <= 7; $i ++)
		{
			$dataEvent[$day->toDateString()] = array();
			$day->addDay();
		}
		
		foreach ($events as $event)
		{
			$newDateFormat = Carbon::createFromFormat('Y-m-d H:i:s', $event->datetime);
			$dataEvent[$newDateFormat->toDateString()][] = $event;
		}
		
		return \View::make('index')->with('weekEvents', $dataEvent);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id        	
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}
