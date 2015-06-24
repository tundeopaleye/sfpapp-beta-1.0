<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reposts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('body');
			$table->string('user_id');
			$table->integer('repostable_id');
			$table->string('repostable_type');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reposts');
	}

}
