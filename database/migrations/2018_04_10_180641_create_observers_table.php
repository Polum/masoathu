<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateObserversTable extends Migration {

	public function up()
	{
		Schema::create('observers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('polling_station_id')->unsigned();
			$table->string('name');
			$table->string('phone_number', 12);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('observers');
	}
}