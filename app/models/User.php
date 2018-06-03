<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    protected $tmp_image = '';
	protected $fillable = array('email', 'password');

	protected $tmp = array();

	public function toArr($val, $key = 'tmp'){
		if(isset($this->tmp[$key])) return $this->tmp[$key];

		$this->tmp[$key] = json_decode($val, true);
		return $this->tmp[$key];
	}

	public function rule(){
		return $this->belongsTo('Rule', 'rule_id');
	}

	public function companies(){
		return $this->hasMany('Company', 'user_id');
	}

	public function userMeta(){
		return $this->hasMany('UserMeta', 'user_id');
	}

	public function investments(){
		return $this->hasMany('Investment', 'user_id');
	}

	public function statistics(){
		return $this->hasMany('Statistics', 'user_id');
	}

    public function bookmarks(){
        return $this->hasMany('Bookmark', 'user_id');
    }

	public function sentMessages(){
		return $this->hasMany('Message', 'sender_id');
	}

	public function recievedMessages(){
		return $this->hasMany('Message', 'reciever_id');
	}

    public function folders(){
        return $this->hasMany('Folder', 'user_id');
    }

     public function notifications(){
        return $this->hasMany('Notification', 'user_id');
    }

	public function attachments(){
		return $this->belongsToMany('Attachment', 'attachments_permissions', 'user_id', 'attachment_id');
	}

    public function getImage($img = ''){
        if(!$img) $img = $this->image;
        return static::getDir() . '/' . $img;
    }

    public function getCover($img = ''){
        if(!$img) $img = $this->cover;
        return static::getDir() . '/' . $img;
    }

    public static function getDir(){
        return sprintf(Config::get('ilosool.uploads.users_dir'));
    }

    public function setImageAttribute($val){
        if(isset($this->attributes['image']) && $this->attributes['image'] != $val){ 
            $this->tmp_image = $this->attributes['image'];
            $this->attributes['image'] = $val;
        }else{
            $this->attributes['image'] = $val;
        }
    }

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    /*
    Generete Confirmation Code
     */
    public function generateConfirmationCode($fill = true)
    {
       $code = md5($this->email . date('Ymdhis'));
       if($fill) $this->confirmed = $code;

       return $code;
    }

	public static function boot()
    {
        parent::boot();

        User::deleting(function($user){
        	if($user->id == 1 || $user->investments()->first()){
        		return false;
        	}else{
        		Company::where('user_id', '=', $user->id)->update(array('user_id' => Config::get('ilosool.default_user')));
        	}
        });

        User::created(function($user){
            if($user->rule_id == 3 || $user->rule_id == 5){
                $folder = new Folder();
                $folder->name = 'uncategorized';
                $folder->user_id = $user->id;
                $folder->default = true;
                $folder->save();
            }else{
                return false;
            }
        });
    }

    public static function getUserAttachments($id){

        $attachments = Attachment::with('company')
        	->join('attachments_permissions', 'attachments.id', '=', 'attachments_permissions.attachments_id')
           	->where('attachments_permissions.user_id', '=', $id)
           	->paginate(Config::get('ilosool.rows_default'));

           	$res = array();
           	if($attachments) foreach ($attachments as $attachment){
           		$res[$attachment->company->name][] = $attachment; 
           	}

        return $res;
    }

    public static function getUserCompanies($id){

        $companies = Company::where('user_id', '=', $id)->paginate(Config::get('ilosool.rows_default'));

        return ($companies) ? $companies : null;
    }

    public static function getUserRequests($id){

        $requests = RequestDeal::where('user_id', '=', $id)->paginate(Config::get('ilosool.rows_default'));

        return ($requests) ? $requests : null;
    }

    public static function getUserInvestments($id){

        $investments = Investment::with('company')
           	->where('investments.user_id', '=', $id)
            ->paginate(Config::get('ilosool.rows_default'));
           
        return ($investments) ? $investments : null;
    }

    public static function getUserWishlist($id){

        $wishlist = Company::leftJoin('wishlists', 'companies.id', '=', 'wishlists.company_id')
            ->where('wishlists.user_id', '=', $id)
            ->paginate(Config::get('ilosool.rows_default'));
           
        return ($wishlist) ? $wishlist : null;
    }

    public static function getUserFolders($id){

        $folders = Folder::where('user_id', '=', $id)
            ->orderBy('default', 'desc')
            ->paginate(Config::get('ilosool.rows_default'));
           
        return ($folders) ? $folders : null;
    }

    public static function getUserInvestmentsStatus($id, $status){

        $investments = Investment::with('company')
            ->where('investments.user_id', '=', $id)
            ->where('investments.status', '=', $status)
            ->paginate(Config::get('ilosool.rows_default'));
           
        return ($investments) ? $investments : null;
    }

    public static function getUserMessages($id){

        $messages = Message::with('sender')
                    ->where('receiver_id', '=', $id)
                    ->orWhere('sender_id', '=', $id)
                    ->orderBy('created_at', 'desc')
                    ->groupBy('message_id')
                    ->get();
           
        return ($messages) ? $messages : null;
    }

    public static function getUserSentMessages($id){

        $messages = Message::with('sender')
                    ->where('sender_id', '=', $id)
                    ->orderBy('created_at', 'desc')
                    ->get();
           
        return ($messages) ? $messages : null;
    }

    public static function getReceivedMessage($id){

        $messages = Message::with('sender')
                            ->where('id', '=', $id)
                            ->orWhere('message_id', '=', $id)
                            ->orderBy('created_at', 'asc')
                            ->get();
        
        return ($messages) ? $messages : null;
    }

    public function getInterestsAttribute($val){
    	return $this->toArr($val, 'interests');
    }

    public function setInterestsAttribute($val){
    	if(isset($this->tmp['interests'])) unset($this->tmp['interests']); 
    	$this->attributes['interests'] = json_encode($val);
    }

    public function getSubscribedRuleAttribute($val){
        return $this->toArr($val, 'subscribed_rule');
    }

    public function setSubscribedRuleAttribute($val){
        if(isset($this->tmp['subscribed_rule'])) unset($this->tmp['subscribed_rule']); 
        $this->attributes['subscribed_rule'] = json_encode($val);
    }

    /* PE */
    public function getPeGeoInterestsAttribute($val){
        return $this->toArr($val, 'pe_geo_interests');
    }

    public function setPeGeoInterestsAttribute($val){
        if(isset($this->tmp['pe_geo_interests'])) unset($this->tmp['pe_geo_interests']); 
        $this->attributes['pe_geo_interests'] = json_encode($val);
    }

    public function getPeSectorInterestsAttribute($val){
        return $this->toArr($val, 'pe_sector_interests');
    }

    public function setPeSectorInterestsAttribute($val){
        if(isset($this->tmp['pe_sector_interests'])) unset($this->tmp['pe_sector_interests']); 
        $this->attributes['pe_sector_interests'] = json_encode($val);
    }

    public function getPeInvestmentStageAttribute($val){
        return $this->toArr($val, 'pe_investment_stage');
    }

    public function setPeInvestmentStageAttribute($val){
        if(isset($this->tmp['pe_investment_stage'])) unset($this->tmp['pe_investment_stage']); 
        $this->attributes['pe_investment_stage'] = json_encode($val);
    }

    public function getPeInvestmentTypeAttribute($val){
        return $this->toArr($val, 'pe_investment_type');
    }

    public function setPeInvestmentTypeAttribute($val){
        if(isset($this->tmp['pe_investment_type'])) unset($this->tmp['pe_investment_type']); 
        $this->attributes['pe_investment_type'] = json_encode($val);
    }

    public function getPeInvestmentStyleAttribute($val){
        return $this->toArr($val, 'pe_investment_style');
    }

    public function setPeInvestmentStyleAttribute($val){
        if(isset($this->tmp['pe_investment_style'])) unset($this->tmp['pe_investment_style']); 
        $this->attributes['pe_investment_style'] = json_encode($val);
    }

    public function getPeDealSizeAttribute($val){
        return $this->toArr($val, 'pe_deal_size');
    }

    public function setPeDealSizeAttribute($val){
        if(isset($this->tmp['pe_deal_size'])) unset($this->tmp['pe_deal_size']); 
        $this->attributes['pe_deal_size'] = json_encode($val);
    }

    /* VC */
    public function getVcGeoInterestsAttribute($val){
        return $this->toArr($val, 'vc_geo_interests');
    }

    public function setVcGeoInterestsAttribute($val){
        if(isset($this->tmp['vc_geo_interests'])) unset($this->tmp['vc_geo_interests']); 
        $this->attributes['vc_geo_interests'] = json_encode($val);
    }

    public function getVcSectorInterestsAttribute($val){
        return $this->toArr($val, 'vc_sector_interests');
    }

    public function setVcSectorInterestsAttribute($val){
        if(isset($this->tmp['vc_sector_interests'])) unset($this->tmp['vc_sector_interests']); 
        $this->attributes['vc_sector_interests'] = json_encode($val);
    }

    public function getVcInvestmentStageAttribute($val){
        return $this->toArr($val, 'vc_investment_stage');
    }

    public function setVcInvestmentStageAttribute($val){
        if(isset($this->tmp['vc_investment_stage'])) unset($this->tmp['vc_investment_stage']); 
        $this->attributes['vc_investment_stage'] = json_encode($val);
    }

    public function getVcInvestmentTypeAttribute($val){
        return $this->toArr($val, 'vc_investment_type');
    }

    public function setVcInvestmentTypeAttribute($val){
        if(isset($this->tmp['vc_investment_type'])) unset($this->tmp['vc_investment_type']); 
        $this->attributes['vc_investment_type'] = json_encode($val);
    }

    public function getVcInvestmentStyleAttribute($val){
        return $this->toArr($val, 'vc_investment_style');
    }

    public function setVcInvestmentStyleAttribute($val){
        if(isset($this->tmp['vc_investment_style'])) unset($this->tmp['vc_investment_style']); 
        $this->attributes['vc_investment_style'] = json_encode($val);
    }

    public function getVcDealSizeAttribute($val){
        return $this->toArr($val, 'vc_deal_size');
    }

    public function setVcDealSizeAttribute($val){
        if(isset($this->tmp['vc_deal_size'])) unset($this->tmp['vc_deal_size']); 
        $this->attributes['vc_deal_size'] = json_encode($val);
    }

    /* RE */
    public function getReGeoInterestsAttribute($val){
        return $this->toArr($val, 're_geo_interests');
    }

    public function setReGeoInterestsAttribute($val){
        if(isset($this->tmp['re_geo_interests'])) unset($this->tmp['re_geo_interests']); 
        $this->attributes['re_geo_interests'] = json_encode($val);
    }

    public function getReSectorInterestsAttribute($val){
        return $this->toArr($val, 're_sector_interests');
    }

    public function setReSectorInterestsAttribute($val){
        if(isset($this->tmp['re_sector_interests'])) unset($this->tmp['re_sector_interests']); 
        $this->attributes['re_sector_interests'] = json_encode($val);
    }

    public function getReInvestmentStageAttribute($val){
        return $this->toArr($val, 're_investment_stage');
    }

    public function setReInvestmentStageAttribute($val){
        if(isset($this->tmp['re_investment_stage'])) unset($this->tmp['re_investment_stage']); 
        $this->attributes['re_investment_stage'] = json_encode($val);
    }

    public function getReInvestmentTypeAttribute($val){
        return $this->toArr($val, 're_investment_type');
    }

    public function setReInvestmentTypeAttribute($val){
        if(isset($this->tmp['re_investment_type'])) unset($this->tmp['re_investment_type']); 
        $this->attributes['re_investment_type'] = json_encode($val);
    }

    public function getReInvestmentStyleAttribute($val){
        return $this->toArr($val, 're_investment_style');
    }

    public function setReInvestmentStyleAttribute($val){
        if(isset($this->tmp['re_investment_style'])) unset($this->tmp['re_investment_style']); 
        $this->attributes['re_investment_style'] = json_encode($val);
    }

    public function getReDealSizeAttribute($val){
        return $this->toArr($val, 're_deal_size');
    }

    public function setReDealSizeAttribute($val){
        if(isset($this->tmp['re_deal_size'])) unset($this->tmp['re_deal_size']); 
        $this->attributes['re_deal_size'] = json_encode($val);
    }

    public static $profileValidationRulesAgent = array(
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
            'phone' => 'required|regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,15',
            'rbc' => 'min:0|max:100|numeric',
            'rsc' => 'min:0|max:100|numeric',
        );

    public static $peInvestmentValidationRules = array(
        'pe_geo_interests' => 'required',
        'pe_investment_stage' => 'required',
        'pe_sector_interests' => 'required',
        'pe_investment_type' => 'required',
        'pe_investment_style' => 'required',
        'pe_deal_size' => 'required'
        );

    public static function validateEditPeInvestment($data){
        $validations = static::$peInvestmentValidationRules;
        return Validator::make($data, $validations);
    }

    public static $vcInvestmentValidationRules = array(
        'vc_geo_interests' => 'required',
        'vc_investment_stage' => 'required',
        'vc_sector_interests' => 'required',
        'vc_investment_type' => 'required',
        'vc_investment_style' => 'required',
        'vc_deal_size' => 'required'
        );

    public static function validateEditVcInvestment($data){
        $validations = static::$vcInvestmentValidationRules;
        return Validator::make($data, $validations);
    }

    public static $reInvestmentValidationRules = array(
        're_geo_interests' => 'required',
        're_sector_interests' => 'required',
        're_investment_stage' => 'required',
        're_investment_type' => 'required',
        're_investment_style' => 'required',
        're_deal_size' => 'required'
        );

    public static function validateEditReInvestment($data){
        $validations = static::$reInvestmentValidationRules;
        return Validator::make($data, $validations);
    }

    /* Register forms */
    public static $registerValidationRules = array(
        'firstname' => 'required|min:2|alpha_spaces',
        'lastname' => 'required|min:2|alpha_spaces',
        'nickname' => 'unique:users,nickname',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8|regex:/^\S+$/',
        'city' => 'required',
        'country' => 'required',
        'phone' => 'regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,15',
        'agree' => 'required'
        );

    public static $registerValidationRulesAgent = array(
        'firstname' => 'required|min:2|alpha_spaces',
        'lastname' => 'required|min:2|alpha_spaces',
        'nickname' => 'unique:users,nickname',
        'company_name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8|regex:/^\S+$/',
        'city' => 'required',
        'country' => 'required',
        'rbc' => 'required|min:0|max:100|numeric',
        'rsc' => 'required|min:0|max:100|numeric',
        'phone' => 'regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,15',
        'agree' => 'required'
        );

    public static $registerValidationRulesCompany = array(
        'firstname' => 'required|min:2|alpha_spaces',
        'lastname' => 'required|min:2|alpha_spaces',
        'nickname' => 'unique:users,nickname',
        'company_name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8|regex:/^\S+$/',
        'city' => 'required',
        'country' => 'required',
        'phone' => 'regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,15',
        'agree' => 'required'
        );

    public static function validateRegister($data){
        return Validator::make($data, static::$registerValidationRules);
    }

    public static function validateRegisterCompany($data){
        return Validator::make($data, static::$registerValidationRulesCompany);
    }

    public static function validateRegisterAgent($data){
        return Validator::make($data, static::$registerValidationRulesAgent);
    }

    //validate
    public static $userValidationRules = array(
        'user_type' => 'required',
        'firstname' => 'required|min:2|alpha_spaces',
        'lastname' => 'required|min:2|alpha_spaces',
        'nickname' => 'unique:users,nickname',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8|regex:/^\S+$/',
        'address' => 'required',
        'city' => 'required',
        'country' => 'required',
        'phone' => 'required|regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,15',
    );

    public static $userValidationRulesAgent = array(
        'user_type' => 'required',
        'firstname' => 'required|min:2|alpha_spaces',
        'lastname' => 'required|min:2|alpha_spaces',
        'nickname' => 'unique:users,nickname',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:8|regex:/^\S+$/',
        'address' => 'required',
        'city' => 'required',
        'country' => 'required',
        'phone' => 'required|regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,15',
        'rbc' => 'required|min:0|max:100|numeric',
        'rsc' => 'required|min:0|max:100|numeric',
    );

    public static function validetUser($data){

        if(!empty($data['pe_interested'])){
            $validations['pe_geo_interests'] = 'required';
            $validations['pe_investment_stage'] = 'required';
            $validations['pe_sector_interests'] = 'required';
            $validations['pe_investment_type'] = 'required';
            $validations['pe_investment_style'] = 'required';
            $validations['pe_deal_size'] = 'required';
        }

         if(!empty($data['vc_interested'])){
            $validations['vc_geo_interests'] = 'required';
            $validations['vc_investment_stage'] = 'required';
            $validations['vc_sector_interests'] = 'required';
            $validations['vc_investment_type'] = 'required';
            $validations['vc_investment_style'] = 'required';
            $validations['vc_deal_size'] = 'required';
        }

         if(!empty($data['re_interested'])){
            $validations['re_geo_interests'] = 'required';
            $validations['re_investment_stage'] = 'required';
            $validations['re_sector_interests'] = 'required';
            $validations['re_investment_type'] = 'required';
            $validations['re_investment_style'] = 'required';
            $validations['re_deal_size'] = 'required';
        }

        return Validator::make($data, static::$userValidationRules);
    }

    public static function validateEditUserProfile($data, $user){
        $validations = static::$userValidationRules;
        unset($validations['user_type']);
        unset($validations['email']);
        unset($validations['password']);
        unset($validations['nickname']);
        
        return Validator::make($data, $validations);
    }

    public static function validateEditUserProfileAgent($data, $user){
        $validations = static::$userValidationRulesAgent;
        unset($validations['user_type']);
        unset($validations['email']);
        unset($validations['password']);
        unset($validations['nickname']);
        
        return Validator::make($data, $validations);
    }

    public static function validateEditUser($data, $user){
    	$validations = static::$userValidationRules;

        if(!empty($data['pe_interested'])){
            $validations['pe_geo_interests'] = 'required';
            $validations['pe_investment_stage'] = 'required';
            $validations['pe_sector_interests'] = 'required';
            $validations['pe_investment_type'] = 'required';
            $validations['pe_investment_style'] = 'required';
            $validations['pe_deal_size'] = 'required';
        }

         if(!empty($data['vc_interested'])){
            $validations['vc_geo_interests'] = 'required';
            $validations['vc_investment_stage'] = 'required';
            $validations['vc_sector_interests'] = 'required';
            $validations['vc_investment_type'] = 'required';
            $validations['vc_investment_style'] = 'required';
            $validations['vc_deal_size'] = 'required';
        }

         if(!empty($data['re_interested'])){
            $validations['re_geo_interests'] = 'required';
            $validations['re_investment_stage'] = 'required';
            $validations['re_sector_interests'] = 'required';
            $validations['re_investment_type'] = 'required';
            $validations['re_investment_style'] = 'required';
            $validations['re_deal_size'] = 'required';
        }

    	if($user->email == $data['email']){
    		$validations['email'] = 'required|email';
    	}

        $validations['nickname'] = 'required';

    	unset($validations['password']);

    	return Validator::make($data, $validations);
    }

    public static $investorPeValidationRules = array(
		'pe_geo_interests' => 'required',
		'pe_investment_stage' => 'required',
		'pe_sector_interests' => 'required',
		'pe_investment_type' => 'required',
        'pe_investment_style' => 'required',
        'pe_deal_size' => 'required'
		);

    public static function validatePeInvestor($data){
        $validations = static::$investorPeValidationRules;
    	return Validator::make($data, $validations);
    }

    public static $investorVcValidationRules = array(
        'vc_geo_interests' => 'required',
        'vc_investment_stage' => 'required',
        'vc_sector_interests' => 'required',
        'vc_investment_type' => 'required',
        'vc_investment_style' => 'required',
        'vc_deal_size' => 'required'
        );

    public static function validateVcInvestor($data){
        $validations = static::$investorVcValidationRules;
        return Validator::make($data, $validations);
    }

    public static $investorReValidationRules = array(
        're_geo_interests' => 'required',
        're_sector_interests' => 'required',
        're_investment_stage' => 'required',
        're_investment_type' => 'required',
        're_investment_style' => 'required',
        're_deal_size' => 'required'
        );

    public static function validateReInvestor($data){
        $validations = static::$investorReValidationRules;
        return Validator::make($data, $validations);
    }

    public static function validateEditInvestor($data, $user){
    	$validations = static::$investorValidationRules;
        return Validator::make($data, $validations);
    }

    public static $companyValidationRules = array(
        'firstname' =>'required|min:2|alpha_spaces',
        'lastname' =>'required|min:2|alpha_spaces',
        'nickname' => 'unique:users,nickname',
        'email' =>'required|email|unique:users,email', 
        'password' =>'required|confirmed|min:8', 
        'city' =>'required', 
        'country' =>'required', 
        'address' =>'required', 
        'phone' => 'required|regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,15',
        'agree' => 'required'
	   );

    public static function validateCompany($data){
    	return Validator::make($data, static::$companyValidationRules);
    }

    public static function validateEditCompany($data, $user){
    	$validations = static::$companyValidationRules;

        unset($validations['agree']);

    	if($user->email == $data['email']){
    		$validations['email'] = 'required|email';
    	}

    	if(!$data['password']){
    		unset($validations['password']);
    	}

    	return Validator::make($data, $validations);
    }

    public static $bothValidationRules = array(
        'firstname' => 'required|min:3|alpha_spaces',
		'lastname' => 'required|min:3|alpha_spaces',
        'nickname' => 'unique:users,nickname',
		'email' => 'required|email|unique:users,email',
		'password' => 'required|confirmed|min:8',
		'address' => 'required',
		'city' => 'required',
		'country' => 'required',
		'phone' => 'required|regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,15',
		'interests' => 'required',
		'pe_geo_interests' => 'required',
		'pe_investment_stage' => 'required',
		'pe_sector_interests' => 'required',
		'pe_investment_type' => 'required',
        'pe_deal_size' => 'required',
		'investor_type' => 'required',
        'agree' => 'required'
		);

    public static function validateBoth($data){
        $validations = static::$bothValidationRules;
        if(isset($data['investor_type'])){
            if($data['investor_type'] == 'company' ){
                $validations['company_name'] = 'required';
            }
        }
        return Validator::make($data, $validations);
    }
    
    public static function validateEditBoth($data, $user){
    	$validations = static::$bothValidationRules;

        unset($validations['agree']);

    	if($user->email == $data['email']){
    		$validations['email'] = 'required|email';
    	}

    	if(!$data['password']){
    		unset($validations['password']);
    	}

        if(isset($data['investor_type'])){
            if($data['investor_type'] == 'company' ){
                $validations['company_name'] = 'required';
            }
        }

    	return Validator::make($data, $validations);
    }

    public static $userPasswordValidationRules = array(
        'password' => 'required|confirmed|min:8',
    );

    public static function validetUserPassword($data){
        return Validator::make($data, static::$userPasswordValidationRules);
    }

    public function sendConfirmEmail($user) {

        $code = $user->confirmed;
        $email = $user->email;
            
        Mail::send('emails.auth.confirm', array('code' => $code, 'email' => $email), function($message) use ($user)
        {
            $message->from('info@ilosool.com', 'ilOsool');
            $message->to($user->email, $user->firstname . ' ' . $user->lastname)->subject('ilOsool confirmation code');
        });
    }

    public static $passwordResetValidationRules = array(
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8'
        );

    public static function validetPassReset($data){
        return Validator::make($data, static::$passwordResetValidationRules);
    }

    public function getPublicName(){
        if($this->user_type == 'company'){
            return $this->company_name;
        }else{
            if($this->nickname){
                return $this->nickname;
            }else{
                return $this->firstname . ' ' . $this->lastname;
            }
        }
    }

    public function checkHidden($field){
        $hiddenField = 'hidden_' . $field;
        if($this->$hiddenField){
            return $this->$field;
        }else{
            return 'private';
        }
    }
}