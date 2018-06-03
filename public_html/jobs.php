<?php
require __DIR__.'/../bootstrap/autoload.php';
require_once __DIR__.'/../bootstrap/start.php';

// Get Jobs
$jobs = Job::where('fire_date', '<=', new DateTime('now'))
			->where('done', '=', false)
			->get();

if(count($jobs) > 0){
	foreach ($jobs as $job) {

		if($job->action == 'notification'){

			$jobUserID = $job->user_id;

			Notification::add($jobUserID, $job->type, $job->message, $job->url, $job->title, $job->title_arabic, $job->message_arabic);

		}elseif($job->action == 'email'){

			$user = User::find($job->user_id);

			if($user->subscribed == 1){

				// $data = array('content' => $job->message,
				// 				'url' => $job->url);
				// Mail::queue('emails.notification', $data, function($message) use ($user, $job)
				// {
				// 	$message->from('info@ilosool.com');
				//     $message->to($user->email, $user->firstname . ' ' . $user->lastname)->subject(strip_tags($job->title));
				// });

			}

		}elseif($job->action == 'notification+email' || $job->action == 'email+notification'){
			
			$jobUserID = $job->user_id;
			$user = User::find($job->user_id);

			if($user){
				Notification::add($jobUserID, $job->type, $job->message, $job->url, $job->title, $job->title_arabic, $job->message_arabic);
			
				if($user->subscribed == 1){
					// $data = array('content' => $job->message,
					// 				'url' => $job->url);
					// Mail::queue('emails.notification', $data, function($message) use ($user, $job)
					// {
					// 	$message->from('info@ilosool.com');
					//     $message->to($user->email, $user->firstname . ' ' . $user->lastname)->subject(strip_tags($job->title));
					// });
				}
			}

		}elseif($job->action == 'message+email' || $job->action == 'email+message'){
		
			$user = User::find($job->user_id);

			if($user->subscribed == 1){
				// $data = array('content' => $job->message,
				// 				'url' => $job->url);
				// Mail::queue('emails.notification', $data, function($message) use ($user, $job)
				// {
				// 	$message->from('info@ilosool.com');
				//     $message->to($user->email, $user->firstname . ' ' . $user->lastname)->subject(strip_tags($job->title));
				// });
			}
		}

		$job->done = true;
		$job->save();
	}
}
