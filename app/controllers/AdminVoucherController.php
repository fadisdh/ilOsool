<?php

class AdminVoucherController extends BaseController {

	public function index() {
        
        $col = Input::get('col');
        $rows = Input::get('rows');

        $q = Voucher::select(array('*'));

        if(Input::get('search')){
        	$q = $q ->where(function($q){
        		$q	->orWhere('id','=', Input::get('search'))
        			->orWhere('user_id','=', Input::get('search'))
        			->orWhere('company_id','=', Input::get('search')) 
        			->orWhere('type','=', Input::get('search'));
        	});
        }

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
        	$vouchers = $q->paginate($rows);
        }else{
        	$vouchers = $q->paginate(Config::get('ilosool.rows_default'));
        }

        return View::make('admin.voucher.index')->with('vouchers', $vouchers);
    }

     public function view($id) {

        $voucher = Voucher::find($id);

        return View::make('admin.voucher.view')->with('voucher', $voucher);
    }

    public function add() {
		return View::make('admin.voucher.add');
	}

	public function edit($id) {

		$voucher = Voucher::find($id);
		return View::make('admin.voucher.edit')->with('voucher', $voucher);
	}

	public function delete($id){

		$voucher = Voucher::find($id);
		$res = $voucher->delete();

		if($res){
			$message = 'The Voucher <strong>' . $voucher->id . '</strong> is deleted Successfully';
		}else{
			$message = 'The Voucher <strong>' . $voucher->id . '</strong> can not be deleted';
		}

		return Redirect::route('admin.vouchers')
				->with('action', 'delete')
				->with('result', $res)
				->with('message', $message);
	}

	public function add_post()
	{

	    $validator = Voucher::validate(Input::all());

		if ($validator->fails()){
			return Redirect::route('admin.voucher.add')->withErrors($validator)->withInput();
		}

		if(Input::get('user')){
	    	$user = User::find(Input::get('user'));
	    }else{
	    	$user = Auth::user();
	    }

	    if(Input::get('company')){
	    	$company = Company::find(Input::get('company'));
	    }else{
	    	$company = 0;
	    }

		$voucher = new Voucher();
		$voucher->user_id = $user->id;
		$voucher->company_id = $company->id;
		$voucher->type = Input::get('type');
		$voucher->data = Input::get('data');
		$voucher->price = Input::get('price');
		$voucher->start_date = Input::get('start_date');
		$voucher->end_date = Input::get('end_date');

		$res = $voucher->save();

		if($res){
			$message = 'The Voucher <strong>' . $voucher->id . '</strong> is created Successfully';
		}else{
			$message = 'The Voucher <strong>' . $voucher->id . '</strong> can not be created';
		}

		return Redirect::route('admin.vouchers')
				->with('action', 'add')
				->with('result', $res)
				->with('message', $message);
	}

	public function edit_post($id)
	{

	    $validator = Voucher::validate(Input::all());

		if ($validator->fails()){
			return Redirect::route('admin.voucher.edit', $id)->withErrors($validator)->withInput();
		}

		if(Input::get('user')){
	    	$user = User::find(Input::get('user'));
	    }else{
	    	$user = Auth::user();
	    }

	    if(Input::get('company')){
	    	$company = Company::find(Input::get('company'));
	    }else{
	    	$company = 0;
	    }

		$voucher = Voucher::find($id);
		$voucher->user_id = $user->id;
		$voucher->company_id = $company->id;
		$voucher->type = Input::get('type');
		$voucher->data = Input::get('data');
		$voucher->price = Input::get('price');
		$voucher->start_date = Input::get('start_date');
		$voucher->end_date = Input::get('end_date');

		$res = $voucher->save();

		if($res){
			$message = 'The Voucher <strong>' . $voucher->id . '</strong> is edited Successfully';
		}else{
			$message = 'The Voucher <strong>' . $voucher->id . '</strong> can not be edited';
		}

		return Redirect::route('admin.vouchers')
				->with('action', 'edit')
				->with('result', $res)
				->with('message', $message);
	}
}

