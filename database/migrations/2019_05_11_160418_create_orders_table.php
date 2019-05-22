<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 100);
			$table->string('age', 10);
			$table->integer('blood_type_id');
			$table->integer('bags_num');
			$table->string('hospital_name', 100);
			$table->text('hospital_address');
			$table->decimal('longitud', 10,8);
			$table->decimal('latitude', 10,8);
			$table->integer('city_id');
			$table->integer('client_id');
			$table->string('phone', 14);
			$table->text('notice');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}