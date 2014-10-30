<?php

namespace EventCal\Models;

class Society extends BaseModel 
{
	/**
	 * table name on DB
	 * @var string
	 */
	protected $table = 'societies';
	
	/**
	 * Fields that are fillable with fill()
	 * @var array
	 */
	protected $fillable = array('name', 'description', 'website', 'logo', 'telephone', 'address', 'locality_id');
	
	/**
	 * Fields that cannot be filled with fill()
	 * @var array
	 */
	protected $guarded = array('id', 'user_id', 'is_public');
	
	/**
	 * Validation rules of a society
	 * @var array
	 */
	protected static $validateRules = array(
		'name' => 'required',
		'description' => 'required',
		'website' => 'url',
		'logo' => '',
		'telephone' => '',
		'address' => 'required',
		'locality_id' => 'required|exists:localities,id',
	);
	
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