<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDistrictsTable extends Migration {

	public function up()
	{
		Schema::create('districts', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('region_id')->unsigned();
			$table->string('name');
			$table->string('latitude');
			$table->string('longitude');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('districts');
	}
}