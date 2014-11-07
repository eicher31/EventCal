<?php

namespace EventCal\Models;

use Carbon\Carbon;
class Event extends BaseModel
{
	/**
	 * Events table
	 * @var string
	 */
	protected $table = 'events';
	
	/**
	 * Fields that are fillable with fill()
	 * @var array
	 */
	protected $fillable = array('name', 'description', 'datetime', 'address', 'locality_id', 'category_id');
	
	/**
	 * Fields that cannot be filled with fill()
	 * @var array
	*/
	protected $guarded = array('id', 'society_id');
	
	/**
	 * Validation rules of an event
	 * @var array
	*/
	protected static $validateRules = array(
		'society_id' => 'required|exists:societies,id',
		'name' => 'required',
		'description' => 'required',
		'datetime' => 'required|date',
		'address' => 'required',
		'locality_id' => 'exists:localities,id,NULL',
		'category_id' => 'exists:events_categories,id',
	);
	
	/**
	 * An event belongs to a society
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function society()
	{
		return $this->belongsTo('EventCal\Models\Society');
	}
	
	/**
	 * An event can belong to a locality
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function locality()
	{
		return $this->belongsTo('EventCal\Models\Locality');
	}
	
	/**
	 * An events belongs to a category
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function category()
	{
		return $this->belongsTo('EventCal\Models\EventCategory');
	}
	
	public function getHour()
	{
		$newHourFormat = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes["datetime"]);
		return $newHourFormat->format('H:i');
	}
}