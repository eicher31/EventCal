<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->insert(array(
			array(
				'email' 		=> 'mathieu.rosser@he-arc.ch',
				'password'		=> Hash::make('123456'),
				'first_name'	=> 'Mathieu',
				'last_name'		=> 'Rosser',
				'is_admin'		=> 1,
				'is_actif'		=> 1,
			),
			array(
				'email' 		=> 'stephane.eicher@he-arc.ch',
				'password'		=> Hash::make('123456'),
				'first_name'	=> 'Stéphane',
				'last_name'		=> 'Eicher',
				'is_admin'		=> 1,
				'is_actif'		=> 1,
			),
			array(
				'email' 		=> 'andy.cheung@he-arc.ch',
				'password'		=> Hash::make('qwertz'),
				'first_name'	=> 'Andy',
				'last_name'		=> 'Cheung',
				'is_admin'		=> 1,
				'is_actif'		=> 1,
			),
		));
	}
}