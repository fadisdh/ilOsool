<?php

class Staff extends Eloquent{
	protected $table = 'staff';
	protected $tmp_image = '';

    public function company(){
		return $this->belongsTo('Company', 'company_id');
	}

    public static function getCompanyStaff($id, $access = 'public'){

        $staff = Staff::where('company_id', '=', $id)->Where('access','=', $access)->get();

        return ($staff) ? $staff : null;
    }

    public static function getAllCompanyStaff($id){

        $staff = Staff::where('company_id', '=', $id)->get();

        return ($staff) ? $staff : null;
    }    


    public function setImageAttribute($val){
        if(isset($this->attributes['image']) && $this->attributes['image'] != $val){ 
            $this->tmp_image = $this->attributes['image'];
            $this->attributes['image'] = $val;
        }else{
            $this->attributes['image'] = $val;
        }
    }

    public function getImage($img = ''){
		if(!$img) $img = $this->image;
        return static::getDir($this->company_id) . '/' . $img;
    }

    public static function getDir($company_id){
        return sprintf(Config::get('ilosool.uploads.staff_dir'), $company_id);
    }

    public static function boot()
    {
        parent::boot();

        Staff::deleting(function($staff){
            if($staff->image && file_exists($staff->getImage())){
               File::delete($staff->getImage());
            }
        });

        Staff::updating(function($staff){
            if($staff->image && $staff->tmp_image && $staff->tmp_image != $staff->image && file_exists($staff->getImage($staff->tmp_image))){
               File::delete($staff->getImage($staff->tmp_image));
               $staff->tmp_image = '';
            }
        });
    }

    //validate
    public static $validationRules = array(
    	'name' => 'required|min:5',
		'position' => 'required',
        'image' => 'mimes:jpg,jpeg,gif,png',
        'access' => 'required',
        'description' => 'required'
	);

    public static function validate($data){
    	return Validator::make($data, static::$validationRules);
    }
}