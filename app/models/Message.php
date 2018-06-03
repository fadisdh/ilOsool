<?php

class Message extends Eloquent{
	protected $table = 'messages';

	public function sender(){
		return $this->belongsTo('User', 'sender_id');
	}

	public function receiver(){
		return $this->belongsTo('User', 'receiver_id');
	}

	public function reference()
    {
        return $this->morphTo();
    }
}