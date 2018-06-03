<?php

class RegisterController extends BaseController {

	public function registerPopup(){

		$type = Input::get('type');
		return View::make('register.registerPopup')->with('type', $type);
	}

	public function register()
	{
		$type = Input::get('type');
		$user = new User();
		if(Session::get('linkedin.email')){

			$user->firstname = Session::get('linkedin.firstname');
			$user->lastname = Session::get('linkedin.lastname');
			$user->email = Session::get('linkedin.email');
			$user->address = Session::get('linkedin.address');
			$user->country = Session::get('linkedin.country');
			$user->phone = Session::get('linkedin.phone');
		}
		$user->id = 0;
		return View::make('register.register')->with('user', $user)->with('type', $type);
	}

	public function register_post()
	{
		$type = Input::get('user_type');
		
		if($type == 'agent'){
			$validator = User::validateRegisterAgent(Input::all());
		}elseif($type == 'company'){
			$validator = User::validateRegisterCompany(Input::all());
		}else{
			$validator = User::validateRegister(Input::all());
		}

	    if ($validator->fails())
	    {
	    	return Redirect::to('register/?type='.$type )->withErrors($validator)->withInput();
	    }
	
		$user = new User();
		$user->user_type = Input::get('user_type');
		$user->firstname = Input::get('firstname');
	    $user->lastname = Input::get('lastname');
	    $user->nickname = Input::get('nickname');
	    $user->email = Input::get('email');
	    $user->password = Hash::make(Input::get('password'));
	    $user->city = Input::get('city');
	    $user->country = Input::get('country');
	    $user->address = Input::get('address');

	    if($type == 'both'){
		    $user->rbc = Input::get('rbc');
		    $user->rsc = Input::get('rsc');
	    }

	    $user->phone = Input::get('phone');
	    $user->company_name = Input::get('company_name');

	    $user->status = Config::get('ilosool.default_user_status');
	    $user->subscribed = Input::get('subscribed') ? 1 : 0;
	    $user->rule_id = '7'; // General user


	    if(!Session::get('linkedin.email')){
	    	$user->generateConfirmationCode();
			$user->sendConfirmEmail($user);
			$page = Page::where('slug', 'register-success')->first();
	    }else{
	    	$user->confirmed = '1';
	    	$page = Page::where('slug', 'register-success-linkedin')->first();

	    	$data = array();
	    	
	    	Mail::send('emails.auth.register-success', $data, function($message) use ($user)
			{
				$message->from('info@ilosool.com', 'ilOsool');
			    $message->to($user->email, $user->firstname . ' ' . $user->lastname)->subject('Welcome to ilOsool!');
			});
	    }

	    $user->hidden_name =  1;
		$user->hidden_contact_info = 1;

	    $user->save();

	    $message = $title = $user->firstname . ' ' . $user->lastname . " Registered to ilOsool";
		//Job::add(60, $actionJob, $type, $jobMessage, $url, $title); // Bdewi user
		//Job::add(74, $actionJob, $type, $jobMessage, $url, $title); // Qutaibah user

		$admin_ntf = new AdminNotification();
   		$admin_ntf->reference_id = $user->id;
   		$admin_ntf->request = 'new_user';
   		$admin_ntf->title = $title;
   		$admin_ntf->description = ' <a href="' . URL::route('admin.user.view', $user->id) . '" target="_blank">View User</a>';
   		$admin_ntf->save();

		$url = URL::route('admin.notifications');
   		Job::adminNotification('notification+email', 'new_deal', $message, $url, $title);

		return View::make('register.register_success')->with('page', $page);
	}

	public function register_complete_skip($type){
		
		$user = Auth::user();
		$user->skiped = 1;

		if( $type == 'investor'){
			$user->rule_id = 3;
			$user->save();
			return Redirect::to('profile');
		}elseif( $type == 'both' ){
			$user->rule_id = 5;
			$user->save();
			return View::make('register.complete.lister')->with('type', 'both');
		}
	}

	public function investor($type)
	{
		
		$user = new User();
		if(Session::get('linkedin.email')){

			$user->firstname = Session::get('linkedin.firstname');
			$user->lastname = Session::get('linkedin.lastname');
			$user->email = Session::get('linkedin.email');
			$user->address = Session::get('linkedin.address');
			$user->country = Session::get('linkedin.country');
			$user->phone = Session::get('linkedin.phone');
		}
		$user->id = 0;
		//return Redirect::route('earlyaccess', array('type' => 'investor'));
		return View::make('register.complete.investor')->with('user', $user)
													   ->with('type', $type);
	}

	public function investor_post($type)
	{
	    
		$pe_interested =  Input::get('pe_interested');
		$vc_interested =  Input::get('vc_interested');
		$re_interested =  Input::get('re_interested');

		$user = Auth::user();

		if(is_null($pe_interested) && is_null($vc_interested) && is_null($re_interested)){
			$user->skiped = 1;
		}

		if(!is_null($pe_interested)){
			
			$validator = User::validatePeInvestor(Input::all());

		    if ($validator->fails())
		    {
		    	return Redirect::route('register.investor', $type)->withErrors($validator)->withInput();
		    }

			$user->pe_interested = 1;
			$user->pe_geo_interests = Input::get('pe_geo_interests');
			$user->pe_sector_interests = Input::get('pe_sector_interests');
			$user->pe_investment_stage = Input::get('pe_investment_stage');
			$user->pe_investment_type = Input::get('pe_investment_type');
			$user->pe_investment_style = Input::get('pe_investment_style');
			$user->pe_deal_size = Input::get('pe_deal_size');

		}

		if(!is_null($vc_interested)){

			$validator = User::validateVcInvestor(Input::all());

		    if ($validator->fails())
		    {
		    	return Redirect::route('register.investor', $type)->withErrors($validator)->withInput();
		    }

			$user->vc_interested = 1;
			$user->vc_geo_interests = Input::get('vc_geo_interests');
			$user->vc_sector_interests = Input::get('vc_sector_interests');
			$user->vc_investment_stage = Input::get('vc_investment_stage');
			$user->vc_investment_type = Input::get('vc_investment_type');
			$user->vc_investment_style = Input::get('vc_investment_style');
			$user->vc_deal_size = Input::get('vc_deal_size');

		}

		if(!is_null($re_interested)){

			$validator = User::validateReInvestor(Input::all());

		    if ($validator->fails())
		    {
		    	return Redirect::route('register.investor', $type)->withErrors($validator)->withInput();
		    }

			$user->re_interested = 1;
			$user->re_geo_interests = Input::get('re_geo_interests');
			$user->re_sector_interests = Input::get('re_sector_interests');
			$user->re_investment_stage = Input::get('re_investment_stage');
			$user->re_investment_type = Input::get('re_investment_type');
			$user->re_investment_style = Input::get('re_investment_style');
			$user->re_deal_size = Input::get('re_deal_size');
		}

		if( $type == 'investor'){
			$user->rule_id = 3;
			$user->save();
			return Redirect::to('profile');
		}elseif( $type == 'both' ){
			$user->rule_id = 5;
			$user->save();
			return View::make('register.complete.lister')->with('type', 'both');
			//return View::make('register.complete.lister')->with('user', $user)->with('type', 'both');
		}
	}

	public function lister()
	{
		$type = Input::get('type');
		return View::make('register.complete.lister')->with('type', $type);
	}

	public function lister_post()
	{
		$user = Auth::user();
		
		if ( Input::get('type') == 'both' ){
			$user->rule_id = 5;
		}elseif( Input::get('type') == 'lister'){
			$user->rule_id = 4;
		}
		
		if( !is_null(Input::get('skiped')) ){
			$user->skiped = 1;
			$user->save();
			return Redirect::route('home');
		}else{
			$user->save();
			return Redirect::route('company.type');
		}
		
    }

    public function both()
	{
		$user = new User();
		if(Session::get('linkedin.email')){

			$user->firstname = Session::get('linkedin.firstname');
			$user->lastname = Session::get('linkedin.lastname');
			$user->email = Session::get('linkedin.email');
			$user->address = Session::get('linkedin.address');
			$user->country = Session::get('linkedin.country');
			$user->phone = Session::get('linkedin.phone');
		}
		$user->id = 0;
		//return Redirect::route('earlyaccess', array('type' => 'both'));
		return View::make('register.both')->with('user', $user)
										  ->with('type', 'both');
	}

	public function both_post()
	{

	    $validator = User::validateBoth(Input::all());

	    if ($validator->fails())
	    {
	    	return Redirect::route('register.both')->withErrors($validator)->withInput();
	    }
	
		$user = new User();
		$user->firstname = Input::get('firstname');
	    $user->lastname = Input::get('lastname');
	    $user->nickname = Input::get('nickname');
	    $user->email = Input::get('email');
	    $user->password = Hash::make(Input::get('password'));
	    $user->city = Input::get('city');
	    $user->country = Input::get('country');
	    $user->address = Input::get('address');
	    $user->phone = Input::get('phone');

	    $user->interests = Input::get('interests');
	    $user->geo_interests = Input::get('geo_interests');
		$user->sector_interests = Input::get('sector_interests');
		$user->investment_stage = Input::get('investment_stage');
		$user->investment_type = Input::get('investment_type');
		$user->deal_size = Input::get('deal_size');
		$user->investor_type = Input::get('investor_type');
	    $user->company_name = Input::get('company_name');
	    $user->status = Config::get('ilosool.default_user_status');
	    $user->subscribed = Input::get('subscribed') ? 1 : 0;
	    $user->rule_id = '5';
	    
		if(!Session::get('linkedin.email')){
	    	$user->generateConfirmationCode();
			$user->sendConfirmEmail($user);
			$page = Page::where('slug', 'register-success')->first();
	    }else{
	    	$user->confirmed = '1';
	    	$page = Page::where('slug', 'register-success-linkedin')->first();

	    	$data = array();
	    	Mail::send('emails.auth.register-success', $data, function($message) use ($user)
			{
				$message->from('info@ilosool.com', 'ilOsool');
			    $message->to($user->email, $user->firstname . ' ' . $user->lastname)->subject('Welcome to ilOsool!');
			});
	    }
	    
		$user->save();

		return View::make('register.register_success')->with('page', $page);
	}

	public function linkedinRegister($type){
		$user = new User();
		$user->firstname = Session::get('linkedin.firstname');
		$user->lastname = Session::get('linkedin.lastname');
		$user->email = Session::get('linkedin.email');
		$user->address = Session::get('linkedin.address');
		$user->country = Session::get('linkedin.country');
		$user->phone = Session::get('linkedin.phone');
		return View::make('register.register')->with('user', $user)->with('type', $type);
	}

	public function registerSuccess(){

		Auth::user()->sendConfirmEmail(Auth::user());
		$page = Page::where('slug', 'register-success')->first(); 
		return View::make('register.register_success')->with('page', $page);
	}

	public function registerConfirm(){
		$code = Input::get('code');
		$confirm = true;

		$user = User::where('email', '=', Input::get('email'))
					->where('confirmed', '=', Input::get('code'))
					->first();

		if($user){
			Auth::loginUsingId($user->id);

			if(Auth::check()) {
				if (Auth::user()->confirmed == '1'){
					if(getLocale() == 'ar'){
						$title = "حسابك مؤكد";
						$message = "حسابك مؤكد, بأمكانك البدء بإستخدام الأصول.";
					}else{
						$title = "You account already confirmed";
						$message = "Your account is already confirmed, You can start using ilOsool system.";
					}
				}else {
					if ($code == Auth::user()->confirmed) {
						Auth::user()->confirmed = '1';
						Auth::user()->status = 'REGISTERED';
						Auth::user()->save();
						if(getLocale() == 'ar'){
							$title = "تم تأكيد حسابك بنجاح";
							$message = "تم تأكيد حسابك بنجاح, بأمكانك البدء بإستخدام الأصول";
						}else{
							$title = "Your account has been confirmed successfully";
							$message = "Your account has been confirmed successfully, You can start using ilOsool system.";
						}
						
						$folders = Config::get('ilosool.folders');
					    foreach ( $folders as $value) {
					    	$folder = new Folder();
					    	$folder->user_id = Auth::user()->id;
					    	$folder->name = $value;
					    	$folder->default = 1;
					    	$folder->save();
					    }

					    $data = array();
				    	Mail::send('emails.auth.register-success', $data, function($message) use ($user)
						{
							$message->from('info@ilosool.com', 'ilOsool');
						    $message->to($user->email, $user->firstname . ' ' . $user->lastname)->subject('Your email has been confirmed');
						});
					}
					else{

						if(getLocale() == 'ar'){
							$title = "رمز التأكيد غير صحيح";
							$message = "لا يزال حسابك غير مؤكد, اذا لم تستلم بريد الكتروني اضغط على الزر التالي لإعادة ارسال الرمز مرة أخرى";
						}else{
							$title = "Invalid confirmation code";
							$message = "Your account is still not confirmed, if you don't recieved any confirmation Email click on the button bellow to resend the confiramtion code.";	
						}
						
						$confirm = false;
					}
				}
			}
			else {
				return Redirect::to('login');
			}
		}else{
			if(getLocale() == 'ar'){
				$title = "رمز التأكيد غير صحيح";
				$message = "لا يزال حسابك غير مؤكد, اذا لم تستلم بريد الكتروني اضغط على الزر التالي لإعادة ارسال الرمز مرة أخرى";
			}else{
				$title = "Invalid confirmation code";
				$message = "Your account is still not confirmed, if you don't recieved any confirmation Email click on the button bellow to resend the confiramtion code.";	
			}
			$confirm = false;
		}
		
		return View::make('register.confirm')->with('title', $title)->with('message', $message)->with('confirm', $confirm)->with('email', Input::get('email'));
	}

	public function resendCode() {

		$email = Input::get('email');
		
		$user = User::where('email', '=', $email)
					->first();

		$code = $user->confirmed;

		Mail::send('emails.auth.confirm', array('code' => $code, 'email' => $email), function($message) use ($user)
        {
            $message->from('info@ilosool.com', 'ilOsool');
            $message->to($user->email, $user->firstname . ' ' . $user->lastname)->subject('ilOsool confirmation code');
        });

		if(getLocale() == 'ar'){
			$title = "رمز التأكيد غير صحيح";
			$message = "تحقق من بريدك الالكتروني  لرمز التأكيد";
		}else{
			$message = "Check your email for confiramtion code";
		}
		
		return View::make('common.popup_alert')->with('message', $message);
	}

	public function registerUserType() {
		return View::make('register.complete.user_type');
	}

	public function require_register_popup(){
		$msg = 'You have to register in order to view this deal';
   		return View::make('common.popup_alert_register')->with('message', $msg);
	}

}