<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 100);
			$table->string('email', 100);
			$table->string('phone', 14);
			$table->string('title', 100);
			$table->text('body');
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}