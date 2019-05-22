<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title', 100);
			$table->text('body');
			$table->string('img', 255)->nullable();
			$table->integer('category_id');
		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}