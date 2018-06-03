<?php

class PostController extends BaseController {

	public function index($type)
	{
		$posts = Post::where('type', '=', $type)->orderBy('updated_at', 'DESC')->paginate(Config::get('ilosool.rows_default'));
		return View::make('post.posts')->with('posts', $posts);
	}

	public function view($type,$id)
	{
		
		$post = Post::find($id);
		return View::make('post.view')->with('post', $post);
	}
	
}