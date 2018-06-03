<?php

class UsersScore extends Eloquent{
	
    protected $table = 'users_score';

    public static function above($id, $score){

        $users = UsersScore::select(array('*'))->where('company_id','=', $id)
                                        ->where('score','>=', $score)
                                        ->get();
        return $users;
    }   
}