<?php

class LocalitiesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('localities')->insert(array(
			array(
				'code' => '2740',
				'city' => 'Moutier',
			),
			
			array(
				'code' => '2827',
				'city' => 'Mervelier',
			),
			
			array(
				'code' => '4053',
				'city' => 'Basel',
			)
		));
	}
}