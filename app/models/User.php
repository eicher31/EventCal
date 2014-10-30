<?php

namespace EventCal\Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {
	
	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	/**
	 * Fields that are fillable with fill()
	 * @var array
	 */
	protected $fillable = array('email', 'password', 'first_name', 'last_name');
	
	/**
	 * Fields that cannot be filled with fill()
	 * @var array
	 */
	protected $guarded = array('id', 'is_admin', 'is_actif', 'remember_token');
	
	/**
	 * Validation rules of an User
	 * @var array
	 */
	protected static $validateRules = array(
		'email' => 'required|email|unique:users,email',
		'password' => 'required|min:6|same:password_confirm',
		'first_name' => 'required',
		'last_name' => 'required',
	);
		
	/**
	 * Mutator for the password field: set the hash of the password
	 * @param unknown $value
	 */
	public function setPasswordAttribute($value) 
	{
		$this->attributes['password'] = \Hash::make($value);
	}
	
	/**
	 * An user can have one society
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function society()
	{
		return $this->hasOne('EventCal\Models\Society');
	}
	
	/**
	 * First and last name of the user
	 * @return string
	 */
	public function fullName()
	{
		return $this->attributes['first_name'] . " " . $this->attributes['last_name'];
	}
			
}
