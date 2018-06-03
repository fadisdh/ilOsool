<?php

class AdminUserController extends BaseController {

    public function index()
    {

    	$rule = Input::get('rule');
        $col = Input::get('col');
        $rows = Input::get('rows');
        $subscribed = Input::get('subscribed');
        $confirmed = Input::get('confirmed');

        $q = User::select(array('*'));

        if(Input::get('search')){
        	$q = $q ->where(function($q){
        		$q	->orWhere('firstname','LIKE', '%' . Input::get('search') . '%')
        			->orWhere('lastname','LIKE','%' . Input::get('search') . '%')
        			->orWhere('id','=', Input::get('search'))
        			->orWhere('nickname','LIKE','%' . Input::get('search') . '%')
        			->orWhere('email','LIKE','%' . Input::get('search') . '%');
        	});
        }

        if($rule){
        	$q = $q ->where('rule_id', '=', $rule);
        }

        if($subscribed == "true"){
        	$q = $q ->where('subscribed', '=', 1);
        }elseif($subscribed == "false"){
        	$q = $q ->where('subscribed', '=', 0);
        }

        if($confirmed == 'true'){
        	$q = $q ->where('confirmed', '=', '1');
        }elseif($confirmed == 'false'){
        	$q = $q ->where('confirmed', '<>', '1');
        }
        
        

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
        	$users = $q->paginate($rows);
        }else{
        	$users = $q->paginate(Config::get('ilosool.rows_default'));
        }

        $rules = Rule::all();
        
        // Show the page
	    return View::make('admin.user.index')->with('users', $users)->with('rules', $rules);
    }

    public function view($id){

        $user = User::find($id);

        return View::make('admin.user.view')->with('user', $user);

    }
   
    public function add()
	{
		//get rules list 
		$rules = Rule::all();
		$rules_array = array();
		foreach($rules as $rule){
			$rules_array[$rule->id] = $rule->name;
		}

		return View::make('admin.user.add')->with('rules', $rules_array);
	}

	public function edit($id){
		
		$user = User::find($id);
		$rules = Rule::all();
		$rules_array = array();

		foreach($rules as $rule){
			$rules_array[$rule->id] = $rule->name;
		}

		return View::make('admin.user.edit', array(
			'user' => $user,
			'rules' => $rules_array
		));
	}
	
	public function delete($id){

		$user = User::find($id);
		$res = $user->delete();

		if($res){
			$message = 'The User <strong>' . $user->email . '</strong> is deleted Successfully';
		}else{
			$message = 'The User <strong>' . $user->email . '</strong> can not be deleted';
		}

		return Redirect::route('admin.users')
				->with('action', 'delete')
				->with('result', $res)
				->with('message', $message);
	}

	public function add_post()
	{
	   
		$validator = User::validetUser(Input::all());

		if ($validator->fails()){
			return Redirect::route('admin.user.add')->withErrors($validator)->withInput();
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
		$user->rbc = Input::get('rbc');
		$user->rsc = Input::get('rsc');
		$user->phone = Input::get('phone');
		$user->status = Input::get('status');
		$user->status = can('user.editstatus') && Input::get('status') ? Input::get('status') : Config::get('ilosool.default_user_status');
		
		(!is_null(Input::get('pe_interested')) ? $user->pe_interested = 1 : $user->pe_interested = null);
		
		$user->pe_geo_interests = Input::get('pe_geo_interests');
		$user->pe_sector_interests = Input::get('pe_sector_interests');
		$user->pe_investment_stage = Input::get('pe_investment_stage');
		$user->pe_investment_type = Input::get('pe_investment_type');
		$user->pe_investment_style = Input::get('pe_investment_style');
		$user->pe_deal_size = Input::get('pe_deal_size');

		(!is_null(Input::get('vc_interested')) ? $user->vc_interested = 1 : $user->vc_interested = null);

		$user->vc_geo_interests = Input::get('vc_geo_interests');
		$user->vc_sector_interests = Input::get('vc_sector_interests');
		$user->vc_investment_stage = Input::get('vc_investment_stage');
		$user->vc_investment_type = Input::get('vc_investment_type');
		$user->vc_investment_style = Input::get('vc_investment_style');
		$user->vc_deal_size = Input::get('vc_deal_size');

		(!is_null(Input::get('re_interested')) ? $user->re_interested = 1 : $user->re_interested = null);
		
		$user->re_geo_interests = Input::get('re_geo_interests');
		$user->re_sector_interests = Input::get('re_sector_interests');
		$user->re_investment_stage = Input::get('re_investment_stage');
		$user->re_investment_type = Input::get('re_investment_type');
		$user->re_investment_style = Input::get('re_investment_style');
		$user->re_deal_size = Input::get('re_deal_size');

		$user->investor_type = Input::get('investor_type');
		
		$user->company_name = Input::get('company_name');
		$user->rule_id = can('user.editrule') && Input::get('rule_id') ? Input::get('rule_id') : Config::get('ilosool.default_rule');
		$user->subscribed = Input::get('subscribed');

		$confirmed = Input::get('confirmed');
		if($confirmed == 1){
				$user->confirmed = $confirmed;
			}
		else{
				$user->generateConfirmationCode();
				$user->sendConfirmEmail($user);
			}

		$file = Input::file('image');
	    if($file){
			$destinationPath = User::getDir();
	        $filename = $file->getClientOriginalName();
	        $uploadSuccess = $file->move($destinationPath, $filename);

	        if($uploadSuccess) {
			    $user->image = $filename;
			}
		}

		$res = $user->save();

		if($res){
			$message = 'The User <strong>' . $user->email . '</strong> is created Successfully';
		}else{
			$message = 'The User <strong>' . $user->email . '</strong> can not be created';
		}

		return Redirect::route('admin.users')
				->with('action', 'create')
				->with('result', $res)
				->with('message', $message);
	}

	public function edit_post($id)
	{
		$user = User::find($id);

		$validator = User::validateEditUser(Input::all(), $user);
		
		if ($validator->fails()){
			return Redirect::route('admin.user.edit', $id)->withErrors($validator)->withInput();
		}
		
		$user->user_type = Input::get('user_type');
		$user->firstname = Input::get('firstname');
		$user->lastname = Input::get('lastname');
		$user->nickname = Input::get('nickname');
		$user->email = Input::get('email');

		$password = Input::get('password');
		
		if(!empty($password)) {
			$user->password = Hash::make(Input::get('password'));
		}

		$user->city = Input::get('city');
		$user->country = Input::get('country');
		$user->address = Input::get('address');
		$user->rbc = Input::get('rbc');
		$user->rsc = Input::get('rsc');
		$user->phone = Input::get('phone');
		
		if(can('user.editstatus') && Input::get('status')){
			$user->status = Input::get('status');
		}

		(!is_null(Input::get('pe_interested')) ? $user->pe_interested = 1 : $user->pe_interested = null);

		$user->pe_geo_interests = Input::get('pe_geo_interests');
		$user->pe_sector_interests = Input::get('pe_sector_interests');
		$user->pe_investment_stage = Input::get('pe_investment_stage');
		$user->pe_investment_type = Input::get('pe_investment_type');
		$user->pe_investment_style = Input::get('pe_investment_style');
		$user->pe_deal_size = Input::get('pe_deal_size');

		(!is_null(Input::get('vc_interested')) ? $user->vc_interested = 1 : $user->vc_interested = null);
		
		$user->vc_geo_interests = Input::get('vc_geo_interests');
		$user->vc_sector_interests = Input::get('vc_sector_interests');
		$user->vc_investment_stage = Input::get('vc_investment_stage');
		$user->vc_investment_type = Input::get('vc_investment_type');
		$user->vc_investment_style = Input::get('vc_investment_style');
		$user->vc_deal_size = Input::get('vc_deal_size');

		(!is_null(Input::get('re_interested')) ? $user->re_interested = 1 : $user->re_interested = null);
		
		$user->re_geo_interests = Input::get('re_geo_interests');
		$user->re_sector_interests = Input::get('re_sector_interests');
		$user->re_investment_stage = Input::get('re_investment_stage');
		$user->re_investment_type = Input::get('re_investment_type');
		$user->re_investment_style = Input::get('re_investment_style');
		$user->re_deal_size = Input::get('re_deal_size');
		
		$user->investor_type = Input::get('investor_type');

		$user->company_name = Input::get('company_name');
		if(can('user.editrule') && Input::get('rule_id')){
			$user->rule_id = Input::get('rule_id');
		}

		$user->subscribed = Input::get('subscribed');

		$confirmed = Input::get('confirmed');
		
		if ($user->confirmed != 1 && $confirmed == 1) {
				$user->confirmed = $confirmed;
			}
		elseif($user->confirmed == 1 && $confirmed != 1) {
				$user->generateConfirmationCode();
				$user->sendConfirmEmail($user);
			}

		$file = Input::file('image');
	    if($file){
			$destinationPath = User::getDir();
	        $filename = $file->getClientOriginalName();
	        $uploadSuccess = $file->move($destinationPath, $filename);

	        if($uploadSuccess) {
			    $user->image = $filename;
			}
		}
		
		$res = $user->save();

		if($res){
			$message = 'The User <strong>' . $user->email . '</strong> is edited Successfully';
		}else{
			$message = 'The User <strong>' . $user->email . '</strong> can not be edited';
		}

		return Redirect::route('admin.users')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
	}

	public function autoComplete($type){
		$input = Input::get('q');
		$data = array();
		$users = User::select('id', 'firstname', 'lastname', 'email')->where('email', 'LIKE', '%' . $input . '%')->orWhere('lastname', 'LIKE', '%' . $input . '%')->orWhere('lastname', 'LIKE', '%' . $input . '%')->take(10)->get();

		if($users){
			foreach($users as $user){
				$json = array();
				$json['id'] = ($type == 'id') ? $user->id : $user->email;
				$json['name'] = $user->firstname . ' ' . $user->lastname . ' "' . $user->email . '"';
				$data[] = $json;
			}
		}
		//header("Content-type: application/json");
		return json_encode($data);
	}

	public function getUsers(){
		$users = User::all();
		$output = "";
		foreach ($users as $user) {
			$output .= $user->firstname . ' , ' . $user->lastname . ' , ' . $user->nickname . ' , ' . $user->email . "\n";
		}

		$headers = array(
          'Content-Type' => 'text/csv',
          'Content-Disposition' => 'attachment; filename="users.csv"'
      	);
        return Response::make($output, 200, $headers);
	}
}