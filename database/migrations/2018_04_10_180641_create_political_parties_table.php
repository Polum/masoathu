<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePoliticalPartiesTable extends Migration {

	public function up()
	{
		Schema::create('political_parties', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('political_parties');
	}
}