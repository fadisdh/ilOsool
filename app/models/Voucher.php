<?php

class Voucher extends Eloquent{
	protected $table = 'vouchers';

    public function user(){
        return $this->belongsTo('User', 'user_id');   
    }

     public function company(){
        return $this->belongsTo('Company', 'company_id');   
    }

    //validate
    public static $validationRules = array(
    	'user' => 'required',
    	'company' => 'required',
		'type' => 'required',
		'data' => 'required',
		'price' => 'required|numeric',
		'start_date' => 'required',
		'end_date' => 'required',
		);

    public static function validate($data){
    	return Validator::make($data, static::$validationRules);
    }
    
}