<?php

namespace EventCal\Models;

class Locality extends BaseModel
{
	/**
	 * Table name on DB
	 * @var string
	 */
	protected $table = 'localities';
	
	/**
	 * A locality has many societies
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function societies()
	{
		return $this->hasMany('EventCal\Models\Society');
	}
	
	/**
	 * A locality has many events
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function events()
	{
		return $this->hasMany('EventCal\Models\Event');
	}
	
	/**
	 * concatenation of code and city
	 * @return string
	 */
	public function codeCity()
	{
		return $this->attributes['code'] . " " . $this->attributes['city'];
	}
	
	/**
	 * Returns an array of the localities, ordered by code, with format: id => code-city
	 * @return array
	 */
	public static function getLocalitiesArray()
	{
		$locality = Locality::orderBy('code')->get();
		
		$local = array();
		
		foreach ($locality as $l)
		{
			$local[$l->id] = $l->codeCity();
				
		}
		
		return $local;
	}
}