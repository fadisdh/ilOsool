<?php

class CompanyController extends BaseController {

	public function index()
    {
        $search = Input::get('search');
        $col = Input::get('col');
        $rows = Input::get('rows');

        $q = Company::select(array('*'));

        if($search){
        	$q = $q ->where('name','LIKE', '%' . $search . '%')
        			->orWhere('id','=', $search)
				    ->orWhere('deal_name','LIKE','%' . $search . '%')
				    ->orWhere('country','LIKE','%' . $search . '%')
				    ->orWhere('sector','LIKE','%' . $search . '%')
				    ->orWhere('type','LIKE','%' . $search . '%'); 
        }

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        $q->where('status', '=', 'published');
        $q->where('approved', '=', 1);

        if(isset($rows)){
        	$companies = $q->paginate($rows);
        }else{
        	$companies =  $q->paginate(12);
        }

	    return View::make('company.index')->with('companies', $companies);
    }

    public function view($id){

    	if( is_numeric($id) ){
    		$company = Company::find(rawurldecode($id));
    		$companyHidden = CompanyHidden::where('company_id','=', $company->id)->first();
    	}else{
    		$company = Company::where('slug', '=', rawurldecode($id))->first();
    		$companyHidden = CompanyHidden::where('company_id','=', $company->id)->first();
    	}
        
        $date = date('Y-m-d'); 

        if(!$company){
        	return View::make('common.error')->with('msg', trans('general.messages.listing_not_found'));
        }

        if (Auth::check()) {
        	if(isOwner($company->user_id) || can('company.view')){
	        	if (Auth::check()){
			        if($company->grantedAccess(Auth::user()->id, $company->id) == 'accepted' || isOwner($company->user_id) ){
				       	$attachments = Attachment::getAllCompanyAttachments($company->id);
				       	$staff = Staff::getAllCompanyStaff($company->id);
			       	}else{
			       		$attachments = Attachment::getCompanyAttachments($company->id);
			       		$staff = Staff::getCompanyStaff($company->id);
			       	}
				}else{
					$attachments = Attachment::getCompanyAttachments($company->id);
					$staff = Staff::getCompanyStaff($company->id);
				}

		        return View::make('company.view')->with('company', $company)->with('companyHidden', $companyHidden)->with('staff', $staff)->with('attachments', $attachments);
        	}
        }
        
        if($company->status == 'published' && $company->approved && $company->startdate <= $date){
	        if (Auth::check()){
		        if($company->grantedAccess(Auth::user()->id, $company->id) == 'accepted' || isOwner($company->user_id) ){
			       	$attachments = Attachment::getAllCompanyAttachments($company->id);
			       	$staff = Staff::getAllCompanyStaff($company->id);
		        }else{
		        	$attachments = Attachment::getCompanyAttachments($company->id);
		        	$staff = Staff::getCompanyStaff($company->id);
		        }
			}else{
				$attachments = Attachment::getCompanyAttachments($company->id);
				$staff = Staff::getCompanyStaff($company->id);
			}

	        return View::make('company.view')->with('company', $company)->with('companyHidden', $companyHidden)->with('staff', $staff)->with('attachments', $attachments);
	    }else{
	    	return View::make('common.error')->with('msg', trans('general.messages.listing_not_found'));
	    }

    }

	public function add()
	{	
		if(Auth::user()->rule_id != 3){
			$company = new Company();
			$company->id = 0;
			$attachmentspermissions = Config::get('ilosool.attachments_permissions');
			return View::make('company.add', array(
				'attachmentspermissions' 	=> $attachmentspermissions,
				'company' => $company
			))->with('topmenu', 'new-listing');
		}else{
			return View::make('page.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function pe_add()
	{	
		if(Auth::user()->rule_id != 3){
			$company = new Company();
			$companyHidden = new CompanyHidden();
			$company->id = 0;
			$attachmentspermissions = Config::get('ilosool.attachments_permissions');
			return View::make('company.pe_add', array(
				'attachmentspermissions' 	=> $attachmentspermissions,
				'company' => $company,
				'companyHidden' => $companyHidden
			))->with('topmenu', 'new-listing');
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function vc_add()
	{	
		if(Auth::user()->rule_id != 3){
			$company = new Company();
			$companyHidden = new CompanyHidden();
			$company->id = 0;
			$attachmentspermissions = Config::get('ilosool.attachments_permissions');
			return View::make('company.vc_add', array(
				'attachmentspermissions' 	=> $attachmentspermissions,
				'company' => $company,
				'companyHidden' => $companyHidden
			))->with('topmenu', 'new-listing');
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function re_add()
	{	
		if(Auth::user()->rule_id != 3){
			$company = new Company();
			$companyHidden = new CompanyHidden();
			$company->id = 0;
			$attachmentspermissions = Config::get('ilosool.attachments_permissions');
			return View::make('company.re_add', array(
				'attachmentspermissions' 	=> $attachmentspermissions,
				'company' => $company,
				'companyHidden' => $companyHidden
			))->with('topmenu', 'new-listing');
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function success($company_id){

		$company = Company::find($company_id);
		
		if( $company && isOwner($company->user_id)){
			return View::make('company.success')->with('company_id', $company->id);
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function pe_add_post($companyId)
	{
		if(Auth::user()->rule_id != 3){
			$user = Auth::user();

			//validate company
			if ($companyId == 0){
				$validator = Company::validatePe(Input::except('sociallink', 'socialname'));
			}else{
				$validator = Company::validateEditPe(Input::except('sociallink', 'socialname'));
			}

		    if ($validator->fails())
		    {
		        if ($companyId == 0){
			    	return Redirect::route('company.pe.add')->withErrors($validator)->withInput();
			    }else{
			    	return Redirect::route('company.edit', $companyId)->withErrors($validator)->withInput();
			    }
		    }

		    if(Input::get('owner')){
		    	$user = User::find(Input::get('owner'));
		    }else{
		    	$user = Auth::user();
		    }
		    
		    if ($companyId == 0){
		    	$company = new Company();
		    	$companyHidden = new CompanyHidden();
		    }else{
		    	$company = Company::find($companyId);
		    	$companyHidden = CompanyHidden::where('company_id', '=', $companyId)->first();
		    }


		    //social links
			$links = Input::get('sociallink', array());
		    $names = Input::get('socialname', array());
		    $social = array();

		    for($i = 0; $i < count($names); $i++){
		    	$social[$names[$i]] = $links[$i];
		    }
			
			$company->user_id = $user->id;
			$company->type = 'pe';

			if(!$company->id){
				$company->deal_name = Input::get('deal_name');
				$company->name = Input::get('name');
				$company->name_arabic = Input::get('name_arabic');
			}
			
		    $company->started = Input::get('started');
		    $company->email = Input::get('email');
		    $company->website = Input::get('website');
		    $company->city = Input::get('city');
		    $company->country = Input::get('country');
		    $company->address = Input::get('address');
		    $company->leverage_ratio = Input::get('leverage_ratio');
		    $company->cfb = Input::get('cfb') ? Input::get('cfb') : 0;
		    $company->phone = Input::get('phone');
		    $company->description = Input::get('description');
		    $company->brief = Input::get('brief');
		    $company->video = Input::get('video');
		    $company->map = Input::get('map');
		    $company->social = $social;

			//investment
			$company->geo_interests = Input::get('geo_interests');
			$company->sector = Input::get('sector');
			$company->investment_stage = Input::get('investment_stage');
			$company->investment_type = Input::get('investment_type');
			$company->investment_style = Input::get('investment_style');
			$company->deal_size = Input::get('deal_size');
			$company->price_shares = Input::get('price_shares');
			$company->price_shares_suffix = Input::get('price_shares_suffix');
			$company->number_shares = Input::get('number_shares');
			$company->percentage = Input::get('percentage');
			$company->price_earning = Input::get('price_earning');
			$company->startdate = new DateTime(Input::get('startdate'));
			$startdate = new DateTime(Input::get('startdate'));
			$company->enddate = $startdate->modify('+3 month');
			$company->target = Input::get('target');
			$company->target_suffix = Input::get('target_suffix');
			$company->min_investment = Input::get('min_investment');
			$company->min_investment_suffix = Input::get('min_investment_suffix');
		    
		    (getLocale() == 'ar') ? $action = 'تعديل' : $action = 'edited';

			if ($companyId == 0){
				$company->slug = strtolower(str_replace(' ', '-', $company->deal_name));
		    	$company->current = 0;
		    	$company->approved = 0;
		    	$company->status = "published";
		    	$company->listing_status = "open";
		    	$company->show_contact = 1;
				$company->featured = 0;
				(getLocale() == 'ar') ? $action = 'إضافة' : $action = 'created';
		    }

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

	 			if(getLocale() == 'ar'){
	 				$message = sprintf(trans('general.messages.new_deal_success'), $action, $company->deal_name);
	 			}else{
	 				$message = sprintf(trans('general.messages.new_deal_success'), $company->deal_name, $action);	
	 			}
	 			
			}else{
				if(getLocale() == 'ar'){
	 				$message = sprintf(trans('general.messages.deal_umsuccess'), $action, $company->deal_name);
	 			}else{
	 				$message = sprintf(trans('general.messages.deal_unsuccess'), $company->deal_name, $action);	
	 			}
			}

			if($action == 'created' || $action == 'إضافة'){

				$admin_ntf = new AdminNotification();
		   		$admin_ntf->reference_id = $company->id;
		   		$admin_ntf->request = 'new_deal';
		   		$admin_ntf->title = sprintf(Config::get('ilosool.messages.new_deal'), $company->deal_name);
		   		$admin_ntf->description = '<a href="' . URL::route('admin.company.view', $company->id) . '" target="_blank">View Listing</a>';
		   		$admin_ntf->save();

				$url = URL::route('admin.notifications');
		   		$title = sprintf(Config::get('ilosool.messages.new_deal'), $company->deal_name);
		   		$message = sprintf(Config::get('ilosool.messages.new_deal'), $company->deal_name);
		   		Job::adminNotification('notification+email', 'new_deal', $message, $url, $title);
				
				return Redirect::route('company.success', $company->id)->with('company_id', $company->id);

			}else{

				return Redirect::route('profile.companies')
				->with('action', ($companyId == 0 ? 'add' : 'edit'))
				->with('result', $res)
				->with('message', $message);
			}
			
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
   	}

   	public function vc_add_post($companyId)
	{
		if(Auth::user()->rule_id != 3){
			$user = Auth::user();

			//validate company
			if ($companyId == 0){
				$validator = Company::validateVc(Input::except('sociallink', 'socialname'));
			}else{
				$validator = Company::validateEditVc(Input::except('sociallink', 'socialname'));
			}

		    if ($validator->fails())
		    {
		        if ($companyId == 0){
			    	return Redirect::route('company.vc.add')->withErrors($validator)->withInput();
			    }else{
			    	return Redirect::route('company.edit', $companyId)->withErrors($validator)->withInput();
			    }
		    }

		    if(Input::get('owner')){
		    	$user = User::find(Input::get('owner'));
		    }else{
		    	$user = Auth::user();
		    }
		    
		    if ($companyId == 0){
		    	$company = new Company();
		    	$companyHidden = new CompanyHidden();
		    }else{
		    	$company = Company::find($companyId);
		    	$companyHidden = CompanyHidden::where('company_id', '=', $companyId)->first();
		    }

		    //social links
			$links = Input::get('sociallink', array());
		    $names = Input::get('socialname', array());
		    $social = array();

		    for($i = 0; $i < count($names); $i++){
		    	$social[$names[$i]] = $links[$i];
		    }
			
			$company->user_id = $user->id;
			$company->type = 'vc';

			if(!$company->id){
				$company->deal_name = Input::get('deal_name');
				$company->name = Input::get('name');
				$company->name_arabic = Input::get('name_arabic');
			}
		    $company->started = Input::get('started');
		    $company->email = Input::get('email');
		    $company->website = Input::get('website');
		    $company->city = Input::get('city');
		    $company->country = Input::get('country');
		    $company->address = Input::get('address');
		    $company->leverage_ratio = Input::get('leverage_ratio');
		    $company->cfb = Input::get('cfb') ? Input::get('cfb') : 0;
		    $company->phone = Input::get('phone');

		    $company->description = Input::get('description');
		    $company->brief = Input::get('brief');
		    $company->video = Input::get('video');
		    $company->map = Input::get('map');
		    $company->social = $social;

		    //investment
			$company->geo_interests = Input::get('geo_interests');
			$company->sector = Input::get('sector');
			$company->investment_stage = Input::get('investment_stage');
			$company->investment_type = Input::get('investment_type');
			$company->investment_style = Input::get('investment_style');
			$company->deal_size = Input::get('deal_size');
			$company->price_shares = Input::get('price_shares');
			$company->price_shares_suffix = Input::get('price_shares_suffix');
			$company->number_shares = Input::get('number_shares');
			$company->percentage = Input::get('percentage');
			$company->price_earning = Input::get('price_earning');
			$company->growth_rate = Input::get('growth_rate');
			$company->startdate = new DateTime(Input::get('startdate'));
			$startdate = new DateTime(Input::get('startdate'));
			$company->enddate = $startdate->modify('+3 month');
			$company->target = Input::get('target');
			$company->target_suffix = Input::get('target_suffix');
			$company->min_investment = Input::get('min_investment');
			$company->min_investment_suffix = Input::get('min_investment_suffix');
		    
		    (getLocale() == 'ar') ? $action = 'تعديل' : $action = 'edited';

			if ($companyId == 0){
		    	$company->slug = strtolower(str_replace(' ', '-', $company->deal_name));
		    	$company->current = 0;
		    	$company->approved = 0;
		    	$company->status = "published";
		    	$company->listing_status = "open";
		    	$company->show_contact = 1;
				$company->featured = 0;
				(getLocale() == 'ar') ? $action = 'إضافة' : $action = 'created';
		    }

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

	 			if(getLocale() == 'ar'){
	 				$message = sprintf(trans('general.messages.new_deal_success'), $action, $company->deal_name);
	 			}else{
	 				$message = sprintf(trans('general.messages.new_deal_success'), $company->deal_name, $action);	
	 			}				
			}else{
				if(getLocale() == 'ar'){
	 				$message = sprintf(trans('general.messages.deal_unsuccess'), $action, $company->deal_name);
	 			}else{
	 				$message = sprintf(trans('general.messages.deal_unsuccess'), $company->deal_name, $action);	
	 			}

			}

			if($action == 'created' || $action == 'إضافة'){

				$admin_ntf = new AdminNotification();
		   		$admin_ntf->reference_id = $company->id;
		   		$admin_ntf->request = 'new_deal';
		   		$admin_ntf->title = sprintf(Config::get('ilosool.messages.new_deal'), $company->deal_name);
		   		$admin_ntf->description = '<a href="' . URL::route('admin.company.view', $company->id) . '" target="_blank">View Listing</a>';
		   		$admin_ntf->save();

				$url = URL::route('admin.notifications');
		   		$title = sprintf(Config::get('ilosool.messages.new_deal'), $company->deal_name);
		   		$message = sprintf(Config::get('ilosool.messages.new_deal'), $company->deal_name);
		   		Job::adminNotification('notification+email', 'new_deal', $message, $url, $title);

				return Redirect::route('company.success', $company->id)->with('company_id', $company->id);
			}else{

				return Redirect::route('profile.companies')
				->with('action', ($companyId == 0 ? 'add' : 'edit'))
				->with('result', $res)
				->with('message', $message);
			}
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
   	}

   	public function re_add_post($companyId)
	{

		if(Auth::user()->rule_id != 3){
			$user = Auth::user();

			//validate company
			if ($companyId == 0){

				$validator = Company::validateRe(Input::except('sociallink', 'socialname'));

			}else{

				$validator = Company::validateEditRe(Input::except('sociallink', 'socialname'));

			}

		    if ($validator->fails())
		    {

		        if ($companyId == 0){

			    	return Redirect::route('company.re.add')->withErrors($validator)->withInput();

			    }else{

			    	return Redirect::route('company.edit', $companyId)->withErrors($validator)->withInput();
			    }
		    }

		    if(Input::get('owner')){
		    	$user = User::find(Input::get('owner'));
		    }else{
		    	$user = Auth::user();
		    }
		    
		    if ($companyId == 0){
		    	$company = new Company();
		    	$companyHidden = new CompanyHidden();
		    }else{
		    	$company = Company::find($companyId);
		    	$companyHidden = CompanyHidden::where('company_id', '=', $companyId)->first();
		    }

		    //social links
			$links = Input::get('sociallink', array());
		    $names = Input::get('socialname', array());
		    $social = array();

		    for($i = 0; $i < count($names); $i++){
		    	$social[$names[$i]] = $links[$i];
		    }
			
			$company->user_id = $user->id;
			$company->type = 're';

			if(!$company->id){
				$company->deal_name = Input::get('deal_name');
				$company->name = Input::get('name');
				$company->name_arabic = Input::get('name_arabic');
			}

		    $company->started = Input::get('started');
		    $company->email = Input::get('email');
		    $company->website = Input::get('website');
		    $company->city = Input::get('city');
		    $company->country = Input::get('country');
		    $company->address = Input::get('address');
		    $company->leverage_ratio = Input::get('leverage_ratio');
		    $company->cfb = Input::get('cfb') ? Input::get('cfb') : 0;
		    $company->phone = Input::get('phone');

		    $company->description = Input::get('description');
		    $company->brief = Input::get('brief');
		    $company->video = Input::get('video');
		    $company->map = Input::get('map');
		    $company->social = $social;

		    //investment
			$company->geo_interests = Input::get('geo_interests');
			$company->investment_stage = Input::get('investment_stage');
			$company->investment_type = Input::get('investment_type');
			$company->investment_style = Input::get('investment_style');
			$company->deal_size = Input::get('deal_size');
			$company->sector = Input::get('sector');
			$company->number_sqf = Input::get('number_sqf');
			$company->number_sqf_suffix = Input::get('number_sqf_suffix');
			$company->price_sqf = Input::get('price_sqf');
			$company->price_sqf_suffix = Input::get('price_sqf_suffix');
			$company->yield = Input::get('yield');
			//$company->tags = Input::get('tags');
			$company->startdate = new DateTime(Input::get('startdate'));
			$startdate = new DateTime(Input::get('startdate'));
			$company->enddate = $startdate->modify('+3 month');
			$company->target = Input::get('target');
			$company->target_suffix = Input::get('target_suffix');
			$company->min_investment = Input::get('min_investment');
			$company->min_investment_suffix = Input::get('min_investment_suffix');

			(getLocale() == 'ar') ? $action = 'تعديل' : $action = 'edited';

			if ($companyId == 0){
				$company->slug = strtolower(str_replace(' ', '-', $company->deal_name));
		    	$company->current = 0;
		    	$company->approved = 0;
		    	$company->status = "published";
		    	$company->listing_status = "open";
		    	$company->show_contact = 1;
				$company->featured = 0;
				(getLocale() == 'ar') ? $action = 'إضافة' : $action = 'created';
		    }

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

				if(getLocale() == 'ar'){
	 				$message = sprintf(trans('general.messages.new_deal_success'), $action, $company->deal_name);
	 			}else{
	 				$message = sprintf(trans('general.messages.new_deal_success'), $company->deal_name, $action);	
	 			}
			}else{
				if(getLocale() == 'ar'){
	 				$message = sprintf(trans('general.messages.deal_unsuccess'), $action, $company->deal_name);
	 			}else{
	 				$message = sprintf(trans('general.messages.deal_unsuccess'), $company->deal_name, $action);	
	 			}
			}

			if($action == 'created' || $action == 'إضافة'){

				$admin_ntf = new AdminNotification();
		   		$admin_ntf->reference_id = $company->id;
		   		$admin_ntf->request = 'new_deal';
		   		$admin_ntf->title = sprintf(Config::get('ilosool.messages.new_deal'), $company->deal_name);
		   		$admin_ntf->description = '<a href="' . URL::route('admin.company.view', $company->id) . '" target="_blank">View Listing</a>';
		   		$admin_ntf->save();

				$url = URL::route('admin.notifications');
		   		$title = sprintf(Config::get('ilosool.messages.new_deal'), $company->deal_name);
		   		$message = sprintf(Config::get('ilosool.messages.new_deal'), $company->deal_name);
		   		Job::adminNotification('notification+email', 'new_deal', $message, $url, $title);
		   		
				return Redirect::route('company.success', $company->id)->with('company_id', $company->id);
			}else{
				return Redirect::route('profile.companies')
				->with('action', ($companyId == 0 ? 'add' : 'edit'))
				->with('result', $res)
				->with('message', $message);
			}
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
   	}

	public function company_type()
	{	
		if(Auth::user()->rule_id != 3){
			$company = new Company();
			$company->id = 0;
			return View::make('company.company_type', array('company' => $company))->with('topmenu', 'new-listing');
		}else{
			return View::make('common.error')->with('msg', Config::get('ilosool.messages.permission_denied'));
		}
	}

	public function edit($id){

		if(Auth::user()->rule_id != 3){
			$attachmentspermissions = Config::get('ilosool.attachments_permissions');
			$company = Company::find($id);
			$companyHidden = CompanyHidden::where('company_id', '=', $id)->first();
			if(isOwner($company->user_id) ){
				if($company->type == 're'){
					return View::make('company.re_add')->with('company', $company)->with('companyHidden', $companyHidden)->with('attachmentspermissions', $attachmentspermissions);
				}elseif($company->type == 'vc'){
					return View::make('company.vc_add')->with('company', $company)->with('companyHidden', $companyHidden)->with('attachmentspermissions', $attachmentspermissions);
				}elseif($company->type == 'pe'){
					return View::make('company.pe_add')->with('company', $company)->with('companyHidden', $companyHidden)->with('attachmentspermissions', $attachmentspermissions);
				}
			}else{
				return URL::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}
   
	public function delete($id){

		if(Auth::user()->rule_id != 3){
			$company = Company::find($id);

			if(isOwner($company->user_id) ){
				$res = $company->delete();

				if($res){
					$message = 'The deal <strong>' . $company->deal_name . '</strong> is deleted Successfully';
				}else{
					$message = 'The deal <strong>' . $company->deal_name . '</strong> can not be deleted';
				}

				return Redirect::route('companies')
					->with('action', 'delete')
					->with('result', $res)
					->with('message', $message);
			}else{
				return URL::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function add_post($companyId)
	{
		if(Auth::user()->rule_id != 3){
			$user = Auth::user();

			//validate company
			$validator = Company::validate(Input::except('sociallink', 'socialname'));

		    if ($validator->fails())
		    {
		        if ($companyId == 0){
			    	return Redirect::route('company.add')->withErrors($validator)->withInput();
			    }else{
			    	return Redirect::route('company.edit', $companyId)->withErrors($validator)->withInput();
			    }
		    }

		    if(Input::get('owner')){
		    	$user = User::find(Input::get('owner'));
		    }else{
		    	$user = Auth::user();
		    }
		    
		    if ($companyId == 0){
		    	$company = new Company();
		    }else{
		    	$company = Company::find($companyId);
		    }

		    //social links
			$links = Input::get('sociallink', array());
		    $names = Input::get('socialname', array());
		    $social = array();

		    for($i = 0; $i < count($names); $i++){
		    	$social[$names[$i]] = $links[$i];
		    }
			
			$company->user_id = $user->id;
			$company->name = Input::get('name');
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
		    $company->yield = Input::get('yield');
		    //$company->tags = Input::get('tags');
		    $company->shares = Input::get('shares');
		    $company->private_equity = Input::get('private_equity');
		    $company->price_sqf = Input::get('price_sqf');
		    $company->growth_rate = Input::get('growth_rate');

		    $company->type = Input::get('type');
		    $company->sector = Input::get('sector');
		    $company->investment_stage = Input::get('investment_stage');
		    $company->user_id = $user ? $user->id : 0;

		    //investment
			$company->deal_name = Input::get('deal_name');
			$company->startdate = Input::get('startdate');
			$company->enddate = Input::get('enddate');
			$company->target = Input::get('target');
			$company->min_investment = Input::get('min_investment');
			$company->geo_interest = Input::get('geo_interest');
			$company->investment_type = Input::get('investment_type');
			$company->deal_size = Input::get('deal_size');
			
			if ($companyId == 0){
		    	$company->current = 0;
		    	$company->approved = 0;
		    	$company->status = "unpublished";
		    	$company->show_contact = 1;
				$company->featured = "not";
		    }

			$company->save();

			$file = Input::file('image');
		    if($file){
				$destinationPath = Company::getDir($company->id);
		        $filename = $file->getClientOriginalName();
		        $uploadSuccess = $file->move($destinationPath, $filename);

		        if($uploadSuccess) {
				    $company->image = $filename;
				}
			}

			$file = Input::file('logo');
		    if($file){
				$destinationPath = Company::getDir($company->id);
		        $filename = $file->getClientOriginalName();
		        $uploadSuccess = $file->move($destinationPath, $filename);

		        if($uploadSuccess) {
				    $company->logo = $filename;
				}
			}

			$res = $company->save();

			if($res){
				$message = 'The deal <strong>' . $company->deal_name . '</strong> is created Successfully';
			}else{
				$message = 'The deal <strong>' . $company->deal_name . '</strong> can not be created';
			}

			return Redirect::route('profile.companies')
					->with('action', 'add')
					->with('result', $res)
					->with('message', $message);
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
   	}

   	public function edit_post($id){
   		if(Auth::user()->rule_id != 3){
	   		$user = Auth::user();

			//validate company
			$validator = Company::validate(Input::except('sociallink', 'socialname'));

		    if ($validator->fails())
		    {
		        return Redirect::route('company.edit', $id)->withErrors($validator)->withInput();
		    }

		    //Company info
			$company = Company::find($id);

			//social links
			$links = Input::get('sociallink', array());
		    $names = Input::get('socialname', array());
		    $social = array();

		    for($i = 0; $i < count($names); $i++){
		    	$social[$names[$i]] = $links[$i];
		    }
		    
			if($company->validate(Input::all())){
				$company->name = Input::get('name');
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
			    $company->yield = Input::get('yield');
			    //$company->tags = Input::get('tags');
			    $company->shares = Input::get('shares');
			    $company->type = Input::get('type');
			    $company->sector = Input::get('sector');
			    $company->private_equity = Input::get('private_equity');
			    $company->price_sqf = Input::get('price_sqf');

			    $company->growth_rate = Input::get('growth_rate');
			    
			    $file = Input::file('image');
			    
			    if($file){
					$destinationPath = Company::getDir($company->id);
			        $filename = $file->getClientOriginalName();
			        $uploadSuccess = $file->move($destinationPath, $filename);

			        if($uploadSuccess) {
					    $company->image = $filename;
					}
				}

				$file = Input::file('logo');
			    if($file){
					$destinationPath = Company::getDir($company->id);
			        $filename = $file->getClientOriginalName();
			        $uploadSuccess = $file->move($destinationPath, $filename);

			        if($uploadSuccess) {
					    $company->logo = $filename;
					}
				}

			    $company->investment_stage = Input::get('investment_stage');
			    $company->deal_name = Input::get('deal_name');
			    $company->startdate = Input::get('startdate');
			    $company->enddate = Input::get('enddate');
			    $company->geo_interest = Input::get('geo_interest');
			    $company->target = Input::get('target');
			    $company->min_investment = Input::get('min_investment');
			    $company->investment_type = Input::get('investment_type');
			    $company->deal_size = Input::get('deal_size');
			    		    
				$res = $company->save();
			}

			if($res){
				$message = 'The deal <strong>' . $company->deal_name . '</strong> is created Successfully';
			}else{
				$message = 'The deal <strong>' . $company->deal_name . '</strong> can not be created';
			}

			return Redirect::route('profile.companies')
					->with('action', 'edit')
					->with('result', $res)
					->with('message', $message);
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
   	}

   	public function updateInvestment($companyId){
   		if(Auth::user()->rule_id != 3){
	   		$company = Company::find($companyId);

	   		if(isOwner($company->user_id) ){
				return View::make('company.form.update_popup')->with('company', $company);
			}else{
				return Redirect::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', Config::get('ilosool.messages.permission_denied'));
		}
   	}

   	public function updateStatus($companyId){

   		$company = Company::find($companyId);
   		if(isOwner($company->user_id)){
			return View::make('company.form.update_status_popup')->with('company', $company);
		}else{
			return View::make('common.error')->with('msg', Config::get('ilosool.messages.permission_denied'));
		}
   	}

   	public function updateStatus_post($companyId){

   		if(Input::get('status')){
   			$company = Company::find($companyId);
   			$company->listing_status = Input::get('status');
   			$res = $company->save();

   			if($res){
				$message = trans('general.messages.status_success');
			}else{
				$message = trans('general.messages.status_unsuccess');
			}

   			return json_encode(array('message' => (string)View::make('common.popup_alert')->with('message', $message), 'refresh' => true));
   		}else{
   			return View::make('common.error')->with('msg', Config::get('ilosool.messages.permission_denied'));
   		}
	}

   	public function updateInvestment_post($companyId){
   		if(Auth::user()->rule_id != 3){
	   		$company = Company::find($companyId);
	   		if(isOwner($company->user_id) ){
		   		$validator = Company::validateUpdateInvestment(Input::all());

				if ($validator->fails()){	
					return json_encode(array('message' => (string)View::make('company.form.update_popup')->with('company', $company)->with('error','error')->with('old',Input::get('current'))));
				}
		   		
		   		$company->current = Input::get('current');
		   		$res = $company->save();

		   		if($res){
					$message = trans('general.messages.invest_success');
				}else{
					$message = trans('general.messages.invest_unsuccess');
				}
		   		return json_encode(array('message' => (string)View::make('common.popup_alert')->with('message', $message), 'refresh' => true));
		   	}else{
				return Redirect::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', Config::get('ilosool.messages.permission_denied'));
		}
   	}

   	public function staffView($company_id, $staff_id){

   		$company = Company::find($company_id);

   		if($company->status != "published"){
   			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
   		}else{
   			$staff = Staff::find($staff_id);
   			if($staff->access == "public"){
   				return View::make('company.staff_popup')->with('staff', $staff);
   			}else{
   				$granted = CompanyPermissions::where('company_id', '=', $company_id)
		        								->where('user_id', '=', Auth::user()->id)
		        								->where('status', '=', 'accepted')
		        								->first();			        
		        if($granted || isOwner($company->user_id)) {
		        	return View::make('company.staff_popup')->with('staff', $staff);
		        }else{
		        	$title = trans('general.messages.permission_denied');
		        	return View::make('common.error')->with('msg', trans('general.messages.permission_denied'))->with('title', $title);
		        }
   			}
   		}
   	}

	public function bookmark($company_id, $action){
		
   		if(Auth::check()){

	   		$company = Company::find($company_id);
	   		//if(isOwner($company->user_id) ){
		   		if($company){
			   		if($action == 'add'){
			   		
			   			$folders = Folder::where('user_id', '=', Auth::user()->id)->get();
			   			return View::make('company.bookmark_popup')->with('folders', $folders)
			   														->with('company', $company);
		   			}elseif($action == 'move'){
		   				$bookmark = Bookmark::where('user_id', '=', Auth::user()->id)
		   										->where('company_id', '=', $company_id)
		   										->first();
				   		$folders = Folder::where('user_id', '=', Auth::user()->id)->get();
						return View::make('company.bookmark_popup')->with('folders', $folders)
						   											->with('company', $company)
						   											->with('folder_id', $bookmark->folder_id);
		   			}
		   			elseif($action == 'remove'){
		   				$bookmark = Bookmark::where('user_id', '=', Auth::user()->id)->where('company_id', '=', $company_id)->first();
						return View::make('company.delete_bookmark_confirm_popup')->with('bookmarkId', $bookmark->id);
		   			}

		   		}else{
		   			return View::make('common.error')->with('msg', trans('general.messages.page_not_found'))->with('title', trans('general.messages.page_not_found'));
		   		}
		   	//}else{
			//	return Redirect::route('user.home');			
			//}
   		}else{
   			(getLocale() == 'ar') ? $action = 'إضافة المرجعية' : $action = 'bookmark';
   			$msg = sprintf(trans('general.messages.register_required'), $action);
   			return View::make('common.popup_alert_login')->with('message', $msg);
   		}
   	}

   	public function bookmark_delete($bookmarkId){

   		$bookmark = Bookmark::find($bookmarkId);
   		$bookmark->delete();

   		(getLocale() == 'ar') ? $action = 'المرجعية' : $action = 'Bookmark';
		$msg = sprintf(trans('general.messages.remove_success'), $action);
		return View::make('common.popup_alert')->with('message', $msg);
   	}

   	public function bookmark_post($company_id){

		$folder = Input::get('folder');
		$oldFolder = Input::get('folder_id');
		$company = Company::find($company_id);

		
		//if bookmark exists remove before add
		//this is for the move action
		$exists = Bookmark::where('user_id', '=', Auth::user()->id)
							->where('company_id', '=', $company_id)
							->where('folder_id', '=', $oldFolder)->first();

		if($exists){
			$exists->delete();
		}

		if($folder == "0"){

			$folders = Folder::where('user_id', '=', Auth::user()->id)->get();
	    	
			return json_encode(array('message' => (string)View::make('company.bookmark_popup')->with('company', $company)
		        																				->with('selected', false)
		        																				->with('folders', $folders)));

   		}elseif($folder == "new"){

   			$validator = Folder::validate(Input::all());

		    if ($validator->fails())
		    {
		    	$folders = Folder::where('user_id', '=', Auth::user()->id)->get();
		    	$folder_name = Input::get('folder_name');
		    	
		        return json_encode(array('message' => (string)View::make('company.bookmark_popup')->with('company', $company)
		        																				->with('error', true)
		        																				->with('folder_name', $folder_name)
		        																				->with('folders', $folders)));
		    }

   			$folder = new Folder();
   			$folder->user_id = Auth::user()->id;
   			$folder->name = Input::get('folder_name');
   			$folder->default = 0;
   			$folder->save();

   			$lastFolder = Folder::where('user_id', '=', Auth::user()->id)
   								->orderBy('created_at', 'desc')
   								->first();

   			$bookmark = new Bookmark();
			$bookmark->folder_id = $lastFolder->id;
	   		$bookmark->user_id = Auth::user()->id;
	   		$bookmark->company_id = $company_id;
	   		$bookmark->save();

	   		$message = sprintf(Config::get('ilosool.messages.deal_bookmarked'), Auth::user()->getPublicName(), $company->deal_name);
	   		$message_arabic = sprintf(Config::get('ilosool.messages_arabic.deal_bookmarked'), Auth::user()->getPublicName(), $company->deal_name);
	   		$title = sprintf(Config::get('ilosool.titles.deal_bookmarked'), Auth::user()->getPublicName(), $company->deal_name);
	   		$title_arabic = sprintf(Config::get('ilosool.titles_arabic.deal_bookmarked'), Auth::user()->getPublicName(), $company->deal_name);
	   		$url = URL::route('company.view', $company->id);
	   		Job::add($company->user_id, 'notification', 'bookmark', $message, $url, $title, $title_arabic, $message_arabic);

   		}else{
			$bookmark = new Bookmark();
			$bookmark->folder_id = $folder;
	   		$bookmark->user_id = Auth::user()->id;
	   		$bookmark->company_id = $company_id;
	   		$bookmark->save();

	   		$message = sprintf(Config::get('ilosool.messages.deal_bookmarked'), Auth::user()->getPublicName(), $company->deal_name);
	   		$message_arabic = sprintf(Config::get('ilosool.messages_arabic.deal_bookmarked'), Auth::user()->getPublicName(), $company->deal_name);
	   		$title = sprintf(Config::get('ilosool.titles.deal_bookmarked'), Auth::user()->getPublicName(), $company->deal_name);
	   		$title_arabic = sprintf(Config::get('ilosool.titles_arabic.deal_bookmarked'), Auth::user()->getPublicName(), $company->deal_name);
	   		$url = URL::route('company.view', $company->id);
	   		Job::add($company->user_id, 'notification', 'bookmark', $message, $url, $title, $title_arabic, $message_arabic);
   		}

   		if(getLocale() == 'ar'){
   			$action = 'إضافة';	
   			$msg = sprintf(trans('general.messages.success'), $action, $company->deal_name);
   		}else{
   			$action = 'bookmarked';	
   			$msg = sprintf(trans('general.messages.success'), $company->deal_name, $action);
   		}
		
   		return json_encode(array('message' => (string )View::make('common.popup_alert')->with('message', $msg), 'refresh' => true));
	   	
	}

   	public function invest($id){

   		if(Auth::check()){
	   		$company = Company::find($id);
   			return View::make('company.invest_popup')->with('company', $company);
   		}else{
  			(getLocale() == 'ar') ? $action = 'لتستثمر' : $action = 'invest';
			$msg = sprintf(trans('general.messages.login_required'), $action);
   			return View::make('common.popup_alert_login')->with('message', $msg);
   		}
   	}

   	public function investConfirm($companyId, $investorId){
   		
   		//TO DO
   		/* equation for amount value */

   		$validator = Investment::validate(Input::all());

	    if ($validator->fails())
	    {
	    	$amount = Input::get('amount');
	    	$company = Company::find($companyId);
	        return json_encode(array('message' => (string )View::make('company.invest_popup')->with('company', $company)->with('error', true)->with('amount', $amount)));
	    }

   		$investment = new Investment();
   		
   		$investment->value = Input::get('amount');
   		$investment->amount = 0;
   		$investment->status = "pending";
   		$investment->user_id = $investorId;
   		$investment->company_id = $companyId;
		$investment->save();

   		/** Send message to the invested in company, with the invest info**/
   		$company = Company::find($companyId);
   		$sender = User::find($investorId);

   		$message = new Message;
   		$message->title = sprintf(Config::get('ilosool.titles.investment_request'), $company->deal_name);
   		$message->content = sprintf(Config::get('ilosool.messages.investment_request'), $sender->firstname, $sender->lastname, $company->deal_name, $investment->value);

   		
   		$message->type = "invest";
   		$message->sender_id = $sender->id;
   		$message->receiver_id = $company->user_id;
   		$message->company_id = $company->id;
   		$message->investment_id = $investment->id;
   		$message->viewed = 0;
   		$message->save();

   		return json_encode(array('message' => (string )View::make('common.popup_alert')->with('message', trans('general.messages.invest_success'))));
   	}

   	//
   	public function request($company_id, $request){

   		if(Auth::check()){
   			$company = Company::find($company_id);
			return View::make('company.request_admin_ntf_popup')->with('company', $company)->with('request', $request);
   		}else{
   			if(getLocale() == 'ar'){
	   			$msg = sprintf(trans('general.messages.login_required'), 'طلب');
	   		}else{
	   			$msg = sprintf(trans('general.messages.login_required'), 'request');
	   		}
   			return View::make('common.popup_alert_login')->with('message', $msg);
   		}
   	}

   	public function requestConfirm($company_id, $request){
   		
   		$company = Company::find($company_id);
   		$validator = Company::validateRequestAdminNtf(Input::all());

	    if ($validator->fails())
	    {
	        return json_encode(array('message' => (string)View::make('company.request_admin_ntf_popup')->with('error', true)
	        																							->with('company', $company)
	        																							->with('request', $request)));
	    }

   		$description = Input::get('description') . ' <br><a href="' . URL::route('admin.company.view', $company_id) . '" target="_blank">View Listing</a>';

   		$admin_ntf = new AdminNotification();
   		$admin_ntf->reference_id = $company_id;
   		$admin_ntf->request = $request;
   		$admin_ntf->title = sprintf(Config::get('ilosool.messages.admin_notification'), $company->deal_name, $request);
   		$admin_ntf->description = $description;
   		$admin_ntf->save();

		$url = URL::route('admin.notifications');
   		$title = sprintf(Config::get('ilosool.messages.admin_notification'), $company->deal_name, $request);
   		$message = $description;
   		Job::adminNotification('notification+email', 'request_'. $request, $message, $url, $title);

   		return json_encode(array('message' => (string )View::make('common.popup_alert')->with('message', trans('general.messages.request_success'))));

   	}

   	public function requests($company_id){
   		if(Auth::user()->rule_id != 3){
			$company = Company::find($company_id);
			if(isOwner($company->user_id) ){

				$status = Input::get('status');

				if($status && $status != 'all'){
					$requests = CompanyPermissions::where('company_id', '=', $company_id)
													->where('status', '=', $status)
													->orderBy('status', 'desc')
													->paginate(Config::get('ilosool.rows_default'));
				}else{
					$requests = CompanyPermissions::where('company_permissions.company_id', '=', $company_id)
													->orderBy('status', 'desc')
													->paginate(Config::get('ilosool.rows_default'));
				}

		        return View::make('company.requests')->with('requests', $requests)
		        									->with('company_id', $company_id)
		        									->with('topmenu', 'companies')
		        								 	->with('sidemenu', 'companies');
		    }else{
				return Redirect::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
   	}

   	public function Statistics(){

   		return View::make('common.popup_alert')->with('message',  trans('general.messages.soon'));
   	}


   	
}