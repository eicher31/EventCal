<?php

namespace EventCal\Models;

class Society extends BaseModel 
{
	/**
	 * table name on DB
	 * @var string
	 */
	protected $table = 'societies';
	
	/**
	 * Fields that are fillable with fill()
	 * @var array
	 */
	protected $fillable = array('name', 'description', 'website', 'logo', 'telephone', 'address', 'locality_id');
	
	/**
	 * Fields that cannot be filled with fill()
	 * @var array
	 */
	protected $guarded = array('id', 'user_id', 'is_public');
	
	/**
	 * Validation rules of a society
	 * @var array
	 */
	protected static $validateRules = array(
		'name' => 'required',
		'description' => 'required',
		'website' => 'url',
		'logo' => '',
		'telephone' => '',
		'address' => '',
		'locality_id' => 'required|exists:localities,id',
	);
	
	/**
	 * Order models by this column on listing
	 * @var string
	 */
	protected static $orderBy = "name";
	
	/**
	 * A society belongs to a specific user
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('EventCal\Models\User');
	}
	
	/**
	 * Each society can have multiple events
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function events()
	{
		return $this->hasMany('EventCal\Models\Event');
	}
	
	/**
	 * A society belongs to a locality
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function locality()
	{
		return $this->belongsTo('EventCal\Models\Locality');
	}
	
	/**
	 * Get all events of the current society, ordered by datetime
	 */
	public function getAllEvents()
	{
		// must be on Event model, we grab events corresponding to the current society
		return Event::where('society_id', '=', $this->attributes['id'])->orderBy('datetime', 'DESC')->get();
	}
	
	/**
	 * Get active societies, with their data (user, locality, events)
	 */
	public static function getAllActiveSocietiesData()
	{
		return self::with(array('events', 'locality','user'))
			->whereHas('user', function($req)
			{
				$req->where('users.is_actif','=','1');
			})->get();
	}
	
}