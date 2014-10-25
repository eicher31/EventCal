<?php

namespace EventCal\Controllers;

class SessionController extends BaseController {
	
	public function showConnect()
	{
		return View::make('connect');
	}
	
	/**
	 * connect the user
	 */
	public function connect()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$persistent = Input::get('persistent');
		
		// connection works only if the user is active
		$success = Auth::attempt(array('email' => $email, 'password' => $password, 'is_actif' => 1), (bool)$persistent);
		
		if (!$success)
		{
			// impossible de se connecter
			return Redirect::refresh()->with('error', 'Impossible de se connecter!')->withInput(Input::except('password'));
		}
		else
		{
			// connexion réussie
			return Redirect::to('/')->with('notification', 'Connexion réussie');
		}
	}
	
	/**
	 * disconnect the user
	 */
	public function disconnect()
	{
		Auth::logout();
		
		return Redirect::to('/')->with('notification', 'Vous êtes déconnecté!');
	}

}
