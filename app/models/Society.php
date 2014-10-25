<?php

namespace EventCal\Models;

class Society extends BaseModel 
{
	protected $table = 'societies';
		
	public function user()
	{
		return $this->belongsTo('User');
	}
	
	public function event()
	{
		return $this->hasMany('Event');
	}
}