<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePollingStationsTable extends Migration {

	public function up()
	{
		Schema::create('polling_stations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('district_id')->unsigned();
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('polling_stations');
	}
}