<?php

class AdminNewsletterController extends BaseController {

    public function index()
    {
        $col = Input::get('col');
        $rows = Input::get('rows');

        $q = Newsletter::select(array('*'));

        if(Input::get('search')){
        	$q = $q ->where(function($q){
        		$q	->orWhere('title','LIKE', '%' . Input::get('search') . '%')
        			->orWhere('id','=', Input::get('search'))
        			->orWhere('type','LIKE','%' . Input::get('search') . '%')
        			->orWhere('content','LIKE','%' . Input::get('search') . '%');
        	});
        }

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
        	$newsletters = $q->paginate($rows);
        }else{
        	$newsletters = $q->paginate(Config::get('ilosool.rows_default'));
        }
        
        // Show the page
	    return View::make('admin.newsletter.index')->with('newsletters', $newsletters);
    }

    public function view($id){

        $newsletter = Newsletter::find($id);

        return View::make('admin.newsletter.view')->with('newsletter', $newsletter);

    }
   
    public function add()
	{
		return View::make('admin.newsletter.add');
	}

	public function edit($id){
		
		$newsletter = Newsletter::find($id);

		return View::make('admin.newsletter.edit')->with('newsletter', $newsletter);
	}
	
	public function delete($id){

		$newsletter = Newsletter::find($id);
		$res = $newsletter->delete();

		if($res){
			$message = 'The Newsletter <strong>' . $newsletter->title . '</strong> is deleted Successfully';
		}else{
			$message = 'The Newsletter <strong>' . $newsletter->title . '</strong> can not be deleted';
		}

		return Redirect::route('admin.newsletters')
				->with('action', 'delete')
				->with('result', $res)
				->with('message', $message);
	}

	public function add_post()
	{
	    
		$validator = Newsletter::validate(Input::all());

		if ($validator->fails()){
			return Redirect::route('admin.newsletter.add')->withErrors($validator)->withInput();
		}

		$newsletter = new Newsletter();
		$newsletter->title = Input::get('title');
		$newsletter->content = Input::get('content');
		$newsletter->type = Input::get('type');

		$res = $newsletter->save();

		if($res){
			$message = 'The Newsletter <strong>' . $newsletter->title . '</strong> is created Successfully';
		}else{
			$message = 'The Newsletter <strong>' . $newsletter->title . '</strong> can not be created';
		}

		return Redirect::route('admin.newsletters')
				->with('action', 'create')
				->with('result', $res)
				->with('message', $message);
	}

	public function edit_post($id)
	{
		$validator = Newsletter::validate(Input::all());

		if ($validator->fails()){
			return Redirect::route('admin.newsletter.edit', $id)->withErrors($validator)->withInput();
		}

		$newsletter = Newsletter::find($id);
		$newsletter->title = Input::get('title');
		$newsletter->content = Input::get('content');
		$newsletter->type = Input::get('type');

		$res = $newsletter->save();

		if($res){
			$message = 'The Newsletter <strong>' . $newsletter->title . '</strong> is edited Successfully';
		}else{
			$message = 'The Newsletter <strong>' . $newsletter->title . '</strong> can not be edited';
		}

		return Redirect::route('admin.newsletters')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
	}

	public function newsletterUse($id)
	{
		$rules = Rule::all();
		$rules_array = array();
		foreach($rules as $rule){
			$rules_array[$rule->id] = $rule->name;
		}

		$newsletter = Newsletter::find($id);

		return View::make('admin.newsletter.use')->with(array('newsletter' => $newsletter, 'rules' => $rules_array));
	}

	public function submit($id)
	{
		$content = Input::get('content');

		$validator = Newsletter::validateUse(Input::all());

	    if ($validator->fails())
	    {
	        return Redirect::route('admin.newsletter.use', $id)->withErrors($validator)->withInput();
	    }

		if(Input::get('option') == 'user'){

			$emails = explode(",", Input::get('email'));

			foreach($emails as $email){
				
				$user = User::where('email', '=', $email)->first();

				$userData = array(
					'email' => $email,
					'name' => $user->firstname . ' ' . $user->lastname,
				);

				Mail::queue('admin.newsletter.email', array('content' => Input::get('content')), function($message) use ($userData)
				{
					$message->from('info@ilosool.com', 'ilOsool');
					$message->to($userData['email'], $userData['name'])->subject(Input::get('subject'));
				});
			}
		}
		
		if(Input::get('option') == 'rule'){
			
			$users = User::where('rule_id','=', Input::get('rule_id'))->get();

			foreach($users as $user){
				$this->sendMail($user, $content);
			}
			
		}

		if(Input::get('option') == 'subscribed'){

			$subscribed_rules = Input::get('subscribed_rule');
			foreach ($subscribed_rules as $sub ) {
				$users = User::where('subscribed', '=', 1)
							->where('rule_id', '=',  $sub)
							->get();
							
				if(isset($users)){
					foreach($users as $user){

						$this->sendMail($user, $content);
					}
				}
			}
		}

		if(Input::get('option') == 'all'){

			$users = User::all();
			foreach($users as $user){
				$this->sendMail($user, $content);
			}
		}

		return Redirect::route('admin.newsletters');
	}

	public function sendMail($user, $content){

		Mail::queue('admin.newsletter.email', array('content' => $content), function($message) use ($user)
				{
					$message->from('info@ilosool.com', 'ilOsool');
					$message->to($user->email, $user->firstname . ' ' . $user->lastname)->subject(Input::get('subject'));
				});
	}
}