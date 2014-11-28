<?php

namespace EventCal\Controllers;

class SessionController extends BaseController {
	
	public function showConnect()
	{
		return \View::make('connect');
	}
	
	/**
	 * connect the user
	 */
	public function connect()
	{
		$email = \Input::get('email');
		$password = \Input::get('password');
		$persistent = \Input::get('persistent');
		
		// connection works only if the user is active
		$success = \Auth::attempt(array('email' => $email, 'password' => $password, 'is_actif' => 1), (bool)$persistent);
		
		if (!$success)
		{
			// impossible de se connecter
			return \Redirect::back()->withErrors(array('Impossible de se connecter!'))->withInput(\Input::except('password'));
		}
		else
		{
			// connexion réussie
			$url = \Session::get('url.intended', '/');
			return \Redirect::to($url)->with('notification', \Lang::get('message.connexionSuccess'));
		}
	}
	
	/**
	 * disconnect the user
	 */
	public function disconnect()
	{
		\Auth::logout();
		
		return \Redirect::to('/')->with('notification', \Lang::get('message.disconnection'));
	}

}
