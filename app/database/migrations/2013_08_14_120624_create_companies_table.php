<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('companies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('slug');
			$table->string('name');
			$table->string('name_arabic');
			$table->string('started');
			$table->string('address');
			$table->string('city');
			$table->string('country');
			$table->decimal('cfb');
			$table->string('phone');
			$table->string('email');
			$table->string('website');
			$table->text('description');
			$table->text('brief');
			$table->string('image');
			$table->string('logo');
			$table->string('video');
			$table->text('map');
			$table->text('social');
			$table->string('type');
			$table->text('tags');
			$table->decimal('yield');
			$table->decimal('price_shares');
			$table->integer('number_shares');
			$table->decimal('leverage_ratio');
			$table->string('percentage');
			$table->string('price_earning');
			$table->decimal('price_sqf');
			$table->integer('number_sqf');
			$table->decimal('growth_rate');
			$table->string('deal_name');
			$table->date('startdate');
			$table->date('enddate');
			$table->decimal('target');
			$table->integer('current');
			$table->decimal('min_investment');
			$table->text('geo_interests');
			$table->string('investment_stage');
			$table->string('sector');
			$table->string('investment_type');
			$table->string('investment_style');
			$table->string('deal_size');
			$table->string('status');
			$table->boolean('approved');
			$table->boolean('featured');
			$table->boolean('show_contact');
			$table->softDeletes();
			$table->timestamps();


			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('companies');
	}

}