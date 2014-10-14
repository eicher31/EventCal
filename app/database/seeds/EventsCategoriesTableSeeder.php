<?php

class EventsCategoriesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('events_categories')->insert(array(
			array(
				'name' => 'concert',
				'color' => 'Red',
			),
			
			array(
				'name' => 'exposition',
				'color' => 'Green',
			),

			array(
				'name' => 'fête de village',
				'color' => 'Blue',
			),
		));
	}
}