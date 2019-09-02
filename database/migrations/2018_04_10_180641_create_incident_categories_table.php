<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIncidentCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('incident_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('incident_categories');
	}
}