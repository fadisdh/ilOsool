<?php

class Post extends Eloquent{
	protected $table = 'posts';
    protected $tmp_image = '';

	public function getImage($img = ''){
        if(!$img) $img = $this->image;
        return Config::get('ilosool.uploads.posts_dir') . '/' . $img;
    }

    public static function getDir(){
        return Config::get('ilosool.uploads.posts_dir');
    }

    public static function boot()
    {
        parent::boot();

        Post::deleting(function($post){
            if($post->image && file_exists($post->getImage())){
               File::delete($post->getImage());
            }
        });

        Post::updating(function($post){
            if($post->image && $post->tmp_image && $post->tmp_image != $post->image && file_exists($post->getImage($post->tmp_image))){
               File::delete($post->getImage($post->tmp_image));
               $post->tmp_image = '';
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
    									   'content' =>'required',
    									   'type' =>'required');

    public static function validate($data){
    	return Validator::make($data, static::$validationRules);
    }
}