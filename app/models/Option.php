<?php

class Option extends Eloquent{

	protected $table = 'options';

	public static function getAllByGroup(){
		$options = Option::all();
		$res = array();
		foreach($options as $option){
			$res[$option->group][] = $option;
		}

		return $res;
	}

	public static function getValue($key){
		$option = Option::where('key', '=', $key)->first();

		return ($option) ? $option->value : null;
	}

}