<?php

class Rule extends Eloquent{
	protected $table = 'rules';
    protected $rules_tmp;

    protected $tmp = array();

    public function toArr($val, $key = 'tmp'){
        if(isset($this->tmp[$key])) return $this->tmp[$key];

        $this->tmp[$key] = json_decode($val, true);
        return $this->tmp[$key];
    }

	public function users(){
		return $this->hasMany('User', 'user_id');
	}

	public static function boot()
    {
        parent::boot();

        Rule::deleting(function($rule){
        	if($rule->id < 7){
        		return false;
        	}else{
        		User::where('rule_id', '=', $rule->id)->update(array('rule_id' => Config::get('ilosool.default_rule')));
        	}
        });
    }

    public static function convertArray($array)
    {
        $return = array();
        foreach ($array as $key => $value)
        {
            $exploded = explode('.', $value);
            $return[$exploded[0]][$exploded[1]] = $value;
        }

        return $return;
    }

    public function getAllPermissions(){
        return Config::get('ilosool.permissions');
    }

    public function hasPermission($per){
        if(!$per) return false;
        if(!$this->permissions) return false;
        return in_array($per, $this->permissions);
    }

    public function getPermissionsAttribute($val){
        return $this->toArr($val, 'permissions');
    }

    public function setPermissionsAttribute($val){
        if(isset($this->tmp['permissions'])) unset($this->tmp['permissions']); 
        $this->attributes['permissions'] = json_encode($val);
    }

    //validate
    public static $validationRules = array('name' =>'required',
                                            'permissions' =>'required');

    public static function validate($data){
        return Validator::make($data, static::$validationRules);
    }

    public static function getRuleName($id){

        $rule = Rule::where('id', '=', $id)->first();

        return ($rule) ? $rule->name : null;
    }
}