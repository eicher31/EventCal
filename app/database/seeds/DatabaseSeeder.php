<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		
		$this->call('DeleteTableSeeder');
		
		$this->call('UsersTableSeeder');
		$this->call('LocalitiesTableSeeder');
		$this->call('SocietiesTableSeeder');
		$this->call('EventsCategoriesTableSeeder');
		$this->call('EventsTableSeeder');
	}
}
