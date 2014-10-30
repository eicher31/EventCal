<?php 

namespace EventCal\Controllers;

use EventCal\Models;

class RegisterController extends BaseController{
	
	public function getIndex(){
		return Redirect::action('RegisterController@getUser');
	}
	
	public function getUser(){
		return \View::make('register.user');
	}
	
	public function getSociety(){
		return \View::make('register.society');
	}
	
	public function getConfirm(){
		return \View::make('register.confirm');
	}
	
	public function postUser(){
		$validator = User::validate(Input::all());
		
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator)->withInput();
		}else{
			return Redirect::action('RegisterController@getSociety')->withInput();
		}
	}
	
	public function postSociety(){
		
		if (false){
			return Redirect::back()->withInput();
			//TODO
		}else {
			return Redirect::action('');
		}
		
	}
	
	public function postConfirm(){
		
	}
}
