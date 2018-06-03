<?php

class LoginController extends BaseController {

	public function index()
	{
		return View::make('common.login');
	}

	public function login()
	{
		$remember = (Input::get('remember')) ? true : false;
		
		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'), 'confirmed' => 1), $remember))
		{
			
			// If user attempted to access specific URL before logging in
			if ( Session::has('pre_login_url') )
			{
				$url = Session::get('pre_login_url');
				Session::forget('pre_login_url');
				return Redirect::to($url);
			}
			else
    			return Redirect::intended('home');
		}
		else
		{
			if (Auth::validate(array('email' => Input::get('email'), 'password' => Input::get('password')))){
				return Redirect::to('login')->with('error', trans('general.messages.confirm_email'));
			}else{
				return Redirect::to('login')->with('error', trans('general.messages.error_username'));
			}
		}
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}

	public function passreminder(){
		return View::make('common.passreminder');
	}

	public function passreminderPost(){
		$user = User::where('email', '=', Input::get('email'))->first();

		if($user){
			$credentials = array('email' => Input::get('email'));
			Password::remind($credentials);
			$message = trans('general.messages.email_password_sent');
		}else{
			$message = trans('general.messages.incorrect_email');
		}
		return json_encode(array('message' => (string )View::make('common.popup_alert')->with('success', true)->with('message', $message)));	
	}

	public function passreset($token){
		return View::make('common.passreset')->with('token', $token);
	}

	public function passresetPost(){
		
		$credentials = array(
	        'email' => Input::get('email'),
	        'password' => Input::get('password'),
	        'password_confirmation' => Input::get('password_confirmation')
		    );

		    return Password::reset($credentials, function($user, $password)
		    {
		        $user->password = Hash::make($password);

		        $user->save();

		        Auth::login($user);

		        return Redirect::to('/');
		    });
	}
}