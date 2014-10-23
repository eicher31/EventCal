<?php

class BaseModel extends Eloquent {
	
	/**
	 * Deactivate timestamps fields
	 *
	 * @var bool
	 */
	public $timestamps = false;
	
	/**
	 * Validation rules of the model
	 * This associative array is set by each subclass
	 * 
	 * @var array
	 */
	protected static $validateRules = array();

	/**
	 * Validate data based on the model rules. Some rules can be excepted if needed.
	 * In update mode, the ID of the model instance can be given for each unique field
	 * 
	 * @param array $data
	 * @param array $except
	 * @param array $uniqueId
	 * @return \Illuminate\Validation\Validator
	 */
	public static function validate(array $data, array $except = array(), array $uniqueId = array())
	{
		// define rules for validation
		$validationRules = array_except(static::$validateRules, $except);
		// set id to unique fields
		foreach ($uniqueId as $unique => $id)
		{
			$validationRules[$unique] .= ',' . $id;
		}
		
		// create validator
		return Validator::make($data, $validationRules);
	}
	
}
