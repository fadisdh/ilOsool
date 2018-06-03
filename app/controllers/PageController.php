<?php

class PageController extends BaseController {

	public function view($slug){

		$page = Page::where('slug', $slug)->first();
		if(!$page) return Redirect::route('page.error');

		return View::make('page.view')->with('page', $page);
	}

	public function contact(){
		$page = Page::where('slug', 'contact')->first();
		
		if(!$page) return Redirect::route('page.error');

		return View::make('page.contact')->with('page', $page);
	}

	public function individual(){
		$page = Page::where('slug', 'individual')->first();
		if(!$page) return Redirect::route('page.error');

		return View::make('page.individual')->with('page', $page);
	}

	public function companies(){
		$page = Page::where('slug', 'companies')->first();
		if(!$page) return Redirect::route('page.error');

		return View::make('page.companies')->with('page', $page);
	}

	public function agent(){
		$page = Page::where('slug', 'agent')->first();
		if(!$page) return Redirect::route('page.error');

		return View::make('page.agent')->with('page', $page);
	}

	public function error(){
		return View::make('page.error');
	}

	public function partners(){
		return View::make('page.partners');
	}

	public function searchPage(){

		/* Search on Pages */
		
		if(Input::get('search') != ""){
			$q = Page::select(array('*'));

			if(Input::get('search')){
	        	$q = $q ->where(function($q){
	        		$q	->orWhere('title','LIKE', '%' . Input::get('search') . '%')
	        			->orWhere('slug','LIKE','%' . Input::get('search') . '%')
	        			->orWhere('content','LIKE','%' . Input::get('search') . '%')
	        			->where('type','=','informative');
	        	});
	        }

	        $pages = $q->paginate(Config::get('ilosool.rows_default'));

	        return View::make('common.search')->with('pages', $pages)->with('search', Input::get('search'));
    	}
		
			return View::make('common.search')->with('search', 'Empty Value');
	}

}