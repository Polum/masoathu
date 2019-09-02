<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCandidatesTable extends Migration {

	public function up()
	{
		Schema::create('candidates', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('constituency_id')->unsigned();
			$table->integer('gender_id')->unsigned();
			$table->integer('political_party_id')->unsigned();
			$table->string('first_name', 50);
			$table->string('last_name');
			$table->timestamps();
			$table->integer('age')->default('2');
		});
	}

	public function down()
	{
		Schema::drop('candidates');
	}
}