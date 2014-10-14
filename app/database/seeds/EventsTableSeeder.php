<?php

class EventsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('events')->insert(array(
			array(
			'society_id'=>1,
			'name'=>'Cours de dance',
			'description'=>'Cours de dance à Mervelier',
			'address'=>null,

			'locality_id'=>null,
			'category_id'=>1,
			),

		));
	}
}