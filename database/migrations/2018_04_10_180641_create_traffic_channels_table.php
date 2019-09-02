<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrafficChannelsTable extends Migration {

	public function up()
	{
		Schema::create('traffic_channels', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('traffic_channel_type_id')->unsigned();
			$table->string('name', 50);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('traffic_channels');
	}
}