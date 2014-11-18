<?php
namespace EventCal\Models;

use Carbon\Carbon;

class Event extends BaseModel {

	/**
	 * Events table
	 *
	 * @var string
	 */
	protected $table = 'events';

	/**
	 * Fields that are fillable with fill()
	 *
	 * @var array
	 */
	protected $fillable = array('name','description','datetime','address','locality_id','category_id');

	/**
	 * Fields that cannot be filled with fill()
	 *
	 * @var array
	 */
	protected $guarded = array('id','society_id');

	/**
	 * Validation rules of an event
	 *
	 * @var array
	 */
	protected static $validateRules = array(
		'society_id' => 'required|exists:societies,id',
		'name' => 'required',
		'description' => 'required',
		'datetime' => 'required|date',
		'address' => '',
		'locality_id' => 'required|exists:localities,id',
		'category_id' => 'required|exists:events_categories,id',
	);
		
	/**
	 * An event belongs to a society
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function society()
	{
		return $this->belongsTo('EventCal\Models\Society');
	}

	/**
	 * An event can belong to a locality
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function locality()
	{
		return $this->belongsTo('EventCal\Models\Locality');
	}

	/**
	 * An events belongs to a category
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo('EventCal\Models\EventCategory');
	}

	public function getLocality()
	{
		if($this->attributes['locality_id'])
		{
			return $this->attributes['locality_id'];
		}
		return $this->attributes[''];
	}
	
	/**
	 */
	public static function creatEvent(array $data)
	{
		// if an events doesn't have a society, set to current session society id
		if (! isset($data['society_id']))
		{
			$data['society_id'] = \Auth::user()->society->id;
		}
		
		$errorEvent = self::validate($data);
		
		
		if ($errorEvent !== true)
		{
			return $errorEvent;
		}
		
		$event = new self();
		$event->fill($data);
		$event->society_id = $data['society_id'];
		$event->save();
		
		return $event;
	}

	/**
	 *
	 * @param unknown $id        	
	 */
	public static function editEvent($id, array $data)
	{
		$event = self::find($id);
		
		$exceptKey = array_keys(self::$validateRules);
		$exceptionValidation = self::buildExceptValidation($exceptKey, $data);
		
		$errors = self::validate($data, $exceptionValidation);
		
		if ($errors !== true)
		{
			return $errorEvent;
		}
		
		$event->fill($data);
		
		if (isset($data['society_id']))
		{
			$event->society_id = $data['society_id'];
		}
		
		$event->save();
		
		return true;
	}

	/**
	 *
	 * @param unknown $id        	
	 */
	public static function deleteEvent($id)
	{
		$event = self::find($id);
		$event->delete();
	}

	/**
	 * find all category and societies by the event id
	 *
	 * @param unknown $id        	
	 */
	public static function findWithData($id)
	{
		return self::with(array('locality','society','category'))->find($id);
	}
	
	/**
	 */
	public function getHour()
	{
		$newHourFormat = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes["datetime"]);
		return $newHourFormat->format('H:i');
	}

	/**
	 *
	 * @param Carbon::date $date        	
	 * @return array event in a week
	 */
	public static function getEventPerWeek($date)
	{
		if (isset($date))
		{
			$today = $date;
			// TODO : faux car il faut prendre $date
			$nextWeek = Carbon::today()->addWeek();
		}
		else
		{
			$today = Carbon::today();
			$nextWeek = Carbon::today()->addWeek();
		}
		
		$day = Carbon::today();
		
		$events = self::with('society', 'category')->where('datetime', '>=', $today)->where('datetime', '<', $nextWeek)->get();
		
		$dataEvent = array();
		
		for ($i = 0; $i <= 7; $i ++)
		{
			$dataEvent[$day->toDateString()] = array();
			$day->addDay();
		}
		
		foreach ($events as $event)
		{
			$newDateFormat = Carbon::createFromFormat('Y-m-d H:i:s', $event->datetime);
			$dataEvent[$newDateFormat->toDateString()][] = $event;
		}
		
		return $dataEvent;
	}
}