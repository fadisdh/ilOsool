<?php

class HomeController extends BaseController {

	public function index()
	{	
		
		if(Auth::check()){
			return Redirect::route('user.home');
		}else{
			$slider1 = Page::where('slug', 'slider1')->first();
			$slider2 = Page::where('slug', 'slider2')->first();
			$slider3 = Page::where('slug', 'slider3')->first();
			$slider4 = Page::where('slug', 'slider4')->first();

			$companies = Company::where('featured','=',1)->orderBy(DB::raw('RAND()'))->take(12)->get();
			
			$options = Option::getAllByGroup();

			return View::make('common.home')->with('companies', $companies)->with('slider1', $slider1)->with('slider2', $slider2)->with('slider3', $slider3)->with('slider4', $slider4);
		}
	}

	public function languageSwitch(){

		$current = Config::get('app.locale');

		if($current == 'en'){
			App::setlocale('ar');
		}else{
			
			App::setlocale('en');

		}
		return Redirect::route('home');
	}

	public function emaiTest(){
		$data = array('content' => 'sadsadsad',
							'url' => 'sadsadssad');
		Mail::send('emails.notification', $data, function($message)
		{
			$message->from('admin@ilosool.com');
			$message->to('info@ilosool.com', 'John Smith')->subject('Welcome!');
		});
	}
}