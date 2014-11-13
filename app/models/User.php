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
	protected $hidden = array(
		'password',
		'remember_token'
	);

	/**
	 * Fields that are fillable with fill()
	 * 
	 * @var array
	 */
	protected $fillable = array(
		'email',
		'password',
		'first_name',
		'last_name'
	);

	/**
	 * Fields that cannot be filled with fill()
	 * 
	 * @var array
	 */
	protected $guarded = array(
		'id',
		'is_admin',
		'is_actif',
		'remember_token'
	);

	/**
	 * Validation rules of an User
	 * 
	 * @var array
	 */
	protected static $validateRules = array(
		'email' => 'required|email|unique:users,email',
		'password' => 'required|min:6|same:password_confirm',
		'first_name' => 'required',
		'last_name' => 'required'
	);

	/**
	 * Mutator for the password field: set the hash of the password
	 * 
	 * @param unknown $value        	
	 */
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = \Hash::make($value);
	}

	/**
	 * An user can have one society
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function society()
	{
		return $this->hasOne('EventCal\Models\Society');
	}

	/**
	 * First and last name of the user
	 * 
	 * @return string
	 */
	public function fullName()
	{
		return $this->attributes['first_name'] . " " . $this->attributes['last_name'];
	}

	/**
	 * Delete a user and all his data: society and events
	 */
	public static function deleteAllData($id)
	{
		$user = User::findWithSociety($id);
		
		if ($user->society)
		{
			$user->society->events()->delete();
			$user->society->delete();
		}
		
		$user->delete();
	}

	/**
	 * Get user with society given an $id
	 */
	public static function findWithSociety($id)
	{
		return User::with('society')->find($id);
	}

	/**
	 * Create an user with a society
	 * 
	 * @param array $data        	
	 * @return errors | true on success
	 */
	public static function createWithSociety(array $data)
	{
		$errors = self::validateUserSociety($data);
		if ($errors !== true)
		{
			return [
				$errors,
				null
			];
		}
		
		$user = new User();
		$user->fill($data);
		$user->is_admin = 0;
		$user->is_actif = 0;
		$user->save();
		
		$society = new Society();
		$society->fill($data);
		$society->user_id = $user->id;
		$society->is_public = 1;
		$society->save();
		
		\Mail::send('emails.confirm.user', [
			"user" => $user
		], function ($m) use ($user)
		{
			$m->from(\Config::get('eventcal.noreply'), 'Administrateur');
			$m->to($user->email);
		});
		
		\Mail::send('emails.confirm.admin', [
			"user" => $user
		], function ($m)
		{
			$m->from(\Config::get('eventcal.noreply'), 'Administrateur');
			$m->to(\Config::get('eventcal.mail'));
		});
		
		return [
			true,
			$user
		];
	}

	/**
	 * Update a specified user with user and society data
	 * 
	 * @param int $id        	
	 * @param array $data        	
	 * @return errors | true on success
	 */
	public static function updateWithSociety($id, array $data)
	{
		$user = User::findWithSociety($id);
		
		// set exception rules for password: if empty, doesn't validate nor set it
		$exceptValidation = User::buildExceptValidation(array_keys(self::$validateRules), $data);
		
		$validatorMethod = $user->society ? 'validateUserSociety' : 'validate';
		
		
		$errors = User::$validatorMethod($data, $exceptValidation, array(
			'email' => $user->id
		));
		
		if ($errors !== true)
		{
			return $errors;
		}
		
		$oldState = $user->is_actif;
		
		$user->fill($data);
		if (isset($data['is_actif']))
		{
			$user->is_actif = (bool) $data['is_actif'];
		}
		$user->save();
		
		if ($user->society)
		{
			$user->society->fill($data);
			$user->society->save();
		}
		
		if ($oldState != $user->is_actif)
		{
			if ($user->is_actif)
			{
				\Mail::send('emails.confirm.activate', ["user" => $user], function ($m) use ($user)
				{
					$m->from(\Config::get('eventcal.noreply'), 'Administrateur');
					$m->to($user->email);
				});
			}else{
				\Mail::send('emails.confirm.disactivate', ["user" => $user], function ($m) use ($user)
				{
					$m->from(\Config::get('eventcal.noreply'), 'Administrateur');
					$m->to($user->email);
				});
			}
		}
		
		return true;
	}

	/**
	 * Validate an user and his society data
	 * See static::validate() for parameters
	 * 
	 * @param array $data        	
	 * @param array $except        	
	 * @param array $uniqueId        	
	 * @return errors | true on success
	 */
	public static function validateUserSociety(array $data, array $except = array(), array $uniqueId = array())
	{
		$errorsUser = User::validate($data, $except, $uniqueId);
		$errorsSociety = Society::validate($data, $except, $uniqueId);
		
		if ($errorsUser !== true || $errorsSociety !== true)
		{
			if ($errorsUser === true)
			{
				return $errorsSociety;
			}
			
			if ($errorsSociety === true)
			{
				return $errorsUser;
			}
			
			return $errorsUser->merge($errorsSociety);
		}
		
		return true;
	}

	/**
	 * Get all users, ordered by active flag and email for admin listing purpose
	 */
	public static function getAllUsersForAdmin()
	{
		return User::with('society')->orderBy('is_actif', 'ASC')->orderBy('email', 'ASC')->get();
	}

	public static function getIsActif()
	{
		return User::where('is_actif', '=', '1');
	}
}
