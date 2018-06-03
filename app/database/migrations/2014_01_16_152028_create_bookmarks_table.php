<?php

use Illuminate\Database\Migrations\Migration;

class CreateBookmarksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookmarks', function(Blueprint $table)
		{
			$table->increments('id');

			$table->integer('folder_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('company_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('folder_id')->references('id')->on('folders')->onDelete('CASCADE')->onUpdate('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
			$table->foreign('company_id')->references('id')->on('companies')->onDelete('CASCADE')->onUpdate('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bookmarks');	
	}

}