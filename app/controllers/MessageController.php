<?php

class MessageController extends BaseController {

	public function messages()
	{
		$messages = User::getUserMessages(Auth::user()->id);

        return View::make('message.messages')->with('messages', $messages)
		        									 ->with('topmenu', 'messages')
		        								 	 ->with('sidemenu', 'messages');
	}

	public function message_view($id)
	{
		if(Auth::check()){
			$message = Message::find($id); //Parent message

			$messages = User::getReceivedMessage($message->message_id); // get related messages from the parent

			if(Auth::user()->id == $message->receiver_id){
				//change the status of viewed message
				if($message->viewed_receiver == 0){
					$message->viewed_receiver = 1;
					$message->save();
				}

				return View::make('message.message_view')->with('messages', $messages)->with('message', $message);

	        }elseif(Auth::user()->id == $message->sender_id){

	        	if($message->viewed_sender == 0){
					$message->viewed_sender = 1;
					$message->save();
				}

	        	return View::make('message.message_view')->with('messages', $messages)->with('message', $message);

	        }else{
	        	return View::make('common.error');
	        }
	    }else{
	    	return View::make('common.error');
	    }
	}

	public function send_message($id, $type){
   		if(Auth::check()){
			return View::make('message.form.message_popup')->with('id', $id)->with('type', $type);
   		}else{
   			$msg = sprintf(Config::get('ilosool.messages.login_required'), 'request');
   			return View::make('common.popup_alert_login')->with('message', $msg);
   		}
   	}

   	public function send_message_post($id, $type){

   		if($type == 'company'){
   			$reference = Company::find($id);
   		}elseif($type == 'request'){
   			$reference = RequestDeal::find($id);
   		}

   		$validator = Company::validateSendMessage(Input::all());

         if ($validator->fails()){
            return json_encode(array('message' => (string)View::make('message.form.message_popup')->with('error', true)->with('id', $id)->with('type', $type)));
         }

   		$message = new Message();

   		$message->content = Input::get('content');
   		$message->type = "message";
   		$message->sender_id = Auth::user()->id;
   		$message->receiver_id = $reference->user_id;
   		$message->reference_id = $reference->id;

   		if($type == 'company'){
   			$message->reference_type = 'Company';
   		}elseif($type == 'request'){
   			$message->reference_type = 'RequestDeal';
   		}
   		
   		$message->viewed_receiver = 0;
   		$message->viewed_sender = 1;

   		$message->save();
   		
   		$message->message_id = $message->id;

   		$message->save();

   		$url = URL::route('message.view', $message->id);
   		if(Auth::user()->nickname){
   			$title = sprintf(Config::get('ilosool.messages.new_message'), Auth::user()->nickname);
   		}else{
   			$title = sprintf(Config::get('ilosool.messages.new_message'), Auth::user()->firstname . ' ' . Auth::user()->lastname);
   		}
   		
   		$message = $title;
   		Job::add($reference->user_id, 'message+email', 'message', $message, $url, $title, '', '');

   		$msg = trans('general.messages.send_message_success');
   		return json_encode(array('message' => (string )View::make('common.popup_alert')->with('message', $msg), 'refresh' => true));

   	}

   	// Message Reply
      public function messageReply_post($messageId){

   		$messageParent = Message::find($messageId);
         $messages = User::getReceivedMessage($messageId);

      	$validator = Company::validateSendMessage(Input::all());

   	   if ($validator->fails()){
            return View::make('message.message_view')->with('error', true)->with('message', $messageParent)->with('messages', $messages);
         }

   		$message = new Message();

   		$message->content = Input::get('content');
   		$message->type = "message";
   		$message->sender_id = Auth::user()->id;
   		$message->reference_id = $messageParent->reference_id;
   		$message->reference_type = $messageParent->reference_type;
   		$message->message_id = $messageParent->id;
   		$message->viewed_receiver = 1;
   		$message->viewed_sender = 1;

		if(Auth::user()->id == $messageParent->sender_id){
			$message->receiver_id = $messageParent->receiver_id;

			$messageParent->viewed_receiver = 0;
			$messageParent->viewed_sender = 1;
		}else{
			$message->receiver_id = $messageParent->sender_id;

			$messageParent->viewed_receiver = 1;
			$messageParent->viewed_sender = 0;
		}
   		
   		$messageParent->save();
   		$message->save();

   		$url = URL::route('messages');
   		if(Auth::user()->nickname){
   			$title = sprintf(Config::get('ilosool.messages.new_message'), Auth::user()->nickname);
   		}else{
   			$title = sprintf(Config::get('ilosool.messages.new_message'), Auth::user()->firstname . ' ' . Auth::user()->lastname);
   		}
   		
   		$message = $title;
   		Job::add(Auth::user()->id, 'message+email', 'message', $message, $url, $title, '', '');

   		return Redirect::route('message.view', $messageId)->with('messages', $messages)->with('messageId', $messageId);
	}

   	// public function sentMessages()
	// {
	// 	$messages = User::getUserSentMessages(Auth::user()->id);

 //        return View::make('profile.sent_messages')->with('messages', $messages)
 //        									 ->with('topmenu', 'messages')
 //        								 	 ->with('sidemenu', 'messages');
	// }

}