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
	 * Order models by this column on listing
	 * @var string
	 */
	protected static $orderBy = "name";
	
	/**
	 * A category can have many events
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function events()
	{
		return $this->hasMany('EventCal\Models\Event');
	}
	
	/**
	 * Get all categories
	 */
	public static function getAllCategories()
	{
		return self::orderBy(self::$orderBy)->get();
	} 
	
	public static function createCategory(array $data)
	{
		$errors=static::validate($data);
		
		if($errors!==true)
		{
			return $errors;
		}
		
		$cat = new self();
		
		$cat->fill($data);
		
		$cat->save(); //Stock DB
		
		return true;
	}
	
	public static function  deleteCategory($id)
	{
		$cat=static::find($id);
		
		
		try
		{
			$cat->delete();	
			return true;
		}catch(\Exception $e)
		{
			return false;
		}
	}
	public static function updateCategory($id,$data)
	{
		$cat = static::find($id);
		
		
		$errors=static::validate($data);
		
		if($errors!==true)
		{
			return $errors;
		}
		
		$cat->fill($data);
		
		$cat->save();
		
		return true;
	} 
	
}