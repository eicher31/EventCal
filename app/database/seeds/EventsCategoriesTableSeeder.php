<?php

class EventsCategoriesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('events_categories')->insert(array(
			array(
				'name' => 'Concert',
				'color' => 'red',
			),
			
			array(
				'name' => 'Exposition',
				'color' => 'green',
			),

			array(
				'name' => 'Fête de village',
				'color' => 'blue',
			),
		));
	}
}