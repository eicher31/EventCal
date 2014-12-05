<?php

class DeleteTableSeeder extends Seeder {

	public function run()
	{	
		DB::table('events')->delete();
		DB::table('events_categories')->delete();
		DB::table('societies')->delete();
		DB::table('localities')->delete();
		DB::table('users')->delete();
	}
}