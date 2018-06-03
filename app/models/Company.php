<?php

class Company extends Eloquent{
	protected $table = 'companies';
    protected $softDelete = true;
	protected $tmp_image = '';
	protected $tmp_logo = '';
    protected $tmp = array();
    public $total = 0;

    private $temp_has_staff = null;
    private $temp_has_attachments = null;
    private $temp_has_fields = null;

    public $duration = null;

    public function toArr($val, $key = 'tmp'){
        if(isset($this->tmp[$key])) return $this->tmp[$key];

        $this->tmp[$key] = json_decode($val, true);
        return $this->tmp[$key];
    }

	public function user(){
		return $this->belongsTo('User', 'user_id');
	}

	public function attachments(){
		return $this->hasMany('Attachment', 'company_id');
	}

	public function staff(){
		return $this->hasMany('Staff', 'company_id');
	}

    public function companyHidden(){
        return $this->hasOne('CompanyHidden', 'company_id');
    }

	public function statistics(){
		return $this->hasMany('Statistics', 'company_id');
	}

	public function investments(){
		return $this->hasMany('Investment', 'company_id');
	}

	public function companyMeta(){
		return $this->hasMany('CompanyMeta', 'company_id');
	}

    public function bookmarks(){
        return $this->hasMany('Bookmark', 'company_id');
    }

    public function messages()
    {
        return $this->morphMany('Message', 'reference');
    }

    public function getBookmark($id){
        $bookmark = Bookmark::where('user_id', '=', $id)
                            ->where('company_id', '=', $this->id)
                            ->first();
        return $bookmark;
    }

	public function getImage($img = ''){
		if(!$img) $img = $this->image;
        return static::getDir($this->id) . '/' . $img;
    }

    public function getLogo($img = ''){
		if(!$img) $img = $this->logo;
        return static::getDir($this->id) . '/' . $img;
    }

    public static function getDir($company){
        return sprintf(Config::get('ilosool.uploads.profile_dir'), $company);
    }

    public function setImageAttribute($val){
        if(isset($this->attributes['image']) && $this->attributes['image'] != $val){ 
            $this->tmp_image = $this->attributes['image'];
            $this->attributes['image'] = $val;
        }else{
            $this->attributes['image'] = $val;
        }
    }

    public function setLogoAttribute($val){
        if(isset($this->attributes['logo']) && $this->attributes['logo'] != $val){ 
            $this->tmp_logo = $this->attributes['logo'];
            $this->attributes['logo'] = $val;
        }else{
            $this->attributes['logo'] = $val;
        }
    }

    public function getSocialAttribute($val){
        return $this->toArr($val, 'social');
    }

    public function setSocialAttribute($val){
        if(isset($this->tmp['social'])) unset($this->tmp['social']); 
        $this->attributes['social'] = json_encode($val);
    }

    public function setGeoInterestsAttribute($val){
        if(isset($this->tmp['geo_interests'])) unset($this->tmp['geo_interests']); 
        $this->attributes['geo_interests'] = json_encode($val);
    }

    public function getGeoInterestsAttribute($val){
        return $this->toArr($val, 'geo_interests');
    }

	public static function boot()
    {
        parent::boot();

        Company::deleting(function($company){
            if($company->investments()->first()) return false;
            if($company->softDelete === false){
                if($company->image && file_exists($company->getImage())){
                   File::delete($company->getImage());
                }
                if($company->logo && file_exists($company->getLogo())){
                   File::delete($company->getLogo());
                }
            }
        });

        Company::updating(function($company){
            if($company->image && $company->tmp_image && $company->tmp_image != $company->image && file_exists($company->getImage($company->tmp_image))){
               File::delete($company->getImage($company->tmp_image));
               $company->tmp_image = '';
            }
            if($company->logo && $company->tmp_logo && $company->tmp_logo != $company->logo && file_exists($company->getLogo($company->tmp_logo))){
               File::delete($company->getLogo($company->tmp_logo));
               $company->tmp_logo = '';
            }
        });
    }

    //PE Validate 
    public static $validationPeRules = array(
        'deal_name' => 'required|unique:companies,deal_name|alpha_numeric_spaces',
        'name' => 'required|min:5|alpha_numeric_spaces',
        'name_arabic' => 'min:5|alpha_numeric_spaces',
        'started' => 'required|min:4|max:4',
        'email' => 'required|email',
        'city' => 'required',
        'country' => 'required',
        'address' => 'required',
        'phone' => 'required|regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,16',
        'map' => 'regex:/(?<lat>[-+]?([0-9]+\.[0-9]+)).*(?<long>[-+]?([0-9]+\.[0-9]+))/',
        'video' =>'url',
        'brief' => 'required',
        'geo_interests' => 'required',
        'sector' => 'required',
        'leverage_ratio' => 'required|numeric|min:0|max:100',
        'investment_stage' => 'required',
        'investment_type' => 'required',
        'investment_style' => 'required',
        'deal_size' => 'required',
        'current' => 'numeric',
        'price_shares' => 'required|numeric',
        'number_shares' => 'numeric',
        'percentage' => 'required',
        'startdate' => 'required',
        'target' => 'required|numeric',
        'min_investment' => 'required|numeric',
    );

    public static function validatePe($data){
        $validations = static::$validationPeRules;
        if(Auth::user()->user_type == strtolower(Config::get('ilosool.user_type.agent')) || Auth::user()->rule_id == 1){
            $validations['cfb'] = 'required|numeric|min:0|max:100';
        }

        return Validator::make($data, $validations);
    }

    public static function validateEditPe($data){
        $validations = static::$validationPeRules;
        if(Auth::user()->user_type == strtolower(Config::get('ilosool.user_type.agent')) || Auth::user()->rule_id == 1){
            $validations['cfb'] = 'required|numeric|min:0|max:100';
        }

        unset($validations['deal_name']);

        return Validator::make($data, $validations);
    }

    //VC Validate 
    public static $validationVcRules = array(
        'deal_name' => 'required|unique:companies,deal_name|alpha_numeric_spaces',
        'name' => 'required|min:5|alpha_numeric_spaces',
        'name_arabic' => 'min:5|alpha_numeric_spaces',
        'started' => 'required|min:4|max:4',
        'email' => 'required|email',
        'city' => 'required',
        'country' => 'required',
        'address' => 'required',
        'phone' => 'required|regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,16',
        'map' => 'regex:/(?<lat>[-+]?([0-9]+\.[0-9]+)).*(?<long>[-+]?([0-9]+\.[0-9]+))/',
        'video' =>'url',
        'brief' => 'required',
        'geo_interests' => 'required',
        'sector' => 'required',
        'leverage_ratio' => 'required|numeric|min:0|max:100',
        'investment_stage' => 'required',
        'investment_type' => 'required',
        'investment_style' => 'required',
        'deal_size' => 'required',
        'current' => 'numeric',
        'price_shares' => 'required|numeric',
        'number_shares' => 'numeric',
        'percentage' => 'required',
        'growth_rate' => 'required|numeric',
        'startdate' => 'required',
        'target' => 'required|numeric',
        'min_investment' => 'required|numeric',
    );

    public static function validateVc($data){
        $validations = static::$validationVcRules;
        if(Auth::user()->user_type == strtolower(Config::get('ilosool.user_type.agent')) || Auth::user()->rule_id == 1){
            $validations['cfb'] = 'required|numeric|min:0|max:100';
        }
        return Validator::make($data, static::$validationVcRules);
    }

    public static function validateEditVc($data){
        $validations = static::$validationVcRules;
        if(Auth::user()->user_type == strtolower(Config::get('ilosool.user_type.agent')) || Auth::user()->rule_id == 1){
            $validations['cfb'] = 'required|numeric|min:0|max:100';
        }

        unset($validations['deal_name']);

        return Validator::make($data, $validations);
    }

	//RE Validate 
    public static $validationReRules = array(
        'deal_name' => 'required|unique:companies,deal_name|alpha_numeric_spaces',
        'name' => 'required|min:5|alpha_numeric_spaces',
        'name_arabic' => 'min:5|alpha_numeric_spaces',
        'started' => 'required|min:4|max:4',
        'email' => 'required|email',
        'city' => 'required',
        'country' => 'required',
        'address' => 'required',
        'phone' => 'required|regex:/^(?!(?:\d*-){5,})(?!(?:\d* ){5,})\+?[\d- ]+$/|between:8,16',
        'map' => 'regex:/(?<lat>[-+]?([0-9]+\.[0-9]+)).*(?<long>[-+]?([0-9]+\.[0-9]+))/',
        'video' =>'url',
        'brief' => 'required',
        'geo_interests' => 'required',
        'leverage_ratio' => 'required|numeric|min:0|max:100',
        'investment_stage' => 'required',
        'investment_type' => 'required',
        'investment_style' => 'required',
        'deal_size' => 'required',
        'current' => 'numeric',
        'sector' => 'required',
        'number_sqf' => 'required|numeric',
        'price_sqf' => 'required|numeric',
        'yield' => 'required|numeric',
        'startdate' => 'required',
        'target' => 'required|numeric',
        'min_investment' => 'required|numeric',
	);
    
    public static function validateRe($data){
        $validations = static::$validationReRules;
        if(Auth::user()->user_type == strtolower(Config::get('ilosool.user_type.agent')) || Auth::user()->rule_id == 1){
            $validations['cfb'] = 'required|numeric|min:0|max:100';
        }
        return Validator::make($data, static::$validationReRules);
    }

    public static function validateEditRe($data){
        $validations = static::$validationReRules;
        if(Auth::user()->user_type == strtolower(Config::get('ilosool.user_type.agent')) || Auth::user()->rule_id == 1){
            $validations['cfb'] = 'required|numeric|min:0|max:100';
        }

        unset($validations['deal_name']);

        return Validator::make($data, $validations);
    }

    // update investment validation
    public static $validationUpdateRules = array(
        'current' => 'required|numeric'
    );

    public static function validateUpdateInvestment($data){
        return Validator::make($data, static::$validationUpdateRules);
    }

    public static $validateRequestAdminNtf = array(
        'description' => 'required'
    );

    public static function validateRequestAdminNtf($data){
        return Validator::make($data, static::$validateRequestAdminNtf);
    }

    public static $validateSendMessage = array(
        'content' => 'required'
    );

    public static function validateSendMessage($data){
        return Validator::make($data, static::$validateSendMessage);
    }

    // Date Time Functions
    public function duration($force = false){
        if($this->duration && $force == false) return $this->duration;     
        $current = new DateTime('now');
        $start = new DateTime($this->startdate);
        $end = new DateTime($this->enddate);

        $this->duration = $current->diff($end);

        if($end > $start || $end > $current){
            return null;
        }else{
            return $this->duration;
        }
    }

    public function daysLeft(){
        $duration = $this->duration();
        if(!$duration) return null;
        return $duration->format('%a');
    }

    public function hoursLeft(){
        $duration = $this->duration();
        if(!$duration) return null;
        return $duration->format('%h');
    }

    public function minutesLeft(){
        $duration = $this->duration();
        if(!$duration) return null;
        return $duration->format('%i');
    }

    public function secondsLeft(){
        $duration = $this->duration();
        if(!$duration) return null;
        return $duration->format('%s');
    }

    public function left(){
        $duration = $this->duration();
        if(!$duration) return null;
        return $duration->format('%a days, %h : %i : %s');
    }

    public function isEnded(){
        $duration = $this->duration();
        return ($duration) ? true : false;
    }

    //Money Functions
    public function investmentProgress(){
        if($this->target == 0)
            return 0;
        else
            return ( $this->current / $this->target ) * 100;
    }

    //  public function format($number) {
    //     $prefixes = 'kMGTPEZY';
    //     if ($number >= 1000) {
    //         for ($i=-1; $number>=1000; ++$i) {
    //             $number /= 1000;
    //         }
    //         return $number . $prefixes[$i];
    //     }
    //     return $number;
    // }

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

    public function hasPrivateStaff($id = null){
        if(!$id) $id = $this->id;

        $staff = Staff::where('company_id', '=', $id)->where('access', '=', 'private')->first();
        $this->temp_has_staff = $staff ? true : false;

        return $this->temp_has_staff;
    }

    public function hasPrivateAttachments($id = null){
        if(!$id) $id = $this->id;

        $attachments = Attachment::where('company_id', '=', $id)->where('access', '=', 'private')->first();
        $this->temp_has_attachments = $attachments ? true : false;

        return $this->temp_has_attachments;
    }

    public function hasPrivateFields($id = null){
        if(!$id) $id = $this->id;

        $companyHidden = CompanyHidden::where('company_id', '=', $id)->first();

        $has_hidden = $companyHidden->name === 0 || $companyHidden->name_arabic === 0 || $companyHidden->started === 0 || $companyHidden->address === 0 || $companyHidden->phone === 0 
        || $companyHidden->email === 0 || $companyHidden->website === 0 || $companyHidden->description === 0 || $companyHidden->logo === 0 
        || $companyHidden->video === 0 || $companyHidden->map === 0 || $companyHidden->social === 0 || $companyHidden->type === 0 
        || $companyHidden->tags === 0 || $companyHidden->yield === 0 || $companyHidden->price_shares === 0 || $companyHidden->number_shares === 0 
        || $companyHidden->price_sqf === 0 || $companyHidden->number_sqf === 0 || $companyHidden->percentage === 0 || $companyHidden->price_earning === 0 
        || $companyHidden->growth_rate === 0 || $companyHidden->startdate === 0  || $companyHidden->target === 0 
        || $companyHidden->current === 0 || $companyHidden->min_investment === 0 || $companyHidden->geo_interests === 0;

        $this->temp_has_fields = $has_hidden ? true : false;

        return $this->temp_has_fields;
    }

    public function hasPrivateInfo($id){

        if($this->hasPrivateAttachments($id) || $this->hasPrivateStaff($id) || $this->hasPrivateFields($id)){
            return true;
        }else{
            return false;
        }
    }

    public function grantedAccess($userId, $companyId){
        
        $companyPermissions = CompanyPermissions::where('user_id', '=', $userId)->where('company_id', '=', $companyId)->first();

        // foreach ($attachmentsPermissions as $ap) {
        //     $attachment = Attachment::find($ap->attachments_id);
        //     if($attachment->company_id == $companyId)
        //         return true;
        // }

        if (count($companyPermissions) > 0 ){
             return $companyPermissions->status;
        }

        return false;
    }

    public function forceDeleteCompany()
    {
        $softDelete = $this->softDelete;

        // We will temporarily disable false delete to allow us to perform the real
        // delete operation against the model. We will then restore the deleting
        // state to what this was prior to this given hard deleting operation.
        $this->softDelete = false;

        $res = $this->delete();

        $this->softDelete = $softDelete;

        return $res;
    }

    public function Bookmarked($userId, $companyId){


        $bookmarked = Bookmark::where('user_id', '=', $userId)
                                ->where('company_id', '=', $companyId)
                                ->first();

        if (count($bookmarked) > 0 ){
             return true;
        }

        return false;
    }

    public static function getWishlistUsers($id){

        $users = User::leftJoin('wishlists', 'users.id', '=', 'wishlists.user_id')
            ->where('wishlists.company_id', '=', $id)
            ->paginate(Config::get('ilosool.rows_default'));

        return ($users) ? $users : null;
    }

    public function getPrivateField($company, $field, $show, $status, $texts = ''){
        
        $default = array(
            'pending' => !empty($texts) && isset($texts['pending']) ? $texts['pending'] : trans('deal.pending'),
            'rejected' => !empty($texts) && isset($texts['rejected']) ? $texts['rejected'] : trans('deal.private_info'),
            'request' => !empty($texts) && isset($texts['request']) ? $texts['request'] : '<a href="javascript:void(0);" data-href="'.URL::route("request.popup", $company->id).'" class="popup" data-title=' . trans("deal.request_private_info") .'>'.trans("deal.request").'</a>'
        );
        if($show == 1 || $status == "accepted" || isOwner($company->user_id)){
            return $field;
        }elseif($status == "pending"){
            return $default['pending'];
        }elseif($status == "rejected"){
            return $default['rejected'];
        }else{
            if($show){
                return $field;
            }else{
                return $default['request'];
            }
        }
    }
}

