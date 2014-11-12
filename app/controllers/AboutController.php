<?php

namespace EventCal\Controllers;

class AboutController extends BaseController {
	
	private static $contactRules = array(
		'email'	=> 'required|email',
		'title'	=> 'required',
		'msg'	=> 'required',
	);
	
	public function getIndex()
	{
		return \View::make('about')->with('email', \Auth::check() ? \Auth::user()->email : '');
	}
	
	public function postIndex()
	{
		$data = \Input::only(array_keys(self::$contactRules));
		
		$validator = \Validator::make($data, self::$contactRules);
		
		if ($validator->fails())
		{
			return \Redirect::back()->withErrors($validator)->withInput();
		}
		
		\Mail::send('emails.contact', $data, function($message) use ($data)
		{
			$message->from($data['email'], $data['email']);
			$message->to('mathieu.rosser@he-arc.ch');
			$message->subject($data['title']);
		});
		
		return \Redirect::back()->with('notification', 'Mail envoyé');
	}
}
