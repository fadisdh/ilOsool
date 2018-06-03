<?php

class Bookmark extends Eloquent{
	protected $table = 'bookmarks';

	public function folder(){
        return $this->belongsTo('Folder', 'folder_id');   
    }

    public function user(){
        return $this->belongsTo('User', 'user_id');   
    }

    public function company(){
        return $this->belongsTo('Company', 'company_id');   
    }
}