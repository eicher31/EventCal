<?php

namespace EventCal\Models;

class Event extends BaseModel
{
	protected $table = 'events';

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
	public function eventCategory()
	{
		return $this->belongsTo('EventCal\Models\EventCategory');
	}
}