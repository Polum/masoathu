<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCandidateResultsTable extends Migration {

	public function up()
	{
		Schema::create('candidate_results', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('polling_station_id')->unsigned();
			$table->integer('candidate_id')->unsigned();
			$table->timestamps();
			$table->integer('result_count');

		});
	}

	public function down()
	{
		Schema::drop('candidate_results');
	}
}