<?php

class Newsletter extends Eloquent{
	protected $table = 'newsletters';

	//validate
    public static $validationRules = array('title' =>'required',
    									   'content' =>'required',
    									   'type' =>'required',
    									   'subject' =>'required',
    									   );

    public static function validate($data){
    	return Validator::make($data, static::$validationRules);
    }

    public static $useValidationRules = array('content' =>'required',
                                           'subject' =>'required',
                                           );

    public static function validateUse($data){
        return Validator::make($data, static::$useValidationRules);
    }
    
}