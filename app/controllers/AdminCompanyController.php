<?php

class AdminCompanyController extends BaseController {

	public function index(){
        
        $col = Input::get('col');
        $rows = Input::get('rows');
		$approved = Input::get('approved');

        $q = Company::withTrashed()->select(array('*'));

        if(Input::get('search')){
        	$q = $q ->where(function($q){
        		$q	->orWhere('name','LIKE', '%' . Input::get('search') . '%')
        			->orWhere('id','=', Input::get('search'))
				    ->orWhere('country','LIKE','%' . Input::get('search') . '%')
				    ->orWhere('sector','LIKE','%' . Input::get('search') . '%')
				    ->orWhere('type','LIKE','%' . Input::get('search') . '%'); 
        	});
        }

        if($approved){
        	if($approved == 'unapproved' )
        		$q ->where('approved','=', 0);
        	else
        		$q ->where('approved','=', 1);
        }

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
        	$companies = $q->paginate($rows);
        }else{
        	$companies =  $q->paginate(Config::get('ilosool.rows_default'));
        }

	    return View::make('admin.company.index')->with('companies', $companies);
    }

    public function view($id){

        $company = Company::find($id);
        $user = User::find($company->user_id);

        return View::make('admin.company.view')->with('company', $company)->with('user', $user);
    }
    
	public function add($type){
		
		//$attachmentspermissions = Config::get('ilosool.attachments_permissions');

		return View::make('admin.company.add')->with('type', $type);
	}

	public function edit($id){
		
		$company = Company::find($id);
		$companyHidden = CompanyHidden::where('company_id', '=', $id)->first();

		return View::make('admin.company.edit', array('company' => $company, 'companyHidden' => $companyHidden));
	}
   
	public function delete($id){

		$company = Company::withTrashed()->find($id);
		$res = $company->forceDeleteCompany();

		if($res){
			$message = 'The Listing <strong>' . $company->deal_name . '</strong> has been deleted Successfully';
		}else{
			$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be deleted, you can not delete a company that have investments';
		}

		return Redirect::route('admin.companies')
				->with('action', 'delete')
				->with('result', $res)
				->with('message', $message);
	}

	public function trash($id, $action){
		
		$company = Company::withTrashed()->find($id);

		if ($action == "untrash") {
			$res = $company->restore();
		}elseif($action == "trash"){
			$res = $company->delete();
			//return $res;
		}

		if($res){
   			if($action == 'trash'){
				$message = 'The Listing <strong>' . $company->deal_name . '</strong> has been trashed successfully';
			}elseif ($action == 'untrash') {
				$message = 'The Listing <strong>' . $company->deal_name . '</strong> has been untrashed successfully';
			}
		}else{
			if($action == 'trash'){
				$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be trashed';
			}elseif ($action == 'untrash') {
				$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be untrashed';
			}
		}

		return Redirect::route('admin.companies')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
	}

	public function pe_add_post(){
		$user = Auth::user();

		//validate company
		$validator = Company::validatePe(Input::all());

	    if ($validator->fails())
	    {
	        return Redirect::to('admin/company/pe')->withErrors($validator)->withInput();
	    }

	    if(Input::get('owner')){
	    	$user = User::find(Input::get('owner'));
	    }else{
	    	$user = Auth::user();
	    }

	    //add Company
		$company = new Company();
		$companyHidden = new CompanyHidden();

		//social links
		
		$links = Input::get('sociallink', array());
	    $names = Input::get('socialname', array());
	    $social = array();
		

	    for($i = 0; $i < count($names); $i++){
	    	$social[$names[$i]] = $links[$i];
	    }

	    $company->user_id = $user->id;
	    $company->deal_name = Input::get('deal_name');
	    $company->slug = Input::get('slug') ? Input::get('slug') : strtolower(str_replace(' ', '-', $company->deal_name));
		$company->name = Input::get('name');
		$company->name_arabic = Input::get('name_arabic');
	    $company->started = Input::get('started');
	    $company->email = Input::get('email');
	    $company->website = Input::get('website');
	    $company->city = Input::get('city');
	    $company->country = Input::get('country');
	    $company->address = Input::get('address');

	    $company->phone = Input::get('phone');
	    $company->description = Input::get('description');
	    $company->brief = Input::get('brief');
	    $company->video = Input::get('video');
	    $company->map = Input::get('map');
	    $company->social = $social;
	    //$company->tags = Input::get('tags');
	    $company->price_shares = Input::get('price_shares');
	    $company->number_shares = Input::get('number_shares');
	    $company->percentage = Input::get('percentage');
	    $company->price_earning = Input::get('price_earning');

	    //investment
	    $company->leverage_ratio = Input::get('leverage_ratio');
	    $company->cfb = Input::get('cfb');
		
		$company->startdate = new DateTime(Input::get('startdate'));
		$startdate = new DateTime(Input::get('startdate'));
		$company->enddate = $startdate->modify('+3 month');
		$company->target = Input::get('target');
		$company->min_investment = Input::get('min_investment');
		$company->geo_interests = Input::get('geo_interests');
		$company->sector = Input::get('sector');
		$company->investment_stage = Input::get('investment_stage');
		$company->investment_type = Input::get('investment_type');
		$company->investment_style = Input::get('investment_style');
		$company->deal_size = Input::get('deal_size');
		$company->current = Input::get('current');

		$company->featured = Input::get('featured');
		$company->show_contact = Input::get('show_contact');
		$company->status = Input::get('status');
		$company->listing_status = Input::get('listing_status');
		$company->approved = Input::get('approved');

	    $company->type = 'pe';
	    
	    $company->user_id = $user ? $user->id : 0;

		$res = $company->save();

		if($res){
			$file = Input::file('image');

			if($file){
                $company->image = upload($file, Company::getDir($company->id));
            }

			$file = Input::file('logo');
		    if($file){
                $company->logo = upload($file, Company::getDir($company->id));
            }

            $company->save();

			//Hidden Fields
			$companyHidden->company_id = $company->id;
		    //Info
		    $companyHidden->name = Input::get('name_hidden') ? 1 : 0;
		    $companyHidden->name_arabic = Input::get('name_arabic_hidden') ? 1 : 0;
		    $companyHidden->started = Input::get('started_hidden') ? 1 : 0;
		    $companyHidden->email = Input::get('email_hidden') ? 1 : 0;
		    $companyHidden->website = Input::get('website_hidden') ? 1 : 0;
		    $companyHidden->address = Input::get('address_hidden') ? 1 : 0;
		    $companyHidden->phone = Input::get('phone_hidden') ? 1 : 0;
		    
		    //Details
		    $companyHidden->description = Input::get('description_hidden') ? 1 : 0;
		    //$companyHidden->logo = Input::get('logo_hidden') ? 1 : 0;
		    $companyHidden->video = Input::get('video_hidden') ? 1 : 0;
		    $companyHidden->map = Input::get('map_hidden') ? 1 : 0;
		    $companyHidden->social = Input::get('social_hidden') ? 1 : 0;
		    
		    // Investment info
		    $companyHidden->leverage_ratio = Input::get('leverage_ratio_hidden') ? 1 : 0;
		    $companyHidden->price_shares = Input::get('price_shares_hidden') ? 1 : 0;
		    $companyHidden->number_shares = Input::get('number_shares_hidden') ? 1 : 0;
		    $companyHidden->percentage = Input::get('percentage_hidden') ? 1 : 0;
		    $companyHidden->price_earning = Input::get('price_earning_hidden') ? 1 : 0;
		    $companyHidden->startdate = Input::get('startdate_hidden') ? 1 : 0;
		    //$companyHidden->enddate = Input::get('enddate_hidden') ? 1 : 0;
		    $companyHidden->target = Input::get('target_hidden') ? 1 : 0;
		    $companyHidden->min_investment = Input::get('min_investment_hidden') ? 1 : 0;
		    
 			$company->companyHidden()->save($companyHidden);

			if( Input::get('approved') == 1 ){
				Job::sendNotificationToUsers($company, 'created');
			}

			$message = 'The Listing <strong>' . $company->deal_name . '</strong> has been created Successfully';
		}else{
			$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be created';
		}

		return Redirect::route('admin.companies')
				->with('action', 'add')
				->with('result', $res)
				->with('message', $message);
   	}

   	public function vc_add_post(){
		$user = Auth::user();

		//validate company
		$validator = Company::validateVc(Input::all());

	    if ($validator->fails())
	    {
	        return Redirect::to('admin/company/vc')->withErrors($validator)->withInput();
	    }

	    if(Input::get('owner')){
	    	$user = User::find(Input::get('owner'));
	    }else{
	    	$user = Auth::user();
	    }

	    //add Company
		$company = new Company();
		$companyHidden = new CompanyHidden();

		//social links
		
		$links = Input::get('sociallink', array());
	    $names = Input::get('socialname', array());
	    $social = array();
		

	    for($i = 0; $i < count($names); $i++){
	    	$social[$names[$i]] = $links[$i];
	    }

	    $company->user_id = $user->id;
	    $company->deal_name = Input::get('deal_name');
	    $company->slug = Input::get('slug') ? Input::get('slug') : strtolower(str_replace(' ', '-', $company->deal_name));
		$company->name = Input::get('name');
		$company->name_arabic = Input::get('name_arabic');
	    $company->started = Input::get('started');
	    $company->email = Input::get('email');
	    $company->website = Input::get('website');
	    $company->city = Input::get('city');
	    $company->country = Input::get('country');
	    $company->address = Input::get('address');
	    $company->phone = Input::get('phone');
	    $company->description = Input::get('description');
	    $company->brief = Input::get('brief');
	    $company->video = Input::get('video');
	    $company->map = Input::get('map');
	    $company->social = $social;
	    //$company->tags = Input::get('tags');
	    $company->price_shares = Input::get('price_shares');
	    $company->number_shares = Input::get('number_shares');
	    $company->percentage = Input::get('percentage');
	    $company->price_earning = Input::get('price_earning');
	    $company->growth_rate = Input::get('growth_rate');

	    $company->type = 'vc';

	    //investment
	    $company->leverage_ratio = Input::get('leverage_ratio');
	    $company->cfb = Input::get('cfb');
		$company->startdate = new DateTime(Input::get('startdate'));
		$startdate = new DateTime(Input::get('startdate'));
		$company->enddate = $startdate->modify('+3 month');
		$company->target = Input::get('target');
		$company->min_investment = Input::get('min_investment');
		$company->geo_interests = Input::get('geo_interests');
		$company->sector = Input::get('sector');
		$company->investment_stage = Input::get('investment_stage');
		$company->investment_type = Input::get('investment_type');
		$company->investment_style = Input::get('investment_style');
		$company->deal_size = Input::get('deal_size');
		$company->current = Input::get('current');

		$company->featured = Input::get('featured');
		$company->show_contact = Input::get('show_contact');
		$company->status = Input::get('status');
		$company->listing_status = Input::get('listing_status');
	    $company->approved = Input::get('approved');
	    
	    $company->user_id = $user ? $user->id : 0;

		$res = $company->save();

		if($res){
			$file = Input::file('image');
		    if($file){
	        	$company->image = upload($file, Company::getDir($company->id));
	        }


			$file = Input::file('logo');
		    if($file){
	        	$company->logo = upload($file, Company::getDir($company->id));
	        }

	        $company->save();

			//Hidden Fields
			$companyHidden->company_id = $company->id;
		    //Info
		    $companyHidden->name = Input::get('name_hidden') ? 1 : 0;
		    $companyHidden->name_arabic = Input::get('name_arabic_hidden') ? 1 : 0;
		    $companyHidden->started = Input::get('started_hidden') ? 1 : 0;
		    $companyHidden->email = Input::get('email_hidden') ? 1 : 0;
		    $companyHidden->website = Input::get('website_hidden') ? 1 : 0;
		    $companyHidden->address = Input::get('address_hidden') ? 1 : 0;
		    $companyHidden->phone = Input::get('phone_hidden') ? 1 : 0;
		    
		    //Details
		    $companyHidden->description = Input::get('description_hidden') ? 1 : 0;
		    //$companyHidden->logo = Input::get('logo_hidden') ? 1 : 0;
		    $companyHidden->video = Input::get('video_hidden') ? 1 : 0;
		    $companyHidden->map = Input::get('map_hidden') ? 1 : 0;
		    $companyHidden->social = Input::get('social_hidden') ? 1 : 0;
		    
		    // Investment info
		    $companyHidden->leverage_ratio = Input::get('leverage_ratio_hidden') ? 1 : 0;
		    $companyHidden->price_shares = Input::get('price_shares_hidden') ? 1 : 0;
		    $companyHidden->number_shares = Input::get('number_shares_hidden') ? 1 : 0;
		    $companyHidden->percentage = Input::get('percentage_hidden') ? 1 : 0;
		    $companyHidden->price_earning = Input::get('price_earning_hidden') ? 1 : 0;
		    $companyHidden->growth_rate = Input::get('growth_rate_hidden') ? 1 : 0;
		    $companyHidden->startdate = Input::get('startdate_hidden') ? 1 : 0;
		    //$companyHidden->enddate = Input::get('enddate_hidden') ? 1 : 0;
		    $companyHidden->target = Input::get('target_hidden') ? 1 : 0;
		    $companyHidden->min_investment = Input::get('min_investment_hidden') ? 1 : 0;
		    
 			$companyHidden->save();

			if( Input::get('approved') == 1 ){
				Job::sendNotificationToUsers($company, 'created');
			}

			$message = 'The Listing <strong>' . $company->deal_name . '</strong> has been created Successfully';
		}else{
			$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be created';
		}

		return Redirect::route('admin.companies')
				->with('action', 'add')
				->with('result', $res)
				->with('message', $message);
   	}

   	public function re_add_post(){
		$user = Auth::user();

		//validate company
		$validator = Company::validateRe(Input::all());

	    if ($validator->fails())
	    {
	        return Redirect::to('admin/company/re')->withErrors($validator)->withInput();
	    }

	    if(Input::get('owner')){
	    	$user = User::find(Input::get('owner'));
	    }else{
	    	$user = Auth::user();
	    }

	    //add Company
		$company = new Company();
		$companyHidden = new CompanyHidden();

		//social links
		
		$links = Input::get('sociallink', array());
	    $names = Input::get('socialname', array());
	    $social = array();
		

	    for($i = 0; $i < count($names); $i++){
	    	$social[$names[$i]] = $links[$i];
	    }

	    $company->user_id = $user->id;
	    $company->deal_name = Input::get('deal_name');
	    $company->slug = Input::get('slug') ? Input::get('slug') : strtolower(str_replace(' ', '-', $company->deal_name));
		$company->name = Input::get('name');
		$company->name_arabic = Input::get('name_arabic');
	    //$company->fancyname = Input::get('fancyname');
	    $company->started = Input::get('started');
	    $company->email = Input::get('email');
	    $company->website = Input::get('website');
	    $company->city = Input::get('city');
	    $company->country = Input::get('country');
	    $company->address = Input::get('address');
	    $company->phone = Input::get('phone');
	    $company->description = Input::get('description');
	    $company->brief = Input::get('brief');
	    $company->video = Input::get('video');
	    $company->map = Input::get('map');
	    $company->social = $social;
	    //$company->tags = Input::get('tags');
	    $company->number_sqf = Input::get('number_sqf');
	    $company->price_sqf = Input::get('price_sqf');
	    $company->yield = Input::get('yield');
	    
	    $company->type = 're';

	    //investment
	    $company->leverage_ratio = Input::get('leverage_ratio');
	    $company->cfb = Input::get('cfb');
		$company->startdate = new DateTime(Input::get('startdate'));
		$startdate = new DateTime(Input::get('startdate'));
		$company->enddate = $startdate->modify('+3 month');
		$company->target = Input::get('target');
		$company->min_investment = Input::get('min_investment');
		$company->geo_interests = Input::get('geo_interests');
		$company->sector = Input::get('sector');
		$company->investment_stage = Input::get('investment_stage');
		$company->investment_style = Input::get('investment_style');
		$company->investment_type = Input::get('investment_type');
		$company->deal_size = Input::get('deal_size');
		$company->current = Input::get('current');

		$company->featured = Input::get('featured');
		$company->show_contact = Input::get('show_contact');
		$company->status = Input::get('status');
		$company->listing_status = Input::get('listing_status');
		$company->approved = Input::get('approved');
	    
	    $company->user_id = $user ? $user->id : 0;

		$res = $company->save();

		if($res){

			$file = Input::file('image');
		    if($file){
	        	$company->image = upload($file, Company::getDir($company->id));
	        }

			$file = Input::file('logo');
		    if($file){
	        	$company->logo = upload($file, Company::getDir($company->id));
	        }

	        //Hidden Fields
			$companyHidden->company_id = $company->id;
		    //Info
		    $companyHidden->name = Input::get('name_hidden') ? 1 : 0;
		    $companyHidden->name_arabic = Input::get('name_arabic_hidden') ? 1 : 0;
		    $companyHidden->started = Input::get('started_hidden') ? 1 : 0;
		    $companyHidden->email = Input::get('email_hidden') ? 1 : 0;
		    $companyHidden->website = Input::get('website_hidden') ? 1 : 0;
		    $companyHidden->address = Input::get('address_hidden') ? 1 : 0;
		    $companyHidden->phone = Input::get('phone_hidden') ? 1 : 0;
		    
		    //Details
		    $companyHidden->description = Input::get('description_hidden') ? 1 : 0;
		    //$companyHidden->logo = Input::get('logo_hidden') ? 1 : 0;
		    $companyHidden->video = Input::get('video_hidden') ? 1 : 0;
		    $companyHidden->map = Input::get('map_hidden') ? 1 : 0;
		    $companyHidden->social = Input::get('social_hidden') ? 1 : 0;
		    
		    // Investment info
		    $companyHidden->leverage_ratio = Input::get('leverage_ratio_hidden') ? 1 : 0;
		    $companyHidden->number_sqf = Input::get('number_sqf_hidden') ? 1 : 0;
		    $companyHidden->price_sqf = Input::get('price_sqf_hidden') ? 1 : 0;
		    $companyHidden->yield = Input::get('yield_hidden') ? 1 : 0;
		    $companyHidden->startdate = Input::get('startdate_hidden') ? 1 : 0;
		    //$companyHidden->enddate = Input::get('enddate_hidden') ? 1 : 0;
		    $companyHidden->target = Input::get('target_hidden') ? 1 : 0;
		    $companyHidden->min_investment = Input::get('min_investment_hidden') ? 1 : 0;
		    
 			$companyHidden->save();

			if( Input::get('approved') == 1 ){
				Job::sendNotificationToUsers($company, 'created');
			}

			$message = 'The Listing <strong>' . $company->deal_name . '</strong> has been created Successfully';
		}else{
			$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be created';
		}

		return Redirect::route('admin.companies')
				->with('action', 'add')
				->with('result', $res)
				->with('message', $message);
   	}

   	public function pe_edit_post($id){

		//validate company
		$validator = Company::validateEditPe(Input::all());

	    if ($validator->fails())
	    {
	        return Redirect::route('admin.company.edit', $id)->withErrors($validator)->withInput();
	    }

	    if(Input::get('owner')){
	    	$user = User::find(Input::get('owner'));
	    }else{
	    	$user = Auth::user();
	    }

	    //social links
	    $links = Input::get('sociallink', array());
	    $names = Input::get('socialname', array());
	    $social = array();

	    for($i = 0; $i < count($names); $i++){
	    	$social[$names[$i]] = $links[$i];
	    }

	    //Company info
		$company = Company::find($id);
		$companyHidden = CompanyHidden::where('company_id', '=', $id)->first();

		$company->user_id = $user->id;
		$company->deal_name = Input::get('deal_name');
	    $company->slug = Input::get('slug') ? Input::get('slug') : strtolower(str_replace(' ', '-', $company->deal_name));
		$company->name = Input::get('name');
		$company->name_arabic = Input::get('name_arabic');
	    $company->started = Input::get('started');
	    $company->email = Input::get('email');
	    $company->website = Input::get('website');
	    $company->city = Input::get('city');
	    $company->country = Input::get('country');
	    $company->address = Input::get('address');
	    $company->phone = Input::get('phone');
	    $company->description = Input::get('description');
	    $company->brief = Input::get('brief');
	    $company->video = Input::get('video');
	    $company->map = Input::get('map');
	    $company->social = $social;

	    $company->tags = Input::get('tags');
	    $company->price_shares = Input::get('price_shares');
	    $company->number_shares = Input::get('number_shares');
	    $company->percentage = Input::get('percentage');
	    $company->price_earning = Input::get('price_earning');

	    //investment
	    $company->leverage_ratio = Input::get('leverage_ratio');
		$company->startdate = new DateTime(Input::get('startdate'));
		$startdate = new DateTime(Input::get('startdate'));
		$company->enddate = $startdate->modify('+3 month');
		$company->target = Input::get('target');
		$company->min_investment = Input::get('min_investment');
		$company->geo_interests = Input::get('geo_interests');
		$company->sector = Input::get('sector');
		$company->investment_stage = Input::get('investment_stage');
		$company->investment_style = Input::get('investment_style');
		$company->investment_type = Input::get('investment_type');
		$company->deal_size = Input::get('deal_size');
		$company->current = Input::get('current');

		//Status and approved data befor saving the new status for the company, for notification Job
		$statusBefore = $company->status;
		$approvedBefore = $company->approved;

		$company->featured = Input::get('featured');
		$company->show_contact = Input::get('show_contact');
		$company->status = Input::get('status');
		$company->listing_status = Input::get('listing_status');
		$company->approved = Input::get('approved');

	    $company->type = 'pe';
	    
	    $company->user_id = $user ? $user->id : 0;

		$res = $company->save();
		
		if($res){
			$file = Input::file('image');
		    if($file){
	        	$company->image = upload($file, Company::getDir($company->id));
	        }

			$file = Input::file('logo');
		    if($file){
	        	$company->logo = upload($file, Company::getDir($company->id));
	        }

        	$company->save();

			//Hidden Fields
			$companyHidden->company_id = $company->id;
		    //Info
		    $companyHidden->name = Input::get('name_hidden') ? 1 : 0;
		    $companyHidden->name_arabic = Input::get('name_arabic_hidden') ? 1 : 0;
		    $companyHidden->started = Input::get('started_hidden') ? 1 : 0;
		    $companyHidden->email = Input::get('email_hidden') ? 1 : 0;
		    $companyHidden->website = Input::get('website_hidden') ? 1 : 0;
		    $companyHidden->address = Input::get('address_hidden') ? 1 : 0;
		    $companyHidden->phone = Input::get('phone_hidden') ? 1 : 0;
		    
		    //Details
		    $companyHidden->description = Input::get('description_hidden') ? 1 : 0;
		    //$companyHidden->logo = Input::get('logo_hidden') ? 1 : 0;
		    $companyHidden->video = Input::get('video_hidden') ? 1 : 0;
		    $companyHidden->map = Input::get('map_hidden') ? 1 : 0;
		    $companyHidden->social = Input::get('social_hidden') ? 1 : 0;
		    
		    // Investment info
		    $companyHidden->leverage_ratio = Input::get('leverage_ratio_hidden') ? 1 : 0;
		    $companyHidden->price_shares = Input::get('price_shares_hidden') ? 1 : 0;
		    $companyHidden->number_shares = Input::get('number_shares_hidden') ? 1 : 0;
		    $companyHidden->percentage = Input::get('percentage_hidden') ? 1 : 0;
		    $companyHidden->price_earning = Input::get('price_earning_hidden') ? 1 : 0;
		    $companyHidden->startdate = Input::get('startdate_hidden') ? 1 : 0;
		    //$companyHidden->enddate = Input::get('enddate_hidden') ? 1 : 0;
		    $companyHidden->target = Input::get('target_hidden') ? 1 : 0;
		    $companyHidden->min_investment = Input::get('min_investment_hidden') ? 1 : 0;
		    
 			$company->companyHidden()->save($companyHidden);
			
			if( $statusBefore == 'published' && Input::get('status') == 'unpublished'){

				$title = sprintf(Config::get('ilosool.titles.listing_unpublished'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_unpublished'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_unpublished'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_unpublished'), $company->deal_name);
				$type = 'company_unpublish';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);

			}elseif( $statusBefore == 'unpublished' && Input::get('status') == 'published' ){

				$title = sprintf(Config::get('ilosool.titles.listing_published'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_published'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_published'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_published'), $company->deal_name);
				$type = 'company_publish';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);
			}

			if( $approvedBefore == 1 && Input::get('approved') == 0){

				$title = sprintf(Config::get('ilosool.titles.listing_unapproved'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_unapproved'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_unapproved'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_unapproved'), $company->deal_name);
				$type = 'company_unapproved';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);

			}elseif( $approvedBefore == 0 && Input::get('approved') == 1 ){

				$title = sprintf(Config::get('ilosool.titles.listing_approved'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_approved'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_approved'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_approved'), $company->deal_name);
				$type = 'company_approved';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);

			}

			if( Input::get('approved') == 1 ){
				Job::sendNotificationToUsers($company, 'edited');
			}

			$message = 'The Listing <strong>' . $company->deal_name . '</strong> has been edited Successfully';
		}else{
			$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be edited';
		}

		return Redirect::route('admin.companies')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
   	}

   	public function vc_edit_post($id){

		//validate company
		$validator = Company::validateEditVc(Input::all());

	    if ($validator->fails())
	    {
	        return Redirect::route('admin.company.edit', $id)->withErrors($validator)->withInput();
	    }

	    if(Input::get('owner')){
	    	$user = User::find(Input::get('owner'));
	    }else{
	    	$user = Auth::user();
	    }

	    //social links
	    $links = Input::get('sociallink', array());
	    $names = Input::get('socialname', array());
	    $social = array();

	    for($i = 0; $i < count($names); $i++){
	    	$social[$names[$i]] = $links[$i];
	    }

	    //Company info
		$company = Company::find($id);
		$companyHidden = CompanyHidden::where('company_id', '=', $id)->first();

		$company->user_id = $user->id;
		$company->deal_name = Input::get('deal_name');
	    $company->slug = Input::get('slug') ? Input::get('slug') : strtolower(str_replace(' ', '-', $company->deal_name));
		$company->name = Input::get('name');
		$company->name_arabic = Input::get('name_arabic');
	    $company->started = Input::get('started');
	    $company->email = Input::get('email');
	    $company->website = Input::get('website');
	    $company->city = Input::get('city');
	    $company->country = Input::get('country');
	    $company->address = Input::get('address');
	    $company->phone = Input::get('phone');
	    $company->description = Input::get('description');
	    $company->brief = Input::get('brief');
	    $company->video = Input::get('video');
	    $company->map = Input::get('map');
	    $company->social = $social;
	    $company->tags = Input::get('tags');
	    $company->price_shares = Input::get('price_shares');
	    $company->number_shares = Input::get('number_shares');
	    $company->percentage = Input::get('percentage');
	    $company->price_earning = Input::get('price_earning');
	    $company->growth_rate = Input::get('growth_rate');

	    $company->type = 'vc';

	    //investment
	    $company->leverage_ratio = Input::get('leverage_ratio');
		$company->startdate = new DateTime(Input::get('startdate'));
		$startdate = new DateTime(Input::get('startdate'));
		$company->enddate = $startdate->modify('+3 month');
		$company->target = Input::get('target');
		$company->min_investment = Input::get('min_investment');
		$company->geo_interests = Input::get('geo_interests');
		$company->sector = Input::get('sector');
		$company->investment_stage = Input::get('investment_stage');
		$company->investment_type = Input::get('investment_type');
		$company->investment_style = Input::get('investment_style');
		$company->deal_size = Input::get('deal_size');
		$company->current = Input::get('current');

		//Status and approved data befor saving the new status for the company, for notification Job
		$statusBefore = $company->status;
		$approvedBefore = $company->approved;

		$company->featured = Input::get('featured');
		$company->show_contact = Input::get('show_contact');
		$company->status = Input::get('status');
		$company->listing_status = Input::get('listing_status');
	    $company->approved = Input::get('approved');
	    
	    $company->user_id = $user ? $user->id : 0;

		$res = $company->save();

		if($res){

			$file = Input::file('image');
		    if($file){
	        	$company->image = upload($file, Company::getDir($company->id));
	        }

			$file = Input::file('logo');
		    if($file){
	        	$company->logo = upload($file, Company::getDir($company->id));
	        }

        	$company->save();

			//Hidden Fields
			$companyHidden->company_id = $company->id;
		    //Info
		    $companyHidden->name = Input::get('name_hidden') ? 1 : 0;
		    $companyHidden->name_arabic = Input::get('name_arabic_hidden') ? 1 : 0;
		    $companyHidden->started = Input::get('started_hidden') ? 1 : 0;
		    $companyHidden->email = Input::get('email_hidden') ? 1 : 0;
		    $companyHidden->website = Input::get('website_hidden') ? 1 : 0;
		    $companyHidden->address = Input::get('address_hidden') ? 1 : 0;
		    $companyHidden->phone = Input::get('phone_hidden') ? 1 : 0;
		    
		    //Details
		    $companyHidden->description = Input::get('description_hidden') ? 1 : 0;
		    //$companyHidden->logo = Input::get('logo_hidden') ? 1 : 0;
		    $companyHidden->video = Input::get('video_hidden') ? 1 : 0;
		    $companyHidden->map = Input::get('map_hidden') ? 1 : 0;
		    $companyHidden->social = Input::get('social_hidden') ? 1 : 0;
		    
		    // Investment info
		    $companyHidden->leverage_ratio = Input::get('leverage_ratio_hidden') ? 1 : 0;
		    $companyHidden->price_shares = Input::get('price_shares_hidden') ? 1 : 0;
		    $companyHidden->number_shares = Input::get('number_shares_hidden') ? 1 : 0;
		    $companyHidden->percentage = Input::get('percentage_hidden') ? 1 : 0;
		    $companyHidden->price_earning = Input::get('price_earning_hidden') ? 1 : 0;
		    $companyHidden->growth_rate = Input::get('growth_rate_hidden') ? 1 : 0;
		    $companyHidden->startdate = Input::get('startdate_hidden') ? 1 : 0;
		    //$companyHidden->enddate = Input::get('enddate_hidden') ? 1 : 0;
		    $companyHidden->target = Input::get('target_hidden') ? 1 : 0;
		    $companyHidden->min_investment = Input::get('min_investment_hidden') ? 1 : 0;
		    
 			$companyHidden->save();

			if( $statusBefore == 'published' && Input::get('status') == 'unpublished'){

				$title = sprintf(Config::get('ilosool.titles.listing_unpublished'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_unpublished'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_unpublished'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_unpublished'), $company->deal_name);
				$type = 'company_unpublish';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);

			}elseif( $statusBefore == 'unpublished' && Input::get('status') == 'published' ){

				$title = sprintf(Config::get('ilosool.titles.listing_published'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_published'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_published'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_published'), $company->deal_name);
				$type = 'company_publish';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);

			}
			if( $approvedBefore == 1 && Input::get('approved') == 0){

				$title = sprintf(Config::get('ilosool.titles.listing_unapproved'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_unapproved'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_unapproved'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_unapproved'), $company->deal_name);
				$type = 'company_unapproved';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);

			}elseif( $approvedBefore == 0 && Input::get('approved') == 1 ){

				$title = sprintf(Config::get('ilosool.titles.listing_approved'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_approved'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_approved'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_approved'), $company->deal_name);
				$type = 'company_approved';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);
			}

			if( Input::get('approved') == 1 ){
				Job::sendNotificationToUsers($company, 'edited');
			}

			$message = 'The Listing <strong>' . $company->deal_name . '</strong> has been edited Successfully';
		}else{
			$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be edited';
		}

		return Redirect::route('admin.companies')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
   	}

   	public function re_edit_post($id){

		//validate company
		$validator = Company::validateEditRe(Input::all());

	    if ($validator->fails())
	    {
	        return Redirect::route('admin.company.edit', $id)->withErrors($validator)->withInput();
	    }

	    if(Input::get('owner')){
	    	$user = User::find(Input::get('owner'));
	    }else{
	    	$user = Auth::user();
	    }

	    //social links
	    $links = Input::get('sociallink', array());
	    $names = Input::get('socialname', array());
	    $social = array();

	    for($i = 0; $i < count($names); $i++){
	    	$social[$names[$i]] = $links[$i];
	    }

	    //Company info
		$company = Company::find($id);
		$companyHidden = CompanyHidden::where('company_id', '=', $id)->first();

		$company->user_id = $user->id;
		$company->slug = Input::get('slug') ? Input::get('slug') : strtolower(str_replace(' ', '-', $company->deal_name));
		$company->name = Input::get('name');
		$company->name_arabic = Input::get('name_arabic');
	    //$company->fancyname = Input::get('fancyname');
	    $company->started = Input::get('started');
	    $company->email = Input::get('email');
	    $company->website = Input::get('website');
	    $company->city = Input::get('city');
	    $company->country = Input::get('country');
	    $company->address = Input::get('address');
	    $company->phone = Input::get('phone');
	    $company->description = Input::get('description');
	    $company->brief = Input::get('brief');
	    $company->video = Input::get('video');
	    $company->map = Input::get('map');
	    $company->social = $social;
	    $company->tags = Input::get('tags');

	    $company->number_sqf = Input::get('number_sqf');
	    $company->price_sqf = Input::get('price_sqf');
	    $company->yield = Input::get('yield');

	    $company->type = 're';

	    //investment
	    $company->leverage_ratio = Input::get('leverage_ratio');
		$company->deal_name = Input::get('deal_name');
		$company->startdate = new DateTime(Input::get('startdate'));
		$startdate = new DateTime(Input::get('startdate'));
		$company->enddate = $startdate->modify('+3 month');
		$company->target = Input::get('target');
		$company->min_investment = Input::get('min_investment');
		$company->geo_interests = Input::get('geo_interests');
		$company->sector = Input::get('sector');
		$company->investment_stage = Input::get('investment_stage');
		$company->investment_type = Input::get('investment_type');
		$company->investment_style = Input::get('investment_style');
		$company->deal_size = Input::get('deal_size');
		$company->current = Input::get('current');

		$company->featured = Input::get('featured');
		$company->show_contact = Input::get('show_contact');

		//Status and approved data befor saving the new status for the company, for notification Job
		$statusBefore = $company->status;
		$approvedBefore = $company->approved;

		$company->status = Input::get('status');
		$company->listing_status = Input::get('listing_status');
		$company->approved = Input::get('approved');
	    
	    $company->user_id = $user ? $user->id : 0;

		$res = $company->save();

		if($res){

			$file = Input::file('image');
		    if($file){
	        	$company->image = upload($file, Company::getDir($company->id));
	        }

			$file = Input::file('logo');
		    if($file){
	        	$company->logo = upload($file, Company::getDir($company->id));
	        }

	        $company->save();

			//Hidden Fields
			$companyHidden->company_id = $company->id;
		    //Info
		    $companyHidden->name = Input::get('name_hidden') ? 1 : 0;
		    $companyHidden->name_arabic = Input::get('name_arabic_hidden') ? 1 : 0;
		    $companyHidden->started = Input::get('started_hidden') ? 1 : 0;
		    $companyHidden->email = Input::get('email_hidden') ? 1 : 0;
		    $companyHidden->website = Input::get('website_hidden') ? 1 : 0;
		    $companyHidden->address = Input::get('address_hidden') ? 1 : 0;
		    $companyHidden->phone = Input::get('phone_hidden') ? 1 : 0;
		    
		    //Details
		    $companyHidden->description = Input::get('description_hidden') ? 1 : 0;
		    //$companyHidden->logo = Input::get('logo_hidden') ? 1 : 0;
		    $companyHidden->video = Input::get('video_hidden') ? 1 : 0;
		    $companyHidden->map = Input::get('map_hidden') ? 1 : 0;
		    $companyHidden->social = Input::get('social_hidden') ? 1 : 0;
		    
		    // Investment info
		    $companyHidden->leverage_ratio = Input::get('leverage_ratio_hidden') ? 1 : 0;
		    $companyHidden->number_sqf = Input::get('number_sqf_hidden') ? 1 : 0;
		    $companyHidden->price_sqf = Input::get('price_sqf_hidden') ? 1 : 0;
		    $companyHidden->yield = Input::get('yield_hidden') ? 1 : 0;
		    $companyHidden->startdate = Input::get('startdate_hidden') ? 1 : 0;
		    //$companyHidden->enddate = Input::get('enddate_hidden') ? 1 : 0;
		    $companyHidden->target = Input::get('target_hidden') ? 1 : 0;
		    $companyHidden->min_investment = Input::get('min_investment_hidden') ? 1 : 0;
		    
 			$companyHidden->save();

			if( $statusBefore == 'published' && Input::get('status') == 'unpublished'){

				$title = sprintf(Config::get('ilosool.titles.listing_unpublished'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_unpublished'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_unpublished'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_unpublished'), $company->deal_name);
				$type = 'company_unpublish';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);

			}elseif( $statusBefore == 'unpublished' && Input::get('status') == 'published' ){

				$title = sprintf(Config::get('ilosool.titles.listing_published'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_published'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_published'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_published'), $company->deal_name);
				$type = 'company_publish';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);

			}

			if( $approvedBefore == 1 && Input::get('approved') == 0){

				$title = sprintf(Config::get('ilosool.titles.listing_unapproved'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_unapproved'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_unapproved'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_unapproved'), $company->deal_name);
				$type = 'company_unapproved';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);

			}elseif( $approvedBefore == 0 && Input::get('approved') == 1 ){

				$title = sprintf(Config::get('ilosool.titles.listing_approved'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_approved'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_approved'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_approved'), $company->deal_name);
				$type = 'company_approved';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);
			}

			if( Input::get('approved') == 1 ){
				Job::sendNotificationToUsers($company, 'edited');
			}

			$message = 'The Listing <strong>' . $company->deal_name . '</strong> has been edited Successfully';
		}else{
			$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be edited';
		}

		return Redirect::route('admin.companies')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
   	}

   	public function approve($id, $action){

   		$company = Company::find($id);

   		if($action == 'approve'){
   			$company->approved = 1;
   		}elseif($action == 'unapprove'){
   			$company->approved = 0;
   		}

   		$res = $company->save();

   		if($res){
   			if($action == 'approve'){

   				$title = sprintf(Config::get('ilosool.titles.listing_approved'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_approved'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_approved'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_approved'), $company->deal_name);
				$type = 'company_approve';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);

				Job::sendNotificationToUsers($company, 'created');

			}elseif ($action == 'unapprove') {

				$title = sprintf(Config::get('ilosool.titles.listing_unapproved'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_unapproved'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_unapproved'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_unapproved'), $company->deal_name);
				$type = 'company_unapprove';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);
			}
		}else{
			if($action == 'approve'){
				$message = 'The Listing ' . $company->deal_name . ' can not be approved';
			}elseif ($action == 'unapprove') {
				$message = 'The Listing ' . $company->deal_name . ' can not be unapproved';
			}
		}
		
   		return Redirect::route('admin.companies')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
   	}

   	public function status($id, $action){
   		
   		$company = Company::find($id);

   		if($action == 'publish'){
   			$company->status = 'published';
   		}elseif($action == 'unpublish'){
   			$company->status = 'unpublished';
   		}

   		$res = $company->save();

   		if($res){
   			if($action == 'publish'){
   				//Create Job for publish notification 
				$title = sprintf(Config::get('ilosool.titles.listing_published'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_published'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_published'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_published'), $company->deal_name);
	        	$type = 'company_publish';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);
			}elseif ($action == 'unpublish') {
				//Create Job for unpublish notification 
				$title = sprintf(Config::get('ilosool.titles.listing_unpublished'), $company->deal_name);
				$message = sprintf(Config::get('ilosool.messages.listing_unpublished'), $company->deal_name);
				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.listing_unpublished'), $company->deal_name);
				$message_arabic = sprintf(Config::get('ilosool.messages_arabic.listing_unpublished'), $company->deal_name);
				$type = 'company_unpublish';
	        	$actionJob = 'notification+email';
	        	$url = URL::route('company.view', $company->id);
				Job::add($company->user_id, $actionJob , $type, $message, $url, $title, $title_arabic, $message_arabic);
			}
		}else{
			if($action == 'publish'){
				$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be published';
			}elseif ($action == 'unpublish') {
				$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be unpublished';
			}
		}

   		return Redirect::route('admin.companies')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
   	}

   	public function featured($id, $action){
   		
   		$company = Company::find($id);

   		if($action == 1){
   			$company->featured = 1;
   		}else{
   			$company->featured = 0;
   		}

   		$res = $company->save();

   		if($res){
   			if($action == 1){
				$message = 'The Listing <strong>' . $company->deal_name . '</strong> has been featured Successfully';
			}elseif ($action == 0) {
				$message = 'The Listing <strong>' . $company->deal_name . '</strong> has been unfeatured Successfully';
			}
		}else{
			if($action == 1){
				$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be featured';
			}elseif ($action == 0) {
				$message = 'The Listing <strong>' . $company->deal_name . '</strong> can not be unfeatured';
			}
		}

   		return Redirect::route('admin.companies')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
   	}

   	public function autoComplete($type){
		$input = Input::get('q');
		$data = array();
		$companies = Company::select('id', 'name')->where('name', 'LIKE', '%' . $input . '%')->take(10)->get();

		if($companies){
			foreach($companies as $company){
				$json = array();
				$json['id'] = ($type == 'id') ? $company->id : $company->name;
				$json['name'] = $company->name;
				$data[] = $json;
			}
		}
		//header("Content-type: application/json");
		return json_encode($data);
	}
}

