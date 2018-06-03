<?php

class AdminPostController extends BaseController {

	public function index()
	{
        $col = Input::get('col');
        $rows = Input::get('rows');
        $type = Input::get('type');

        $q = Post::select(array('*'));

        if(Input::get('search')){
        	$q = $q ->where(function($q){
        		$q	->orWhere('title','LIKE', '%' . Input::get('search') . '%')
        			->orWhere('id','=', Input::get('search'))
        			->orWhere('type','LIKE','%' . Input::get('search') . '%');
        	});
        }

        if($type){
        	$q = $q ->where('type','LIKE','%' . $type . '%');
        }

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
        	$posts = $q->paginate($rows);

        }else{
        	$posts = $q->paginate(Config::get('ilosool.rows_default'));
        }

        return View::make('admin.post.index')->with('posts', $posts);
	}

	public function view($id){

        $post = Post::find($id);

        return View::make('admin.post.view')->with('post', $post);

    }

	public function add()
	{

		return View::make('admin.post.add');
	}

	
	public function edit($id)
	{

		$post = Post::find($id);
		return View::make('admin.post.edit')->with('post', $post);
	}

	public function delete($id)
	{

		$post = Post::find($id);
		$res = $post->delete();

		if($res){
			$message = 'The Post <strong>' . $post->title . '</strong> is deleted Successfully';
		}else{
			$message = 'The Post <strong>' . $post->title . '</strong> can not be deleted';
		}

		return Redirect::route('admin.posts')
				->with('action', 'delete')
				->with('result', $res)
				->with('message', $message);
	}

	public function add_post()
	{

	    $validator = Post::validate(Input::all());

	    if ($validator->fails())
	    {
	        return Redirect::route('admin.post.add')->withErrors($validator)->withInput();
	    }

		$post = new Post();
		$post->title = Input::get('title');
	    $post->content = Input::get('content');
	    $post->type = Input::get('type');
	    $post->tags = Input::get('tags');

	    $file = Input::file('image');
	    if($file){
			$destinationPath = Post::getDir();
	        $filename = $file->getClientOriginalName();
	        $uploadSuccess = $file->move($destinationPath, $filename);

	        if($uploadSuccess) {
			    $post->image = $filename;
			}
		}

		$res = $post->save();

		if($res){
			$message = 'The Post <strong>' . $post->title . '</strong> is created Successfully';
		}else{
			$message = 'The Post <strong>' . $post->title . '</strong> can not be created';
		}

		return Redirect::route('admin.posts')
				->with('action', 'add')
				->with('result', $res)
				->with('message', $message);
	}

	public function edit_post($id)
	{
		$validator = Post::validate(Input::all());

	    if ($validator->fails())
	    {
	        return Redirect::route('admin.post.edit', $id)->withErrors($validator)->withInput();
	    }

		$post = Post::find($id);
		$post->title = Input::get('title');
	    $post->content = Input::get('content');
	    $post->type = Input::get('type');
	    $post->tags = Input::get('tags');

	    $file = Input::file('image');
	    if(!is_null($file)){
			$destinationPath = Post::getDir();
	        $filename = $file->getClientOriginalName();
	        $uploadSuccess = $file->move($destinationPath, $filename);

	        if($uploadSuccess) {
			    $post->image = $filename;
			}
		}

		$res = $post->save();

		if($res){
			$message = 'The Post <strong>' . $post->title . '</strong> is edited Successfully';
		}else{
			$message = 'The Post <strong>' . $post->title . '</strong> can not be edited';
		}

		return Redirect::route('admin.posts')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
	}
	
}