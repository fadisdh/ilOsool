<?php

class RequestDeal extends Eloquent{
	protected $table = 'request_deal';
    protected $tmp = array();

    public function user(){
        return $this->belongsTo('User', 'user_id');
    }

    public function messages()
    {
        return $this->morphMany('Message', 'reference');
    }

    public function toArr($val, $key = 'tmp'){
        if(isset($this->tmp[$key])) return $this->tmp[$key];

        $this->tmp[$key] = json_decode($val, true);
        return $this->tmp[$key];
    }

    //Geo Interests
    public function setGeoInterestsAttribute($val){
        if(isset($this->tmp['geo_interests'])) unset($this->tmp['geo_interests']); 
        $this->attributes['geo_interests'] = json_encode($val);
    }

    public function getGeoInterestsAttribute($val){
        return $this->toArr($val, 'geo_interests');
    }

    //investment_stage
    public function setInvestmentStageAttribute($val){
        if(isset($this->tmp['investment_stage'])) unset($this->tmp['investment_stage']); 
        $this->attributes['investment_stage'] = json_encode($val);
    }

    public function getInvestmentStageAttribute($val){
        return $this->toArr($val, 'investment_stage');
    }

    //investment_sector
    public function setInvestmentSectorAttribute($val){
        if(isset($this->tmp['investment_sector'])) unset($this->tmp['investment_sector']); 
        $this->attributes['investment_sector'] = json_encode($val);
    }

    public function getInvestmentSectorAttribute($val){
        return $this->toArr($val, 'investment_sector');
    }

    //investment_type
    public function setInvestmentTypeAttribute($val){
        if(isset($this->tmp['investment_type'])) unset($this->tmp['investment_type']); 
        $this->attributes['investment_type'] = json_encode($val);
    }

    public function getInvestmentTypeAttribute($val){
        return $this->toArr($val, 'investment_type');
    }

    //investment_style
    public function setInvestmentStyleAttribute($val){
        if(isset($this->tmp['investment_style'])) unset($this->tmp['investment_style']); 
        $this->attributes['investment_style'] = json_encode($val);
    }

    public function getInvestmentStyleAttribute($val){
        return $this->toArr($val, 'investment_style');
    }

    //deal_size
    public function setDealSizeAttribute($val){
        if(isset($this->tmp['deal_size'])) unset($this->tmp['deal_size']); 
        $this->attributes['deal_size'] = json_encode($val);
    }

    public function getDealSizeAttribute($val){
        return $this->toArr($val, 'deal_size');
    }

    //validate
    public static $validationRules = array(
        'geo_interests' => 'required',
        'deal_size' => 'required',
        'brief' => 'required',
    );

    public static function validate($data){
        return Validator::make($data, static::$validationRules);
    }

    public function format($number) {
        $prefixes = 'kMGTPEZY';

        if($number >= 10000){
            for ($i=-1; $number>=1000; ++$i) {
                $number /= 1000;
            }
            return number_format($number, 2, ',', '.') . $prefixes[$i];

        }elseif ($number >= 1000) {
            
            return number_format($number, 2, '.', ',');
        }

        return round($number, 2);
    }
}