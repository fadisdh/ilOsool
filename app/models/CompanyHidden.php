<?php

class CompanyHidden extends Eloquent{
	protected $table = 'company_hidden';

    public function company(){
		return $this->belongsTo('Company', 'company_id');
	}
}