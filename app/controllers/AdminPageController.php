<?php

class AdminPageController extends BaseController {


    public function index()
    {
        
        $col = Input::get('col');
        $rows = Input::get('rows');

        $q = Page::select(array('*'));

        if(Input::get('search')){
        	$q = $q ->where(function($q){
        		$q	->orWhere('title','LIKE', '%' . Input::get('search') . '%')
        			->orWhere('id','=', Input::get('search'))
        			->orWhere('slug','LIKE','%' . Input::get('search') . '%');
        	});
        }

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
        	$pages = $q->paginate($rows);
        }else{
        	$pages = $q->paginate(Config::get('ilosool.rows_default'));
        }
        
	    return View::make('admin.page.index')->with('pages', $pages);
	   
    }

    public function view($id){

        $page = Page::find($id);

        return View::make('admin.page.view')->with('page', $page);

    }

    public function add()
	{
		return View::make('admin.page.add');
	}

	public function edit($id){
		$page = Page::find($id);
		return View::make('admin.page.edit')->with('page', $page);
	}

	public function delete($id){

		$page = Page::find($id);
		$res = $page->delete();

		if($res){
			$message = 'The Page <strong>' . $page->slug . '</strong> is deleted Successfully';
		}else{
			$message = 'The Page <strong>' . $page->slug . '</strong> can not be deleted';
		}

		return Redirect::route('admin.pages')
				->with('action', 'delete')
				->with('result', $res)
				->with('message', $message);
	}

	public function add_post()
	{

	    $validator = Page::validate(Input::all());

		if ($validator->fails()){
			return Redirect::route('admin.page.add')->withErrors($validator)->withInput();
		}

		$page = new Page();
		$page->title = Input::get('title');
		$page->title_arabic = Input::get('title_arabic');
		$page->slug = Input::get('slug');
		$page->content = Input::get('content');
		$page->content_arabic = Input::get('content_arabic');
		$page->type = Input::get('type');
		$page->tags = Input::get('tags');

		$file = Input::file('image');
	    if($file){
			$destinationPath = Page::getDir();
	        $filename = $file->getClientOriginalName();
	        $uploadSuccess = $file->move($destinationPath, $filename);

	        if($uploadSuccess) {
			    $page->image = $filename;
			}
		}

		$res = $page->save();

		if($res){
			$message = 'The Page <strong>' . $page->slug . '</strong> is created Successfully';
		}else{
			$message = 'The Page <strong>' . $page->slug . '</strong> can not be created';
		}

		return Redirect::route('admin.pages')
				->with('action', 'add')
				->with('result', $res)
				->with('message', $message);
	}

	public function edit_post($id){

		$validator = Page::validate(Input::all());

		if ($validator->fails()){
			return Redirect::route('admin.page.edit', $id)->withErrors($validator)->withInput();
		}

		$page = Page::find($id);
		$page->title = Input::get('title');
		$page->title_arabic = Input::get('title_arabic');
		$page->slug = Input::get('slug');
		$page->content = Input::get('content');
		$page->content_arabic = Input::get('content_arabic');
		$page->type = Input::get('type');
		$page->tags = Input::get('tags');

		$file = Input::file('image');
	    if(!is_null($file)){
			$destinationPath = Page::getDir();
	        $filename = $file->getClientOriginalName();
	        $uploadSuccess = $file->move($destinationPath, $filename);

	        if($uploadSuccess) {
			    $page->image = $filename;
			}
		}

		$res = $page->save();

		if($res){
			$message = 'The Page <strong>' . $page->slug . '</strong> is edited Successfully';
		}else{
			$message = 'The Page <strong>' . $page->slug . '</strong> can not be edited';
		}

		return Redirect::route('admin.pages')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
		}
}