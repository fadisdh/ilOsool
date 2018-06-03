<?php

class Attachment extends Eloquent{
	protected $table = 'attachments';
	protected $tmp_file = '';

	public function company(){
		return $this->belongsTo('Company', 'company_id');
	}

	public function users(){
		return $this->belongsToMany('User', 'attachments_permissions', 'attachment_id', 'user_id');
	}

	public function getFullPath(){

		return  URL::route('attachment.download', array('company_id' => $this->company_id,'id'=> $this->id));
	}

	public static function getCompanyAttachments($id, $access = 'public'){

        $attachments = Attachment::where('company_id', '=', $id)->Where('access','=', $access)->get();

        return ($attachments) ? $attachments : null;
    }

	public static function getAllCompanyAttachments($id){

        $attachments = Attachment::where('company_id', '=', $id)->get();

        return ($attachments) ? $attachments : null;
    }    

    public static function getDir($company_id){
        return sprintf(Config::get('ilosool.uploads.attachments_dir'), $company_id);
    }

    public static function boot()
    {
        parent::boot();

        Attachment::deleting(function($attachment){
            if($attachment->url && file_exists($attachment->getFullPath($attachment->company_id))){
               File::delete($attachment->getFullPath($attachment->company_id));
            }
        });

        Attachment::updating(function($attachment){
            if($attachment->url && $attachment->tmp_file && $attachment->tmp_file != $attachment->url && file_exists($attachment->getFullPath($attachment->company_id))){
               File::delete($attachment->getFullPath($attachment->company_id));
               $attachment->tmp_file = '';
            }
        });
    }

	//validate
    public static $validationRules = array(
    	'name' => 'required|min:5',
		'access' => 'required',
		'file' => 'required|mimes:pdf,doc,docx,txt,xls,xlsx,jpg,jpeg,gif,png,ppt,pptx'
	);

    public static function validate($data){
    	return Validator::make($data, static::$validationRules);
    }

    //validate Edit
    public static $validationEditRules = array(
        'name' => 'required|min:5',
        'access' => 'required',
        'file' => 'mimes:pdf,doc,docx,txt,xls,xlsx,jpg,jpeg,gif,png,ppt,pptx'
    );

    public static function validateEdit($data){
        return Validator::make($data, static::$validationEditRules);
    }
}