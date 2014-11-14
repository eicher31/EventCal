<?php

namespace EventCal\Models;

class EventCategory extends BaseModel
{
	/**
	 * Table of categories
	 * @var string
	 */
	protected $table = 'events_categories';
	
	/**
	 * Fields that are fillable with fill()
	 * @var array
	 */
	protected $fillable = array('name', 'color');

	/**
	 * Fields that cannot be filled with fill()
	 * @var array
	*/
	protected $guarded = array('id');
	
	/**
	 * Validation rules of a category
	 * @var array
	*/
	protected static $validateRules = array(
		'name' => 'required|unique:events_categories,name',
		'color' => 'required',
	);
	
	/**
	 * A category can have many events
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function events()
	{
		return $this->hasMany('EventCal\Models\Event');
	}
	
	/**
	 * 
	 * @return multitype:NULL
	 */
	//TODO : function unique in baseModel
	public static function getCategoriesArray()
	{
		$categories = self::orderBy('name')->get();
	
		$cat = array();
	
		foreach ($categories as $c)
		{
			$cat[$c->id] = $c->name;
	
		}
	
		return $cat;
	}
}