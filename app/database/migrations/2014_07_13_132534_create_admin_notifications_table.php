<?php

use Illuminate\Database\Migrations\Migration;

class CreateAdminNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_notifications', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('reference_id')->unsigned();
			$table->string('request');
			$table->text('title');
			$table->text('description');
			$table->timestamps();

			$table->foreign('company_id')->references('id')->on('companies');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin_notifications');
	}

}