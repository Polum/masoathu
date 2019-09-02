<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePresidentialCandidatesTable extends Migration {

	public function up()
	{
		Schema::create('presidential_candidates', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('country_id')->unsigned();
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('presidential_candidates');
	}
}