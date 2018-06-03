<?php

class AdminRequestController extends BaseController {

	public function index(){
		$col = Input::get('col');
        $rows = Input::get('rows');
        $asset = Input::get('asset');
        $status = Input::get('status');

        $q = RequestDeal::select(array('*'));

        if(Input::get('search')){
        	$q = $q ->where(function($q){
        		$q	->orWhere('id','=', Input::get('search'))
        			->orWhere('firstname','LIKE', '%' . Input::get('search') . '%')
        			->orWhere('lastname','LIKE', '%' . Input::get('search') . '%')
        			->orWhere('nickname','LIKE', '%' . Input::get('search') . '%')
        			->orWhere('asset_class','LIKE','%' . Input::get('search') . '%');
        	});
        }

        if(isset($status)){
        	$q = $q ->where('status','=',$status);
        }

        if($asset){
        	$q = $q ->where('asset_class','=',$asset);
        }

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
        	$requests = $q->paginate($rows);

        }else{
        	$requests = $q->paginate(Config::get('ilosool.rows_default'));
        }

        return View::make('admin.request.index')->with('requests', $requests);
    }

    public function view($id){
    	$request = RequestDeal::find($id);
    	return View::make('admin.request.view')->with('request', $request);
    }

    public function approve($id, $status){
    	
    	$request = RequestDeal::find($id);
    	
    	if($status == 1){
    		$request->status = 1;
    	}else{
    		$request->status = 0;
    	}

    	$request->save();

    	return Redirect::route('admin.requests');
    }
}