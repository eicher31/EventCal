<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocietiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('societies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->unique();
			$table->foreign('user_id')->references('id')->on('users');
			
			$table->string('name',255);
			$table->text('description');
			$table->string('website',255);
			$table->string('logo',255);
			$table->string('telephone',255);
			$table->string('address',255);
			
			$table->integer('locality_id')->unsigned();
			$table->foreign('locality_id')->references('id')->on('localities');
			
			$table->boolean('is_public');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('societies');
	}

}
