<?php

class LinkedinController extends BaseController {

	public function logout(){
		Auth::logout();
		return Redirect::intended('/');
	}

	public function login(){

		
		$consumer_key = 'i8p5186sly05';
		$cookie_name = "linkedin_oauth_${consumer_key}";
		//$credentials_json = $_COOKIE[$cookie_name]; // where PHP stories cookies
		//$credentials = json_decode($credentials_json);

		if(!Auth::check() || Input::get('type')) {
			$type = Input::get('type') ? Input::get('type') : 'both';
			$user = User::where('email', '=', Input::get('email'))->first();

			if($user){
				Auth::login($user);
			}else{
				Session::put('linkedin',
								array('firstname' => Input::get('firstName'),
										'lastname' => Input::get('lastName'),
										'email' => Input::get('email'),
										'address' => Input::get('mainAddress'),
										'country' => Input::get('location'),
										'phone' => Input::get('phoneNumber'),
										'birth' => Input::get('birth'),
								));
				
				return Redirect::route('register.linkedin', $type);
			}
		}
		return Redirect::route('home');
	}
	
}