<?php

class Job extends Eloquent{
	protected $table = 'jobs';

    public function user(){
        return $this->belongsTo('User', 'user_id');   
    }

    public static function add($userId, $action, $type, $message, $url, $title = "", $title_arabic = "", $message_arabic = ""){
    	
        $user = User::find($userId);

        $job = new Job();
        $job->user_id = $userId;
        $job->action = $action;
        $job->type = $type;
        $job->title = $title ? $title : trimWords($message, 10);
        $job->message = $message;
        $job->title_arabic = $title_arabic ? $title_arabic : trimWords($message_arabic, 10);
        $job->message_arabic = $message_arabic;
        $job->url = $url;
        $job->done = false;
        $job->fire_date = new DateTime('now');

        $job->save();
            	
    }

    public static function adminNotification($action, $type, $message, $url, $title){
        
        $users = User::where('rule_id', '=', 1)->get();
        
        foreach ($users as $user) {
            Job::add($user->id, $action, $type, $message, $url, $title);
        }
    }
    
    public static function sendNotificationToUsers($company, $action){
        // Send notifications to users intrested to this deal
        $usersScores = new UsersScore();
        //$users = $usersScores->above($company->id, 10);
        $users = User::all();

        $url = URL::route('company.view', $company->id);

        if($action == 'created'){
            $title = Config::get('ilosool.titles.intrested_in');
            $message = sprintf(Config::get('ilosool.messages.intrested_in'), $company->deal_name, $url, $company->deal_name);
            $title_arabic = Config::get('ilosool.titles_arabic.intrested_in');
            $message_arabic = sprintf(Config::get('ilosool.messages_arabic.intrested_in'), $company->deal_name, $url, $company->deal_name);
            $type = 'new_company';
            $actionJob = 'notification+email';
        }else{
            $title = Config::get('ilosool.titles.intrested_in_updated');
            $message = sprintf(Config::get('ilosool.messages.intrested_in_updated'), $company->deal_name, $url, $company->deal_name);
            $title_arabic = Config::get('ilosool.titles_arabic.intrested_in_updated');
            $message_arabic = sprintf(Config::get('ilosool.messages_arabic.intrested_in_updated'), $company->deal_name , $url, $company->deal_name);
            $type = 'update_company';
            $actionJob = 'notification';
        }

        $url = URL::route('company.view', $company->id);
        foreach ($users as $user) {
            if($user->subscribed == 1){
                //Job::add($user->user_id, $actionJob, $type, $message, $url, $title, $title_arabic, $message_arabic);
                Job::add($user->id, $actionJob, $type, $message, $url, $title, $title_arabic, $message_arabic);
            }
        }
    }
}