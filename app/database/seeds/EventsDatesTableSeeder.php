<?php

class EventsDatesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('events_dates')->insert(array(
			array(
				'event_id' => 1,
				'date' => '2014-12-31',
				'hour' => '10:10',
			),
		));
	}
}