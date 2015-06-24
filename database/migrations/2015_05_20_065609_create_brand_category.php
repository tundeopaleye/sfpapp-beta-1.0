<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandCategory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('brand_category', function(Blueprint $table)
		{
			$table->integer('category_id')->unsigned()->nullable();
			$table->foreign('category_id')->references('id')
				->on('categories')->onDelete('cascade');

			$table->integer('brand_id')->unsigned()->nullable();
			$table->foreign('brand_id')->references('id')
				->on('brands')->onDelete('cascade');
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
		Schema::drop('brand_category');
	}

}
