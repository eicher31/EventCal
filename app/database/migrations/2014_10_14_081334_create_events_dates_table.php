<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsDatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events_dates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('date');
			$table->time('hour');
			$table->integer('event_id')->unsigned();
			$table->foreign('event_id')->references('id')->on('events');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events_dates');
	}

}
