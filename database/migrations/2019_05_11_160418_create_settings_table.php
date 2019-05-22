<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('email', 100);
			$table->string('phone', 14);
			$table->text('social');
			$table->text('facebook');
			$table->text('about_us');
			$table->text('terms_conditions');
			$table->text('twitter');
			$table->text('youtube');
			$table->text('whatsapp');
			$table->text('google_plus');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}