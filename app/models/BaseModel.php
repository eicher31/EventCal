<?php

namespace EventCal\Models;
use Eloquent;

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
			if (isset($validationRules[$unique]))
			{
				$validationRules[$unique] .= ',' . $id;
			}
		}
		
		// create validator and validate
		$validator = \Validator::make($data, $validationRules);
		if ($validator->fails())
		{
			return $validator->messages();
		}
		
		return true;
	}
	
	/**
	 * Build validation exceptions if the specified data of rules are empty
	 * When an rule's data is empty, the rules is excepted and the data is removed from the data array
	 * 
	 * @param array $rules list of rules to except if value is empty in data
	 * @param array $data data to except, by reference: could be modified if a rule data is empty
	 * @return array rules which are excepted given data values
	 */
	public static function buildExceptValidation(array $rules, array &$data = array())
	{
		$exceptValidation = array();
		
		foreach ($rules as $r)
		{
			if (empty($data[$r]))
			{
				$exceptValidation[] = $r;
				unset($data[$r]);
			}
		}

		return $exceptValidation;
	}
	
}
