<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('body', 255);
			$table->string('title');
			$table->integer('order_id');
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}