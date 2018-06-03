<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deals', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->text('description');
			$table->text('brief');
			$table->string('img');
			$table->string('video');
			$table->string('type');
			$table->date('startdate');
			$table->integer('duration');
			$table->integer('target');
			$table->integer('current');
			$table->text('tags');
			$table->text('geo_interest');
			$table->string('investment_type');
			$table->string('deal_size');
			$table->string('status');
			$table->integer('company_id')->unsigned();
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
		Schema::drop('deals');
	}

}