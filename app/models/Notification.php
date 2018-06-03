<?php

class Notification extends Eloquent{
	protected $table = 'notifications';

    public function user(){
        return $this->belongsTo('User', 'user_id');   
    }

    public static function add($userId, $type, $message, $url, $title, $title_arabic, $message_arabic = '')
	{
		
		$notification = new Notification();
		$notification->user_id = $userId;
		$notification->type = $type;
		$notification->title = $title ? $title : trimWords($message, 10);
		$notification->message = $message;
		$notification->title_arabic = $title_arabic ? $title_arabic : trimWords($message, 10);
		$notification->message_arabic = $message_arabic ? $message_arabic : '';
		$notification->url = $url;
		$notification->viewed = False;
		$notification->save();
	}

	public function remove($id)
	{
		$notification = Notification::find($id);
		$notification->delete();
	}
	
}