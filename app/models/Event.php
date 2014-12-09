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
	 * Activate timestamps fields
	 *
	 * @var bool
	 */
	public $timestamps = true;
	
	/**
	 * Validation rules of an event
	 *
	 * @var array
	 */
	protected static $validateRules = array(
		'society_id' => 'required|exists:societies,id',
		'name' => 'required',
		'description' => 'required',
		'date' => 'required|date_format:"d.m.Y"',
		'time' => 'date_format:"H:i"',
		'address' => '',
		'locality_id' => 'required|exists:localities,id',
		'category_id' => 'required|exists:events_categories,id',
	);
	
	/**
	 * Order models by this column on listing
	 * @var string
	 */
	protected static $orderBy = "datetime";
		
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
	 * Allow set date and time of current event
	 * @param $date
	 * @param $time
	 */
	private function setDateTime($date, $time)
	{
		$date = Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d');
	
		if (empty($time))
		{
			$time = "00:00:00";
		}
	
		$this->attributes['datetime'] = $date . " " . $time;
	}
	
	/**
	 * Check if the current event is editable by the current authed user
	 * @param Event $event
	 * @return boolean
	 */
	public function isEditable()
	{
		$user = \Auth::user();
		if (!$user)
		{
			return false;
		}
		
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
		$event->setDateTime($data['date'], $data['time']);
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
		$event->setDateTime($data['date'], $data['time']);
		
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
	 * Get listing of events, grouped by month in an associtive array [month => [events...]]
	 * The listing can begging at specified date or with a society
	 * @param Carbon $dateFrom
	 * @param string $chronologicalOrder
	 * @param number $societyId
	 * @return array
	 */
	public static function getListingEvents(Carbon $dateFrom = null, $chronologicalOrder = true, $societyId = 0)
	{
		$events = self::with('society', 'category');
		
		if ($dateFrom)
		{
			$events->where('datetime', '>=', $dateFrom);
		}
		
		$events->orderBy(self::$orderBy, $chronologicalOrder ? "ASC" : "DESC");
		
		if ($societyId)
		{
			$events->where('society_id', '=', $societyId);
		}
				
		$outputByMonth = array();
		
		foreach ($events->get() as $event)
		{
			$dateEvent = $event->getCarbonDate();
			$outputByMonth[$dateEvent->format('m.Y')][] = $event;
		}
		
		return $outputByMonth;
	}
	
}
