<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrafficChannelTypesTable extends Migration {

	public function up()
	{
		Schema::create('traffic_channel_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('type_name', 25);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('traffic_channel_types');
	}
}