<?php

class AdminNotification extends Eloquent{
	protected $table = 'admin_notifications';

    public function company(){
        return $this->belongsTo('Company', 'company_id');   
    }
}