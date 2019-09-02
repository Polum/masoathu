<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegionsTable extends Migration {

	public function up()
	{
		Schema::create('regions', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('country_id')->unsigned();
			$table->string('name', 50);
			$table->timestamps();
			$table->string('latitude');
			$table->string('longitude');
		});
	}

	public function down()
	{
		Schema::drop('regions');
	}
}