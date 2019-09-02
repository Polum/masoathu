<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessageOwnersTable extends Migration {

	public function up()
	{
		Schema::create('message_owners', function(Blueprint $table) {
			$table->increments('id');
			$table->string('username', 255);
			$table->string('signature', 255);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('message_owners');
	}
}