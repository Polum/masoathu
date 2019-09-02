<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('traffic_channel_id')->unsigned();
			$table->integer('message_owner_id')->unsigned();
			$table->text('message_content');
			$table->string('msg_latitude');
			$table->string('msg_longitude', 255);
			$table->timestamps();

		});
	}

	public function down()
	{
		Schema::drop('messages');
	}
}