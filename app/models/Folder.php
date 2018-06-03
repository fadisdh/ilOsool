<?php

class Folder extends Eloquent{
	protected $table = 'folders';

	public function user(){
        return $this->belongsTo('User', 'user_id');
    }

    public function bookmarks(){
        return $this->hasMany('Bookmark', 'folder_id');
    }

    public static $validationRules = array(
    	'folder_name' => 'required'
	);

    public static function validate($data){
        return Validator::make($data, static::$validationRules);
    }

    public static function getBookmarks($folder, $search = null){
        
        if($search){
            $bookmarks = Company::select('companies.*')->leftJoin('bookmarks', 'companies.id', '=', 'bookmarks.company_id')
                                    ->where('bookmarks.user_id', '=', Auth::user()->id)
                                    ->where('bookmarks.folder_id', '=', $folder)
                                    ->where('name','LIKE', '%' . $search . '%')
                                    ->paginate(Config::get('ilosool.rows_default'));
        }else{
            $bookmarks = Company::select('companies.*')->leftJoin('bookmarks', 'companies.id', '=', 'bookmarks.company_id')
                                    ->where('bookmarks.user_id', '=', Auth::user()->id)
                                    ->where('bookmarks.folder_id', '=', $folder)
                                    ->paginate(Config::get('ilosool.rows_default'));
        }
        return $bookmarks;
    }
}