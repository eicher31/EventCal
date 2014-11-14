<?php

use Carbon\Carbon;

class EventsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('events')->insert(array(
			array(
			'society_id'=>1,
			'name'=>'Cours de dance',
			'description'=>'Cours de dance à Mervelier',
			'datetime' => Carbon::now()->toDateTimeString(),
			'address'=>"",
			'locality_id'=>1,
			'category_id'=>1,
			),

		));
	}
}