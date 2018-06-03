<?php

class Page extends Eloquent{
	protected $table = 'pages';
    protected $tmp_image = '';

	public function getImage($img = ''){
        if(!$img) $img = $this->image;
        return Config::get('ilosool.uploads.pages_dir') . '/' . $img;
    }

    public static function getDir(){
        return Config::get('ilosool.uploads.pages_dir');
    }
    
    public static function boot()
    {
        parent::boot();

        Page::deleting(function($page){
            if($page->image && file_exists($page->getImage())){
               File::delete($page->getImage());
            }
        });

        Page::updating(function($page){
            if($page->image && $page->tmp_image && $page->tmp_image != $page->image && file_exists($page->getImage($page->tmp_image))){
               File::delete($page->getImage($page->tmp_image));
               $page->tmp_image = '';
            }
        });
    }

    public function setImageAttribute($val){
        if(isset($this->attributes['image']) && $this->attributes['image'] != $val){ 
            $this->tmp_image = $this->attributes['image'];
            $this->attributes['image'] = $val;
        }else{
            $this->attributes['image'] = $val;
        }
    }

	//validate
    public static $validationRules = array('title' =>'required',
						'content' =>'required|min:20',
						'slug' =>'required');

    public static function validate($data){
    	return Validator::make($data, static::$validationRules);
    }
    
}