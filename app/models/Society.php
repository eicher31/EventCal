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
		return Event::with('category')->where('society_id', '=', $this->attributes['id'])->orderBy('datetime', 'DESC')->get();
	}
	
	/**
	 * Get active societies, with their data (user, locality)
	 */
	public static function getActiveSociety($id = 0)
	{
		$data = self::with(array('locality', 'user'))
			->whereHas('user', function($req)
			{
				$req->where('users.is_actif','=','1');
			});
				
		if ($id)
		{
			return $data->find($id);
		}
		
		return $data->orderBy(static::$orderBy)->get();
	}
	
	/**
	 * Returns the active societies, in a 2D array ordered by the first letter of the name [letter => [societies...], ...]
	 * @return array
	 */
	public static function getSocietiesByName()
	{
		$alphas = range('A', 'Z');
		$num = range('0','9');	
		
		$societies = self::getActiveSociety();
		$data = array();
		
		foreach ($societies as $society)
		{
			$char = strtoupper($society->name[0]);
			
			// recup
			if(in_array($char, $alphas, true))
			{
				$data[$char][] = $society;
			}
			elseif(in_array($char,$num, true))
			{
				$data["0-9"][] = $society;
			}
			else
			{
				$data["§"][] = $society;
			}
		}
		
		return $data;
	}
	
	/**
	 * Extracts events of the given societies, and store them as an array
	 * The array format is: [society-id => [day => events]]
	 * @param array $societies
	 * @return array
	 */
	public static function extractEventsByDayFromSocieties($societies)
	{
		$eventsByDay = array();
		
		foreach ($societies as $society)
		{
			$eventsByDay[$society->id] = self::extractEventsByDay($society->events);
		}
		
		return $eventsByDay;
	}
	
	/**
	 * Extract the events from a general events tab and store them in an array by day
	 * Format of return is: [day => [events...]]
	 * @param array $events
	 * @return array
	 */
	public static function extractEventsByDay($events)
	{
		$eventsByDay = array();
		
		foreach ($events as $event)
		{
			$eventsByDay[$event->getDate()][] = $event;
		}
		
		return $eventsByDay;
	}
	
}