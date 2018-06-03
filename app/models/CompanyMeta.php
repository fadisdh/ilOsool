<?php

class CompanyMeta extends Eloquent{
	protected $table = 'companies_meta';

	public function company(){
		return $this->belongsTo('Company', 'company_id');
	}
}