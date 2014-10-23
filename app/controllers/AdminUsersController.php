<?php

class AdminUsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();
		return View::make('admin.listing_users')->with('users', $users);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
// 	public function create()
// 	{
// 		//
// 	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
// 	public function store()
// 	{
// 		//
// 	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('admin.show_user')->with('user', User::find($id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('admin.edit_user')->with('user', User::find($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);
		
		$exceptValidation = array();
		if (!Input::has('password'))
		{
			$exceptValidation[] = 'password';
		}
		
		$validator = User::validate(Input::all(), $exceptValidation, array('email' => $user->id));
		if ($validator->fails())
		{
			return Redirect::action('AdminUsersController@edit', array($id))->withErrors($validator)->withInput();
		}
		
		$user->fill(Input::all());
		$user->save();
		
		return Redirect::action('AdminUsersController@show', array($id))->with('notification', 'Màj réussie');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);
		return Redirect::action('AdminUsersController@index')->with('notification', 'Suppression effectuée');
	}


}
