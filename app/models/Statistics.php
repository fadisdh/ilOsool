<?php

class Statistics extends Eloquent{
	protected $table = 'statistics';

	public function user(){
		return $this->belongsTo('User', 'user_id');
	}

	public function company(){
		return $this->belongsTo('Company', 'company_id');
	}
}