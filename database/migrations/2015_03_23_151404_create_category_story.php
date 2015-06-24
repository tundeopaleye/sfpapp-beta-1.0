<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryStory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('category_story', function(Blueprint $table)
		{
			$table->integer('category_id')->unsigned()->nullable();
			$table->foreign('category_id')->references('id')
				->on('categories')->onDelete('cascade');

			$table->integer('story_id')->unsigned()->nullable();
			$table->foreign('story_id')->references('id')
				->on('stories')->onDelete('cascade');
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
		Schema::drop('category_story');
	}

}
