<?php

class Enquiry extends Eloquent{
	protected $table = 'enquiry';
	
	public static $validationRules = array(
		'contact' => array(
			'title' => 'required',
			'subject' => 'required',
			'email' =>'required|email',
			'message' => 'required'
		),

		'earlyaccess' => array(
			'firstname' => 'required|min:3',
			'lastname' => 'required|min:3',
			'email' =>'required|email',
			'phone' => 'regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,15',
			'country' => 'required',
			'city' => 'required'
		),
	);

	 public static function validate($data, $type){
        return Validator::make($data, static::$validationRules[$type]);
    }
}