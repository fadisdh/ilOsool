<?php

class Investment extends Eloquent{
	protected $table = 'investments';

	public function user(){
		return $this->belongsTo('User', 'user_id');
	}

	public function company(){
		return $this->belongsTo('Company', 'company_id');
	}

	public static $validationRules = array(
    	'amount'	=> 'required|numeric',
    	'value'		=> 'required|numeric',
		'status' 	=> 'required',
	);

	public static function validate($data){
        return Validator::make($data, static::$validationRules);
    }
}