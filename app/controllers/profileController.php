<?php

class ProfileController extends BaseController {

	public function home()
	{

		//Inputs
		$asset_class = Input::get('asset_class');
		$geo_interests = Input::get('geo_interests');
		$pe_sector_interests = Input::get('pe_sector_interests');
		$re_sector_interests = Input::get('re_sector_interests');
		$vc_sector_interests = Input::get('vc_sector_interests');
		$pe_deal_size = Input::get('pe_deal_size');
		$re_deal_size = Input::get('re_deal_size');
		$vc_deal_size = Input::get('vc_deal_size');

		$timer = Input::get('timer');

		$user = Auth::user();

		if($user->skiped == 0 || $user->rule_id != 4){
			if( is_null($user->pe_interested) && is_null($user->re_interested) && is_null($user->vc_interested) ){
				$q = Company::select(array('*'));
				$byScore = false;

			}else{
				// $ifStatment = "";

				// //Use PE Intrested
				// if(!is_null($user->pe_interested) && $user->pe_interested != 0 ){
					
				// 	$numItemsPE = count($user->pe_geo_interests);
				// 	$i = 0;

				// 	foreach ($user->pe_geo_interests as $geo) {
				// 		$ifStatment .= ' IF(geo_interests like "%' .  $geo .'%", 1, 0) + ';
				// 	}
					
				// 	$ifStatment .= ' 4 * (';

				// 	foreach ($user->pe_geo_interests as $geo) {
				// 		if(++$i === $numItemsPE) {
				// 			$ifStatment .= 'geo_interests like "%'. $geo .'%" ' ;
				// 		}else{
				// 			$ifStatment .= 'geo_interests like "%'. $geo .'%" OR ' ;
				// 		}
				// 	}
				// 	$ifStatment .= ')';
				// 	$ifStatment .= ' + IF(type = "pe", 20, 0) + IF(sector IN ("' . arrayToSqlString($user->pe_sector_interests) . '"), 3, 0) +
				// 	IF(investment_stage IN ("' . arrayToSqlString($user->pe_investment_stage) . '"), 3, 0) +
				// 	IF(deal_size IN ("' . arrayToSqlString($user->pe_deal_size) . '"), 3, 0)';
				// }

				// //Use RE Intrested
				// if(!is_null($user->re_interested) && $user->re_interested != 0){

				// 	$numItemsRE = count($user->re_geo_interests);
				// 	$i = 0;

				// 	foreach ($user->re_geo_interests as $geo) {
				// 		$ifStatment .= ' + IF(geo_interests like "%' . $geo .'%", 1, 0) + ';
				// 	}

				// 	$ifStatment .= ' + 4 * (';

				// 	foreach ($user->re_geo_interests as $geo) {
				// 		if(++$i === $numItemsRE) {
				// 			$ifStatment .= 'geo_interests like "%'. $geo .'%" ' ;
				// 		}else{
				// 			$ifStatment .= 'geo_interests like "%'. $geo .'%" OR ' ;
				// 		}
				// 	}
				// 	$ifStatment .= ')';
				// 	$ifStatment .= ' + IF(type = "re", 20, 0) + IF(sector IN ("' . arrayToSqlString($user->re_sector_interests) . '"), 3, 0) +
				// 	IF(investment_stage IN ("' . arrayToSqlString($user->re_investment_stage) . '"), 3, 0) +
				// 	IF(deal_size IN ("' . arrayToSqlString($user->re_deal_size) . '"), 3, 0)';

				// }

				// //Use VC Intrested
				// if(!is_null($user->vc_interested) && $user->vc_interested != 0){
				// 	$numItemsVC = count($user->vc_geo_interests);
				// 	$i = 0;

				// 	foreach ($user->vc_geo_interests as $geo) {
				// 		$ifStatment .= ' + IF(geo_interests like "%' . $geo .'%", 1, 0) +';
				// 	}

				// 	$ifStatment .= ' + 4 * (';

				// 	foreach ($user->vc_geo_interests as $geo) {
				// 		if(++$i === $numItemsVC) {
				// 			$ifStatment .= 'geo_interests like "%'. $geo .'%" ' ;
				// 		}else{
				// 			$ifStatment .= 'geo_interests like "%'. $geo .'%" OR ' ;
				// 		}
				// 	}
				// 	$ifStatment .= ')';
				// 	$ifStatment .= ($ifStatment == "" ? $ifStatment : ' + ');
				// 	$ifStatment .= ' + IF(type = "vc", 20, 0) + IF(sector IN ("' . arrayToSqlString($user->vc_sector_interests) . '"), 3, 0) +
				// 	IF(investment_stage IN ("' . arrayToSqlString($user->vc_investment_stage) . '"), 3, 0) +
				// 	IF(deal_size IN ("' . arrayToSqlString($user->vc_deal_size) . '"), 3, 0)';
				// }
			
				// $ifStatment .= ' AS score';
				
				// $q = Company::select(DB::raw('*,'. $ifStatment));
				// $byScore = true;

				$byScore = false;
				$q = Company::select(array('*'));
			}

		}else{
			$byScore = false;
			$q = Company::select(array('*'));
		}

		if($asset_class == 'pe'){
			$q->where('type', '=', 'pe');
		}elseif($asset_class == 'vc'){
			$q->where('type', '=', 'vc');
		}elseif($asset_class == 're'){
			$q->where('type', '=', 're');
		}
		
		/********************************************************************************************/
		/***** 									Filter 											*****/
		/********************************************************************************************/
		if(Input::get('search_investments')){
        	$q = $q ->where(function($q){
        			$q 	->orWhere('name','LIKE', '%' . Input::get('search_investments') . '%')
        				->orWhere('name_arabic','LIKE','%' . Input::get('search_investments') . '%')
        				->orWhere('deal_name','LIKE','%' . Input::get('search_investments') . '%')
				    	->orWhere('country','LIKE','%' . Input::get('search_investments') . '%')
				    	->orWhere('city','LIKE','%' . Input::get('search_investments') . '%')
				    	->orWhere('description','LIKE','%' . Input::get('search_investments') . '%')
				    	->orWhere('brief','LIKE','%' . Input::get('search_investments') . '%');
        	});
        }

        //Geo Interest
        if($geo_interests){
         	$q = $q ->where(function($q) use ($geo_interests){
    			foreach($geo_interests as $geo){
    				$q->orWhere('geo_interests','LIKE', '%' . $geo . '%');
    			}
    		});
    	}

    	//PE Sector Interest
		if($pe_sector_interests){
			$q = $q ->where(function($q) use ($pe_sector_interests){
    			foreach($pe_sector_interests as $sector){
    				$q->orWhere('sector','LIKE','%' . $sector . '%');
    			}
    		});
		}

		//PE Deal Size
		if($pe_deal_size){
			$q = $q ->where(function($q) use ($pe_deal_size){
    			foreach($pe_deal_size as $deal){
    				$q->orWhere('deal_size','LIKE','%' . $deal . '%');
    			}
    		});
		}

		//VC Sector Interest
		if($vc_sector_interests){
			$q = $q ->where(function($q) use ($vc_sector_interests){
    			foreach($vc_sector_interests as $sector){
    				$q->orWhere('sector','LIKE','%' . $sector . '%');
    			}
    		});
		}

		//VC Deal Size
		if($vc_deal_size){
			$q = $q ->where(function($q) use ($vc_deal_size){
    			foreach($vc_deal_size as $deal){
    				$q->orWhere('deal_size','LIKE','%' . $deal . '%');
    			}
    		});
		}

		//RE Sector Interest
		if($re_sector_interests){
			$q = $q ->where(function($q) use ($re_sector_interests){
    			foreach($re_sector_interests as $sector){
    				$q->orWhere('sector','LIKE','%' . $sector . '%');
    			}
    		});
		}

		//RE Deal Size
		if($re_deal_size){
			$q = $q ->where(function($q) use ($re_deal_size){
    			foreach($re_deal_size as $deal){
    				$q->orWhere('deal_size','LIKE','%' . $deal . '%');
    			}
    		});
		}

		/***** Timer ******/
		if($timer == 'open' || $timer == 'closed' || $timer == 'negotiation'){
			$q->where('listing_status','=', $timer);
        }

		// $date = date('Y-m-d');
		// if($timer){
		// 	switch($timer){
		// 		case 'finished':
		// 			$q->where('enddate','<', $date);
		// 			break;
		// 		case 'investable':
		// 			$q->where('enddate','>=', $date);
		// 			break;
		// 		case 'soon':
		// 			$oneWeek = date('Y-m-d', strtotime("+1 week"));
		// 			$q->where('enddate' , '<=', $oneWeek)
		// 				->where('enddate' , '>', $date);
		// 			break;
		// 		case 'featured':
		// 			$q->where('featured','=', 1);
		// 			break;
		// 	}
  //       }

        /********************************************************************************************/
		/***** 								END	FILTER 											*****/
		/********************************************************************************************/

		//Deals must be approved and published.
		$q->where('approved', '=', 1)->where('status', '=', 'published');

		if($byScore){
			//$q->orderBy('score', 'desc');
			$q->orderBy(DB::raw('RAND()'));
		}else{
			//$q->orderBy('id', 'desc');
			//$q->orderBy(DB::raw('RAND()'));
			$q->orderBy('created_at', 'desc');

		}
		
		$companies = $q->paginate(12);
		//return DB::getQueryLog();

        return View::make('profile.common.home')->with('companies', $companies)
    											   ->with('asset_class', $asset_class)
    											   ->with('geo_interests', $geo_interests)
    											   ->with('pe_sector_interests', $pe_sector_interests)
    											   ->with('re_sector_interests', $re_sector_interests)
    											   ->with('vc_sector_interests', $vc_sector_interests)
    											   ->with('topmenu', 'home');
	}

	public function index()
	{
		$id = Auth::user()->id;
		$user = User::find($id);

        return View::make('profile.info')->with('user', $user)
        								 ->with('topmenu', 'profile')
        								 ->with('sidemenu', 'info');
	}

	public function view($id)
	{
		$user = User::find($id);
		$companies = Company::where('user_id', '=', $id)->paginate(9);
		$requests = RequestDeal::where('user_id', '=', $id)->paginate(9);

        return View::make('profile.view')->with('user', $user)
        								 ->with('companies', $companies)
        								 ->with('requests', $requests)
        								 ->with('topmenu', 'profile')
        								 ->with('sidemenu', 'info');
	}	

	public function contact()
	{
		$id = Auth::user()->id;
		$user = User::find($id);

        return View::make('profile.contact')->with('user', $user)
        									->with('topmenu', 'profile')
        								 	->with('sidemenu', 'contact');
	}

	public function investment()
	{
		if(Auth::user()->rule_id != 4){
			$id = Auth::user()->id;
			$user = User::find($id);

	        return View::make('profile.investment')->with('user', $user)
	        									   ->with('topmenu', 'profile')
	        								 	   ->with('sidemenu', 'investment');
	    }else{
	    	return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
	    }
	}

	public function files()
	{
		$id = Auth::user()->id;
		$groups = User::getUserAttachments($id);
        return View::make('profile.files')->with('groups', $groups)
        								  ->with('topmenu', 'profile')
        								  ->with('sidemenu', 'files');
	}

	public function orders()
	{
		$id = Auth::user()->id;

		$status = Input::get('status');
		if($status && $status != 'all'){
			$investments = User::getUserInvestmentsStatus($id, $status);
		}else{
			$investments = User::getUserInvestments($id);
		}

        return View::make('profile.orders')->with('investments', $investments)
        								   ->with('topmenu', 'profile')
        								   ->with('sidemenu', 'orders');
	}

	public function wishlist()
	{
		$id = Auth::user()->id;
		$wishlist = User::getUserWishlist($id);

        return View::make('profile.wishlist')->with('wishlist', $wishlist)
        									->with('topmenu', 'profile')
        								   ->with('sidemenu', 'wishlist');
	}

	public function bookmarks()
	{

		$search = Input::get('search');
		$folder_select = Input::get('folder');
		
		$folders = User::getUserFolders(Auth::user()->id);

		if(isset($folder_select) && $folder_select != 'all'){
			$folder = Folder::where('id', '=', $folder_select)
			 				->where('user_id', '=', Auth::user()->id)
			 				->first();
			if($folder){
				if($search){
					$bookmarks = $folder->getbookmarks($folder->id, $search);
				}else{
					$bookmarks = $folder->getbookmarks($folder->id);
				}
			}else{
				return Redirect::route('profile.bookmarks');
			}
		}else{

			if($search){
				$bookmarks = Company::select('companies.*')->leftJoin('bookmarks', 'companies.id', '=', 'bookmarks.company_id')
									->where('bookmarks.user_id', '=', Auth::user()->id)
									->where('name','LIKE', '%' . $search . '%')
									->where('approved','=',	1)
									->paginate(Config::get('ilosool.rows_default'));
			}else{
				$bookmarks = Company::select('companies.*')->leftJoin('bookmarks', 'companies.id', '=', 'bookmarks.company_id')
									->where('bookmarks.user_id', '=', Auth::user()->id)
									->where('approved','=',	1)
									->paginate(Config::get('ilosool.rows_default'));
			}
		}

        return View::make('profile.bookmarks')->with('bookmarks', $bookmarks)
        										->with('folders', $folders)
        										->with('topmenu', 'bookamrks')
        										->with('sidemenu', 'bookmarks');
	}


	public function companies()
	{
		$id = Auth::user()->id;
		$companies = User::getUserCompanies($id);

        return View::make('profile.companies')->with('companies', $companies)
        									  ->with('topmenu', 'companies')
        								 	  ->with('sidemenu', 'companies');
	}

	public function requests()
	{
		$id = Auth::user()->id;
		$requests = User::getUserRequests($id);

        return View::make('profile.myrequests')->with('requests', $requests)
        									  ->with('topmenu', 'myrequests')
        								 	  ->with('sidemenu', 'requests');
	}

	public function notifications()
	{
		$notifications = Notification::where('user_id', '=', Auth::user()->id)
										->orderBy('created_at', 'desc')
										->paginate(Config::get('ilosool.rows_default'));

		return View::make('profile.notifications')->with('notifications', $notifications)
												  ->with('topmenu', 'profile')
        								 	      ->with('sidemenu', 'notifications');
	}

	public function notificationsSwitch(){

		Notification::where('user_id', '=', Auth::user()->id)
										->where('viewed', '=', 0)
										->update(array('viewed' => 1));

		return Response::json(array('status' => 1));
	}

	

	public function investors($company_id)
	{
		$status = Input::get('status');

		$company = Company::find($company_id);

		if($status && $status != 'all'){
			$investments = Investment::with('company')
				->where('investments.company_id', '=', $company_id)
				->where('status', '=', $status)
				->paginate(Config::get('ilosool.rows_default'));
		}else{
			$investments = Investment::with('company')
				->where('investments.company_id', '=', $company_id)
				->paginate(Config::get('ilosool.rows_default'));
		}

		return View::make('profile.investors')->with('investments', $investments)->with('company', $company);
	}

	public function investmentChangeStatus($id, $status){
		
		$investment = Investment::find($id);
		$investment->status = $status;
		$company_id = $investment->company_id;
		$investment->save();

		return Redirect::route('profile.investors', $company_id);
	}

	public function accept_investment($messageId){

		$msg = Message::find($messageId);
		$user = User::find($msg->sender_id);

		$invest = Investment::where('id', '=', $msg->investment_id)->first();
		$invest->status = 'accepted';
		$invest->save();

		$message = "Investment has been accepted from the user <strong>" . $user->firstname . ' ' . $user->lastname . '</strong>';
		return View::make('common.popup_alert')->with('message', $message);
	}

	public function reject_investment($messageId){

		$msg = Message::find($messageId);
		$user = User::find($msg->sender_id);

		$invest = Investment::where('id', '=', $msg->investment_id)->first();
		$invest->status = 'rejected';
		$invest->save();

		$message = "Investment has been rejected from the user <strong>" . $user->firstname . ' ' . $user->lastname . '</strong>';
		return View::make('common.popup_alert')->with('message', $message);
	}

	public function edit_info(){
		return View::make('profile.form.info')->with('user', Auth::user())
											  ->with('topmenu', 'profile')
        								      ->with('sidemenu', 'info');
	}

	public function edit_info_post(){

		if(Auth::user()->user_type == "agent"){
			$validator = User::validateEditUserProfileAgent(Input::all(), Auth::user());
		}else{
			$validator = User::validateEditUserProfile(Input::all(), Auth::user());
		}
		
		if ($validator->fails()){
			return Redirect::route('profile.info.edit')->withErrors($validator)->withInput();
		}

		Auth::user()->firstname = Input::get('firstname');
		Auth::user()->lastname = Input::get('lastname');
		Auth::user()->brief = Input::get('brief');

		Auth::user()->rbc = Input::get('rbc');
		Auth::user()->rsc = Input::get('rsc');

		Auth::user()->city = Input::get('city');
		Auth::user()->country = Input::get('country');
		Auth::user()->address = Input::get('address');
		Auth::user()->phone = Input::get('phone');

		Auth::user()->hidden_name = Input::get('hidden_name') ? 1 : 0;
		Auth::user()->hidden_contact_info = Input::get('hidden_contact_info') ? 1 : 0;
		Auth::user()->subscribed = Input::get('subscribed') ? 1 : 0;
		
		$res = Auth::user()->save();

		if($res){
			$file = Input::file('image');

			if($file){
                Auth::user()->image = upload($file, User::getDir());
            }

			$file = Input::file('cover');
		    if($file){
                Auth::user()->cover = upload($file, User::getDir());
            }

            Auth::user()->save();

			$message = trans('profile.profile_info.edit_succsess');
		}else{
			$message = trans('profile.profile_info.edit_unsuccsess');
		}

		return Redirect::route('profile')
			->with('action', 'edit')
			->with('result', $res)
			->with('message', $message);
	}

	public function edit_password(){
		return View::make('profile.form.password')->with('user', Auth::user())
												 ->with('topmenu', 'profile')
        								         ->with('sidemenu', 'info');
	}

	public function edit_password_post(){

		$validator = User::validetUserPassword(Input::all());

		if ($validator->fails()){
			return Redirect::route('profile.password.edit')->withErrors($validator)->withInput();
		}

		$password = Input::get('password');
		
		if(!empty($password)) {
			Auth::user()->password = Hash::make(Input::get('password'));
		}

		$res = Auth::user()->save();

		if($res){
			$message = trans('profile.profile_info.edit_succsess');
		}else{
			$message = trans('profile.profile_info.edit_unsuccsess');
		}

		return Redirect::route('profile')
			->with('action', 'edit')
			->with('result', $res)
			->with('message', $message);
	}

	public function edit_contact(){
		return View::make('profile.form.contact')->with('user', Auth::user())
												 ->with('topmenu', 'profile')
        								         ->with('sidemenu', 'contact');
	}

	public function edit_contact_post(){
		
		$validator = User::validateEditProfileContact(Input::all());

		if ($validator->fails()){
			return Redirect::route('profile.contact.edit')->withErrors($validator)->withInput();
		}

		Auth::user()->city = Input::get('city');
		Auth::user()->country = Input::get('country');
		Auth::user()->address = Input::get('address');
		Auth::user()->phone = Input::get('phone');

		$res = Auth::user()->save();

		if($res){
			$message = trans('profile.profile_info.edit_succsess');
		}else{
			$message = trans('profile.profile_info.edit_unsuccsess');
		}
		
		return Redirect::route('profile.contact')
			->with('action', 'edit')
			->with('result', $res)
			->with('message', $message);
	}

	public function edit_pe_investment_post(){
		if(Auth::user()->rule_id != 4){
			if(!is_null(Input::get('pe_interested'))){
				Auth::user()->pe_interested = 1;
				
				$validator = User::validateEditPeInvestment(Input::all());

				if ($validator->fails()){
					return Redirect::route('profile.investment.pe')->withErrors($validator)->withInput();
				}

				Auth::user()->pe_geo_interests = Input::get('pe_geo_interests');
				Auth::user()->pe_sector_interests = Input::get('pe_sector_interests');
				Auth::user()->pe_investment_stage = Input::get('pe_investment_stage');
				Auth::user()->pe_investment_type = Input::get('pe_investment_type');
				Auth::user()->pe_investment_style = Input::get('pe_investment_style');
				Auth::user()->pe_deal_size = Input::get('pe_deal_size');
			}else{
				Auth::user()->pe_interested = null;
				Auth::user()->pe_geo_interests = null;
				Auth::user()->pe_sector_interests = null;
				Auth::user()->pe_investment_stage = null;
				Auth::user()->pe_investment_type = null;
				Auth::user()->pe_investment_style = null;
				Auth::user()->pe_deal_size = null;
			}

			$res = Auth::user()->save();

			if($res){
				$message = trans('profile.profile_info.edit_succsess');
		}else{
				$message = trans('profile.profile_info.edit_unsuccsess');
			}
			
			return Redirect::route('profile.investment')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function edit_vc_investment_post(){
		
		if(Auth::user()->rule_id != 4){
			if(!is_null(Input::get('vc_interested'))){
				Auth::user()->vc_interested = 1;

				$validator = User::validateEditVcInvestment(Input::all());

				if ($validator->fails()){
					return Redirect::route('profile.investment.vc')->withErrors($validator)->withInput();
				}

				Auth::user()->vc_geo_interests = Input::get('vc_geo_interests');
				Auth::user()->vc_sector_interests = Input::get('vc_sector_interests');
				Auth::user()->vc_investment_stage = Input::get('vc_investment_stage');
				Auth::user()->vc_investment_type = Input::get('vc_investment_type');
				Auth::user()->vc_investment_style = Input::get('vc_investment_style');
				Auth::user()->vc_deal_size = Input::get('vc_deal_size');
			}else{
				Auth::user()->vc_interested = null;
				Auth::user()->vc_geo_interests = null;
				Auth::user()->vc_sector_interests = null;
				Auth::user()->vc_investment_stage = null;
				Auth::user()->vc_investment_type = null;
				Auth::user()->vc_investment_style = null;
				Auth::user()->vc_deal_size = null;
			}

			$res = Auth::user()->save();

			if($res){
				$message = trans('profile.profile_info.edit_succsess');
			}else{
				$message = trans('profile.profile_info.edit_unsuccsess');
			}
			
			return Redirect::route('profile.investment')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function edit_re_investment_post(){
		if(Auth::user()->rule_id != 4){
			if(!is_null(Input::get('re_interested'))){
				Auth::user()->re_interested = 1;
			
				$validator = User::validateEditReInvestment(Input::all());

				if ($validator->fails()){
					return Redirect::route('profile.investment.re')->withErrors($validator)->withInput();
				}

				Auth::user()->re_geo_interests = Input::get('re_geo_interests');
				Auth::user()->re_sector_interests = Input::get('re_sector_interests');
				Auth::user()->re_investment_stage = Input::get('re_investment_stage');
				Auth::user()->re_investment_type = Input::get('re_investment_type');
				Auth::user()->re_investment_style = Input::get('re_investment_style');
				Auth::user()->re_deal_size = Input::get('re_deal_size');
			}else{
				Auth::user()->re_interested = null;
				Auth::user()->re_geo_interests = null;
				Auth::user()->re_sector_interests = null;
				Auth::user()->re_investment_stage = null;
				Auth::user()->re_investment_type = null;
				Auth::user()->re_investment_style = null;
				Auth::user()->re_deal_size = null;
			}

			$res = Auth::user()->save();

			if($res){
				$message = trans('profile.profile_info.edit_succsess');
			}else{
				$message = trans('profile.profile_info.edit_unsuccsess');
			}
			
			return Redirect::route('profile.investment')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function investment_pe(){
		if(Auth::user()->rule_id != 4){
			return View::make('profile.pe_investment')->with('user', Auth::user())
													  ->with('topmenu', 'profile')
													  ->with('sidemenu', 'investment')
													  ->with('submenu', 'investment-pe');
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function investment_vc(){
		if(Auth::user()->rule_id != 4){
			return View::make('profile.vc_investment')->with('user', Auth::user())
													  ->with('topmenu', 'profile')
													  ->with('sidemenu', 'investment')
													  ->with('submenu', 'investment-vc');
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function investment_re(){
		if(Auth::user()->rule_id != 4){
			return View::make('profile.re_investment')->with('user', Auth::user())
													  ->with('topmenu', 'profile')
													  ->with('sidemenu', 'investment')
													  ->with('submenu', 'investment-re');
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function edit(){
		$key = Input::get('key');
		$val = Input::get('val');
		$user = Auth::user();

		switch ($key)
		{
		case "firstname":
		  $user->firstname = $val;
		  $user->save();
		  break;
		case "lastname":
		  $user->lastname = $val;
		  $user->save();
		  break;
		case "nickname":
		  $user->nickname = $val;
		  $user->save();
		  break;
		case "birth":
		  $user->birth = $val;
		  $user->save();
		  break;
		case "city":
		  $user->city = $val;
		  $user->save();
		  break;
		case "country":
		  $user->country = $val;
		  $user->save();
		  break;
		case "address":
		  $user->address = $val;
		  $user->save();
		  break;
		case "phone":
		  $user->phone = $val;
		  $user->save();
		  break;
		case "interests":
		  $user->interests = $val;
		  $user->save();
		  break;
		case "geo_interests":
		  $user->geo_interests = $val;
		  $user->save();
		  break;
		case "sector_interests":
		  $user->sector_interests = $val;
		  $user->save();
		  break;
		case "investment_stage":
		  $user->investment_stage = $val;
		  $user->save();
		  break;
		case "investment_type":
		  $user->investment_type = $val;
		  $user->save();
		  break;
		case "deal_size":
		  $user->deal_size = $val;
		  $user->save();
		  break;
		case "investor_type":
		  $user->investor_type = $val;
		  $user->save();
		  break;
		case "company_name":
		  $user->company_name = $val;
		  $user->save();
		  break;
		default:
		  return false;
		}
	}

	public function delete($id){

		$company = Company::find($id);
		$res = $company->delete();

		if($res){
			$message = sprintf(trans('general.messages.deal_deleted'), $company->name);
		}else{
			$message = sprintf(trans('general.messages.deal_not_deleted'), $company->name);
		}

		return Redirect::route('profile.companies')
				->with('action', 'delete')
				->with('result', $res)
				->with('message', $message);
	}

   	/*
	** Confirm that user want the private information from a company 
   	*/
   	public function requestConfirm($companyId, $senderId){
   		
   		$company = Company::find($companyId);
   		$sender = User::find($senderId);

   		//Check if there is a record for the request
   		$exist = CompanyPermissions::where('user_id', '=', $senderId)->where('company_id', '=', $companyId)->first();
   		if($exist){
   			$messageInfo = trans('general.messages.have_requested');
   		}else{
   			$per = new CompanyPermissions();
   			$per->user_id = $senderId;
   			$per->company_id = $companyId;
   			$per->status = 'pending';
   			$per->description = Input::get('description');
   			$per->save();

   			$messageInfo = trans('general.messages.request_success');

   			//Add Job 
   			$sender = User::find($senderId);

   			if($sender->user_tye == strtolower(Config::get('ilosool.user_type.agent')) || $sender->user_type == strtolower(Config::get('ilosool.user_type.company'))){
   				$title = sprintf(Config::get('ilosool.titles.request_private_info'), $sender->company_name, $company->deal_name);
   				$title_arabic = sprintf(Config::get('ilosool.titles_arabic.request_private_info'), $sender->company_name, $company->deal_name);
   			}else{
   				if($sender->nickname){
   					$title = sprintf(Config::get('ilosool.titles.request_private_info'), $sender->nickname , $company->deal_name);
   					$title_arabic = sprintf(Config::get('ilosool.titles_arabic.request_private_info'), $sender->nickname , $company->deal_name);
   				}else{
   					$title = sprintf(Config::get('ilosool.titles.request_private_info'), $sender->firstname , $company->deal_name);
   					$title_arabic = sprintf(Config::get('ilosool.titles_arabic.request_private_info'), $sender->firstname , $company->deal_name);
   				}
   			}

        	$message = Input::get('description') ? Input::get('description') : '';
        	$message_arabic = Input::get('description') ? Input::get('description') : '';
        	$type = 'request_info';
        	$actionJob = 'notification+email';
        	$url = URL::route('company.requests', $company->id);
			Job::add($company->user_id, $actionJob, $type, $message, $url, $title, $title_arabic, $message_arabic);

        	return json_encode(array('message' => (string )View::make('common.popup_alert')->with('message', $message), 'refresh' => true));
   			
   		}
   		
   		return json_encode(array('message' => (string )View::make('common.popup_alert')->with('message', $messageInfo), 'refresh' => true));
   	}

   	public function requestInfo($id){

   		if(Auth::check()){
   			$exist = CompanyPermissions::where('user_id', '=', Auth::user()->id)->where('company_id', '=', $id)->first();
   			if($exist){
   				$message = trans('general.messages.have_requested');
   				return View::make('common.popup_alert')->with('company', $company);
   			}else{
   				$company = Company::find($id);
	   			return View::make('company.request_popup')->with('company', $company);
   			}
	   		
   		}{
   			(getLocale() == 'ar') ? $action = 'طلب معلومات من هذه الصفقة' : $action = 'request information from this deal.';
   			$msg = sprintf(trans('general.messages.register_required'), $action);
   			return View::make('common.popup_alert_login')->with('message', $msg);
   		}
   	}

   	public function grant_access($reqId, $action){

		$req = CompanyPermissions::find($reqId);
		$req->status = $action;
		if($action == 'accepted'){
			$messageInfo = sprintf(trans('general.messages.access_accepted'), $req->user->getPublicName());

			$title = sprintf(Config::get('ilosool.titles.access_accepted'), $req->company->deal_name);
			$message = sprintf(Config::get('ilosool.messages.access_accepted'), $req->company->deal_name);
			$title_arabic = sprintf(Config::get('ilosool.titles_arabic.access_accepted'), $req->company->deal_name);
			$message_arabic = sprintf(Config::get('ilosool.messages_arabic.access_accepted'), $req->company->deal_name);
		}
		if($action == 'rejected'){
			$messageInfo = sprintf(trans('general.messages.access_rejected'), $req->user->getPublicName());

			$title = sprintf(Config::get('ilosool.titles_arabic.access_rejected'), $req->company->deal_name);
			$message = sprintf(Config::get('ilosool.titles_arabic.access_rejected'), $req->company->deal_name);
			$title_arabic = sprintf(Config::get('ilosool.titles_arabic.access_rejected'), $req->company->deal_name);
			$message_arabic = sprintf(Config::get('ilosool.messages_arabic.access_rejected'), $req->company->deal_name);
		}
		$req->save();

		
    	$type = 'request_info';
    	$actionJob = 'notification+email';
    	$url = URL::route('company.view',  $req->company_id);

		Job::add($req->user->id, $actionJob, $type, $message, $url, $title, $title_arabic, $message_arabic);
		
		return View::make('common.popup_alert')->with('message', $messageInfo);
	}

	public function folder_action($action, $folderId){
		
		if($action == 'add'){
			
			$folder = new Folder();
			$folder->id = 0;
			return View::make('profile.form.folder_popup')->with('folder', $folder);

		}elseif($action == 'edit'){
			
			$folder = Folder::find($folderId);
			return View::make('profile.form.folder_popup')->with('folder', $folder);

		}elseif($action == 'delete'){
			$folder = Folder::find($folderId);
			return View::make('profile.form.delete_confirm_popup')->with('folder', $folder);
		}
	}

	public function folder_action_post($action, $folderId){

		if($action == 'add'){
			$folder = new Folder();
			$folder->user_id = Auth::user()->id;
			$folder->name = Input::get('name');
			$folder->default = 0;
			$res = $folder->save();

			if($res){
				$message = sprintf(trans('general.messages.folder_added'), Input::get('name'));
			}else{
				$message = sprintf(trans('general.messages.folder_not_added'), Input::get('name'));
			}

		}elseif($action == 'edit'){

			$folder = Folder::find($folderId);
			$folder->name = Input::get('name');
			$res = $folder->save();

			if($res){
				$message = sprintf(trans('general.messages.folder_edited'), Input::get('name'));
			}else{
				$message = sprintf(trans('general.messages.folder_not_edited'), Input::get('name'));
			}
		}

		return json_encode(array('message' => (string)View::make('common.popup_alert')->with('message', $message), 'refresh' => true));
	}

	public function folder_delete($folderId){
		
		$folder = Folder::find($folderId);
		$uncategorizedFolder = Folder::where('user_id', '=', Auth::user()->id)
										->where('name', '=', 'uncategorized')
										->first();

		$bookmarks = Bookmark::where('folder_id', '=', $folder->id)->get();

		if($bookmarks){
			foreach ($bookmarks as $bookmark) {
				$bookmark->folder_id = $uncategorizedFolder->id;
				$bookmark->save();
			}
		}
		
		$res = $folder->delete();

		if($res){
			$message = sprintf(trans('general.messages.folder_deleted'), $folder->name);
		}else{
			$message = sprintf(trans('general.messages.folder_not_deleted'), $folder->name);
		}

		return View::make('common.popup_alert')->with('message', $message);
	}

	public function notification_view($id){

		$notification = Notification::find($id);
		$notification->viewed = true;
		$notification->save();
		
		return View::make('common.popup_alert')->with('message', getLocale() == 'ar' ? ($notification->message_arabic ? $notification->message_arabic : $notification->message) : $notification->message);
	}
}