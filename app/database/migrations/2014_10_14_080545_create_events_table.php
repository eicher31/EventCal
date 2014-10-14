<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('society_id')->unsigned();
			$table->foreign('society_id')->references('id')->on('societies');
			
			$table->string('name',255);
			$table->text('description');
			$table->string('address',255)->nullable();
			
			$table->integer('locality_id')->unsigned()->nullable();
			$table->foreign('locality_id')->references('id')->on('localities');
			
			$table->integer('category_id')->unsigned();
			$table->foreign('category_id')->references('id')->on('events_categories');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}
