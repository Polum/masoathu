<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOpenReportsTable extends Migration {

	public function up()
	{
		Schema::create('open_reports', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('incident_category')->unsigned();
			$table->text('reports_content');
			$table->string('latitude');
			$table->string('longitude');
			$table->string('location_name');
			$table->tinyInteger('approved');
			$table->tinyInteger('verified');
			$table->timestamps();
			$table->tinyInteger('public')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('open_reports');
	}
}