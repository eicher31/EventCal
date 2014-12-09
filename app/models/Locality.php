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
	 * Order models by this column on listing
	 * @var string
	 */
	protected static $orderBy = "code";
	
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
	 * Representational name of the model data
	 * @return string
	 */
	public function getName()
	{
		return $this->attributes['code'] . " " . $this->attributes['city'];
	}
	
	/**
	 * Find localities starting with a given NPA
	 * @param string $npa
	 */
	public static function getStartingWithNpa($npa)
	{
		return self::where('code', 'LIKE', $npa . '%')->orderBy(self::$orderBy)->get();
	}
	
	/**
	 * Returns all existing localities
	 * @return array
	 */
	public static function getAll()
	{
		return self::orderBy(self::$orderBy)->get();
	}
	
}