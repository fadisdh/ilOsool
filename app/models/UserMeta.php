<?php

class UserMeta extends Eloquent{
	protected $table = 'users_meta';

	public function user(){
		return $this->belongsTo('User', 'user_id');
	}
}