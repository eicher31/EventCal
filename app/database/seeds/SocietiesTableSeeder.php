<?php

class SocietiesTableSeeder extends Seeder {

	public function run()
	{
		DB::table('societies')->insert(array(
			array(
				'user_id' => 1,
				'name' => 'Microsoft FC Danceclub Mervelier',
				'description' => '',
				'website' => '',
				'logo' => '',
				'telephone' => '02002105552',
				'address' => 'route principale 27',
				'locality_id' => 1,
				'is_public' => 1
			)
		));
	}
}