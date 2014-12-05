<?php

namespace EventCal\Controllers\Admin;
use EventCal\Controllers\BaseController;
use EventCal\Models\EventCategory;


class EventCategoryController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cat = EventCategory::getAllCategories();
		
		return \View::make("category.listing")->with('categories',$cat);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return \View::make("category.formEdit")->with(array(
			"cat"=>new EventCategory(),
			"action"=>"EventCal\Controllers\Admin\EventCategoryController@store",
			"methode"=>"post",
		));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$data = \Input::all();
		if(($error = EventCategory::createCategory($data))===true)
		{
			return \Redirect::action("EventCal\Controllers\Admin\EventCategoryController@index")->with("notification",\Lang::get('message.catCreated'));
		}
		return \Redirect::action("EventCal\Controllers\Admin\EventCategoryController@create")->withErrors($error)->withInput();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 
	public function show($id)
	{
		//
	}*/


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return \View::make("category.formEdit")->with(array(
			"cat"=> EventCategory::find($id),
			"action"=> "EventCal\Controllers\Admin\EventCategoryController@update",
			"methode"=>"put",
		));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$data = \Input::all();
		if(($error = EventCategory::updateCategory($id, $data))===true)
		{
			return \Redirect::action("EventCal\Controllers\Admin\EventCategoryController@index")->with("notification",\Lang::get('message.msgMAJ'));
		}
		return \Redirect::action("EventCal\Controllers\Admin\EventCategoryController@edit",array($id))->withErrors($error)->withInput();
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$lang = (EventCategory::deleteCategory($id)) ? "message.msgSup" : "message.catCannotDel";
		
		return \Redirect::action("EventCal\Controllers\Admin\EventCategoryController@index")->with("notification", \Lang::get($lang));
	}


}
