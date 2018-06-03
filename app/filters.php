<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/* permissions
----------------------------------------------- */
Route::filter('auth.general', function()
{
	if (Auth::check() && Auth::user()->rule_id == 7 && !Request::is('logout') && !Request::is('register/*') && !Request::is('listing_type') && !Request::is('page/*') )
		return Redirect::to('register/user_type');
});
Route::when('*', 'auth.general');

Route::filter('auth.admin', function()
{
	Session::put('pre_login_url', URL::current());

	if (Auth::guest()) return Redirect::guest('login');

	if (!can('admin.view')) return Redirect::intended('login');
});
Route::when('admin/*', 'auth.admin');

Route::filter('can', function($route, $request, $per = null)
{
	Session::put('pre_login_url', URL::current());
	if(!can($per)) return Redirect::intended('login');
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{	
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


/*
|--------------------------------------------------------------------------
| Localization Filter
|--------------------------------------------------------------------------
|
| 
|
*/
Route::filter('localization', function() {
	$languages = array('en','ar');
    $locale = Input::get('lang');
    if($locale){
    	App::setLocale($locale);
    	if(in_array(Request::segment(1), $languages)){
    		$url = preg_replace('/^(en|ar)\//', $locale . '/', Request::path());
    	}else{
    		$url = $locale . '/' . Request::path();
    	}
    	return Redirect::to($url);
    }else{
    	$locale =Request::segment(1);
    	if(!in_array($locale, $languages)) $locale = 'en';
    	App::setLocale($locale);
    }

	
});