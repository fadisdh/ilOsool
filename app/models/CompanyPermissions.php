<?php

class CompanyPermissions extends Eloquent{
	protected $table = 'company_permissions';

	public function user(){
        return $this->belongsTo('User', 'user_id');
    }

    public function company(){
        return $this->belongsTo('Company', 'company_id');   
    }

}