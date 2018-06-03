<?php

use Illuminate\Database\Migrations\Migration;

class CreateCompanyHiddenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('company_hidden', function(Blueprint $table)
		{
			$table->increments('id');
			$table->boolean('name');
			$table->boolean('name_arabic');
			$table->boolean('started');
			$table->boolean('address');
			$table->boolean('phone');
			$table->boolean('email');
			$table->boolean('website');
			$table->boolean('description');
			$table->boolean('logo');
			$table->boolean('video');
			$table->boolean('map');
			$table->boolean('social');
			$table->boolean('type');
			$table->boolean('tags');
			$table->boolean('yield');
			$table->boolean('price_shares');
			$table->boolean('number_shares');
			$table->boolean('percentage');
			$table->boolean('price_earning');
			$table->boolean('price_sqf');
			$table->boolean('number_sqf');
			$table->boolean('growth_rate');
			$table->boolean('startdate');
			$table->boolean('enddate');
			$table->boolean('target');
			$table->boolean('current');
			$table->boolean('min_investment');
			$table->boolean('geo_interests');
			$table->boolean('leverage_ratio');
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
		Schema::drop('company_hidden');
	}

}