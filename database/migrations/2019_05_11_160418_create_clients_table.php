<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
            $table->string('name', 50);
            $table->string('email', 100);
            $table->string('phone', 14);
            $table->string('password', 150);
            $table->date('birth_date');
            $table->integer('city_id');
            $table->integer('government_id');
            $table->integer('blood_type_id');
            $table->string('code', 10)->unique()->nullable();
            $table->string('api_token', 60)->unique()->nullable();
            $table->timestamps();
        });
	}

	public function down()
	{
		Schema::drop('clients');
	}
}