<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDealsMetaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('deals_meta', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->text('value');
			$table->string('type');
			$table->integer('deal_id')->unsigned();

			$table->foreign('deal_id')->references('id')->on('deals')->onDelete('CASCADE')->onUpdate('CASCADE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('deals_meta');
	}

}