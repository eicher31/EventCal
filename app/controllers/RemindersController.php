<?php

namespace EventCal\Controllers;

class RemindersController extends BaseController {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return \View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$response = \Password::remind(\Input::only('email'), function ($message)
		{
			$message->subject('Password Reminder');
		});
		
		switch ($response)
		{
			case \Password::INVALID_USER:
				return \Redirect::back()->withErrors($this->createErrors($response));
			
			case \Password::REMINDER_SENT:
				return \Redirect::back()->with('notification', 'Email de récupération de mot de passe envoyé');
		}
	}
	
	/**
	 * Display the password reset view for the given token.
	 *
	 * @param string $token        	
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token))
			\App::abort(404);
		
		return \View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = \Input::only('email', 'password', 'password_confirmation', 'token');
		
		$response = \Password::reset($credentials, function ($user, $password)
		{
			$user->password = $password;	// hashed by the model
			$user->save();
		});
		
		switch ($response)
		{
			case \Password::INVALID_PASSWORD:
			case \Password::INVALID_TOKEN:
			case \Password::INVALID_USER:
				return \Redirect::back()->withErrors($this->createErrors($response));
			
			case \Password::PASSWORD_RESET:
				return \Redirect::to('/')->with('notification', 'Mot de passe mis à jour');
		}
	}
	
	/**
	 * Create a new MessageBag instance for errors handling
	 * @param string $langKey
	 * @return \Illuminate\Support\MessageBag
	 */
	private function createErrors($langKey)
	{
		return new \Illuminate\Support\MessageBag(array(\Lang::get($langKey)));
	}
	
}
