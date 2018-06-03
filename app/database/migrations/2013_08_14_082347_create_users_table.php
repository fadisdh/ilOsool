<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_type');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('nickname');
			$table->string('email');
			$table->string('password');
			$table->string('image');
			$table->string('cover');
			$table->string('city');
			$table->string('country');
			$table->string('address');
			$table->string('website');
			$table->text('brief');
			$table->decimal('rbc');
			$table->decimal('rsc');
			$table->string('phone');
			$table->string('status');
			$table->boolean('subscribed');
			$table->string('confirmed');
			$table->string('interests');
			$table->boolean('pe_interested');
			$table->text('pe_geo_interests');
			$table->text('pe_sector_interests');
			$table->string('pe_investment_stage');
			$table->string('pe_investment_type');
			$table->string('pe_investment_style');
			$table->string('pe_deal_size');
			$table->boolean('vc_interested');
			$table->text('vc_geo_interests');
			$table->text('vc_sector_interests');
			$table->string('vc_investment_stage');
			$table->string('vc_investment_type');
			$table->string('vc_investment_style');
			$table->string('vc_deal_size');
			$table->boolean('re_interested');
			$table->text('re_geo_interests');
			$table->text('re_sector_interests');
			$table->string('re_investment_stage');
			$table->string('re_investment_type');
			$table->string('re_investment_style');
			$table->string('re_deal_size');
			$table->string('investor_type');
			$table->string('company_name');
			$table->integer('rule_id')->unsigned();
			$table->boolean('skiped');

			$table->boolean('hidden_name');
			$table->boolean('hidden_contact_info');
						
			$table->timestamps();
			
			$table->foreign('rule_id')->references('id')->on('rules');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}