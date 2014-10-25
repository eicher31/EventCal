<?php

namespace EventCal\Models;

class Event extends BaseModel
{
	protected $table = 'events';

	public function soctiety()
	{
		return $this->belongsTo('Society');
	}
	
}