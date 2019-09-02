<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConstituenciesTable extends Migration {

	public function up()
	{
		Schema::create('constituencies', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('district_id')->unsigned();
			$table->string('name');
			$table->string('latitude');
			$table->string('longitude');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('constituencies');
	}
}