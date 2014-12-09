<?php

namespace EventCal\Controllers\Admin;
use EventCal\Controllers\BaseController;
use EventCal\Models\User;
use EventCal\Models\Locality;
use EventCal\Models\Event;

class UsersController extends BaseController {

	/**
	 * Display a listing of the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::getAllUsersForAdmin();
		return \View::make('users.listing_users')->with('users', $users);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findWithSociety($id);
		$events = $user->society ? Event::getListingEvents(null, false, $user->society->id) : array();
		
		return \View::make('users.show_user')->with(array(
			'user'   			=> $user,
			'isAdmin'			=> true,
			'actionEdit'		=> 'EventCal\Controllers\Admin\UsersController@edit',
			'showSocietyEvents'	=> false,
			'eventsByMonths'	=> $events,
		));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return \View::make('users.edit_user')->with(array(
			'isAdmin'		=> true,
			'actionEdit'	=> 'EventCal\Controllers\Admin\UsersController@update',
			'user' 			=> User::findWithSociety($id),
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
		$input = \Input::all();
		$input['is_actif'] = \Input::has('is_actif') ? \Input::get('is_actif') : false;

		$errors = User::updateWithSociety($id, $input);
		
		if ($errors !== true)
		{
			return \Redirect::action('EventCal\Controllers\Admin\UsersController@edit', array($id))->withErrors($errors)->withInput();			
		}
		
		return \Redirect::action('EventCal\Controllers\Admin\UsersController@show', array($id))->with('notification', \Lang::get('message.msgMAJ'));
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::deleteAllData($id);
		
		return \Redirect::action('EventCal\Controllers\Admin\UsersController@index')->with('notification', \Lang::get('message.msgSup'));
	}
	
	/**
	 * Activate the specified user with his id
	 * 
	 * @param int $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function putActivate($id)
	{
		$input['is_actif'] = true;
		
		User::updateWithSociety($id, $input);
		
		return \Redirect::action('EventCal\Controllers\Admin\UsersController@show', array($id))->with('notification', \Lang::get('message.msgMAJ'));
	}
	
}
