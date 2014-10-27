<?php

namespace EventCal\Models;

class EventCategory extends BaseModel
{
	protected $table = 'events_categories';
	
	/**
	 * A category can have many events
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function events()
	{
		return $this->hasMany('EventCal\Models\Event');
	}
}