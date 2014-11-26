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
		'date' => 'required|date_format:"Y-m-d"',
		'time' => 'date_format:"H:i"',
		//'datetime' => 'required|date_format:"Y-m-d H:i:s"',
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
	
	/**
	 * Returns the datetime as Carbon's date
	 * @return \Carbon
	 */
	public function getCarbonDate()
	{
		return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes["datetime"]);
	}
	
	/**
	 * Return the date part as Y-m-d formatted string
	 * @return string
	 */
	public function getDate()
	{
		return $this->getCarbonDate()->format('d.m.Y');
	}
	
	/**
	 * Return a time formatted as H:i, empty if hour is 00:00
	 * @return string
	 */
	public function getTime()
	{
		$hour = $this->getCarbonDate()->format('H:i');
		return $hour != "00:00" ? $hour : "";
	}
	
	/**
	 * Check if the current event is editable by the current authed user
	 * @param Event $event
	 * @return boolean
	 */
	public function isEditable()
	{
		$user = \Auth::user();
		
		if ($user->is_admin)
		{
			return true;
		}
		
		$society = $user->society;
		return $society && $this->attributes['society_id'] == $society->id;
	}
	
	/**
	 * Create an event if data are valid
	 * Returns the created event on success, or the errors on failure
	 * @param array $data
	 * @return \Illuminate\Validation\Validator|\EventCal\Models\Event
	 */
	public static function creatEvent(array $data)
	{
		self::setDateTime($data);
		
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
	 * Update an existing event
	 * Returns false if the event cannot be edited by the current user, true on success, array of errors on fail
	 * @param int $id
	 * @param array $data
	 * @return unknown|boolean
	 */
	public static function editEvent($id, array $data)
	{
		self::setDateTime($data);
		
		$event = self::find($id);
		
		if (!$event->isEditable())
		{
			return false;
		}
		
		$exceptKey = array_keys(self::$validateRules);
		$exceptionValidation = self::buildExceptValidation($exceptKey, $data);
		
		$errors = self::validate($data, $exceptionValidation);
		
		if ($errors !== true)
		{
			return $errors;
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
	 * Delete an event if the event can be edited by the current authed user
	 * @param int $id
	 * @return boolean
	 */
	public static function deleteEvent($id)
	{
		$event = self::find($id);
		
		if (!$event->isEditable())
		{
			return false;
		}
		
		$event->delete();
		return true;
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
	 * Show a array of event by week or by event
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
	
	/**
	 * Allow to check if there are a empty string
	 * @param array $data
	 */
	private static function setDateTime(array &$data)
	{
		$data['date'] = Carbon::createFromFormat('d.m.Y', $data['date'])->format('Y-m-d');
		
		if(empty($data['time']))
		{
			$data['time'] = "00:00";
		}

		$data['datetime'] = $data['date']." ". $data['time'];
		
	}
}