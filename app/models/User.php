<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	
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
	 * Deactivate timestamps fields
	 *
	 * @var bool
	 */
	public $timestamps = false;
	
	private static  $validateRules = array(
		'email' => 'required|email|unique:users',
		'password' => 'required|min:6|same:password_confirm',
		'first_name' => 'required',
		'last_name' => 'required',
	);
	
	public static function validate(array $data){
		return Validator::make($data, self::$validateRules);
	}
}
