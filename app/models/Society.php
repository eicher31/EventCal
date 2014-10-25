<?php

namespace EventCal\Models;

class Society extends BaseModel 
{
	protected $table = 'societies';
		
	public function user()
	{
		return $this->belongsTo('User');
	}
	
	public function events()
	{
		return $this->hasMany('EventCal\Models\Event');
	}
}