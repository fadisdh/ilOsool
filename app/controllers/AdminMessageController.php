<?php

class AdminMessageController extends BaseController {

	public function index($id, $messageType)
	{
        $col = Input::get('col');
        $rows = Input::get('rows');
        
        $q = Message::select(array('*'));

        if($messageType == "sent"){
        	$q = $q->where('sender_id', '=', $id);
        }elseif($messageType == "received"){
        	$q = $q->where('receiver_id', '=', $id);
        }

        if(Input::get('search')){
        	$q = $q ->where(function($q){
        		$q	->orWhere('title','LIKE', '%' . Input::get('search') . '%')
        			->orWhere('id','=', Input::get('search'))
        			->orWhere('type','LIKE','%' . Input::get('search') . '%');
        	});
        }

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
        	$messages = $q->paginate($rows);
        }else{
        	$messages = $q->paginate(Config::get('ilosool.rows_default'));
        }

        $user = User::where('id', '=', $id)->first();

        return View::make('admin.message.index')
        ->with(array('id' => $id,
        				'messageType' => $messageType,
						'messages' => $messages,
						'username' => $user->firstname . ' ' . $user->lastname
			));
	}

	public function viewMessage($id, $messageType, $messageId){

		$message = Message::find($messageId);

		$user = User::find($id);

		if( $messageType == "sent"){
			$userType = User::find($message->receiver_id);
		}else{
			$userType = User::find($message->sender_id);
		}

		return View::make('admin.message.view')
		->with(array('id' => $id,
					'messageType' => $messageType,
					'message' => $message,
					'userTypeName' => $userType->firstname . ' ' . $userType->lastname,
					'username' => $user->firstname . ' ' . $user->lastname
			));

		
	}
}