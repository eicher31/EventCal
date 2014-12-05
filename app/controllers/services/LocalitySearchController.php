<?php

namespace EventCal\Controllers\Services;

use EventCal\Models\Locality;
use EventCal\Controllers\BaseController;

class LocalitySearchController extends BaseController {
	
	/**
	 * Used in AJAX to find all localities
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function search()
	{
		if (!\Request::ajax())
		{
			\App::abort(403);
		}
				
		$localities = Locality::getAll();
		
		$response = array();
		
		foreach ($localities as $locality)
		{
			$response[] = array(
				'id'		=> $locality->id,
				'code'		=> $locality->code,
				'city'		=> $locality->city,
				'name'		=> $locality->getName(),
			);
		}
		
		return \Response::json($response);
	}

}
