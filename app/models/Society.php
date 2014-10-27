<?php

namespace EventCal\Models;

class Society extends BaseModel 
{
	protected $table = 'societies';
	
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

}