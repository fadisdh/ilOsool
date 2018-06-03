<?php

class AdminInvestmentController extends BaseController {

	public function index($id){
        $col = Input::get('col');
        $rows = Input::get('rows');
        $type = Input::get('type');

        $q = Investment::select(array('*'))->where('company_id', '=', $id);

        if(Input::get('search')){
            $q = $q ->where(function($q){
                 $q ->orWhere('id','=', Input::get('search'))
                 	->orWhere('status', 'LIKE', '%' . Input::get('search') . '%')
                    ->orWhere('user_id','=', Input::get('search'));
            });
        }

        if($col){
            $order = (Input::get('order')) ? Input::get('order') : 'ASC';
            $q = $q->orderBy($col, $order);
        }

        $investments = array();
        if(isset($rows)){
            $investments = $q->paginate($rows);
        }else{
            $investments = $q->paginate(Config::get('ilosool.rows_default'));
        }

        //get company name
        $company = Company::find($id);

        // Show the page
	    return View::make('admin.company.investment.index')->with('investments', $investments)->with('company', $company);
    }

    public function view($company_id,$id){

        $investment = Investment::find($id);
        $user = User::find($investment->user_id);

        //get company name
        $company = Company::find($company_id);

        return View::make('admin.company.investment.view')->with('investment', $investment)->with('company', $company)->with('user', $user);
    }

    public function add($company_id){

        $company = Company::find($company_id);

        return View::make('admin.company.investment.add')->with('company',$company);
    }

    public function edit($company_id,$id){
        
        $investment = Investment::find($id);

        $company = Company::find($company_id);

        return View::make('admin.company.investment.edit', array('investment' => $investment, 'company' => $company));
    }

    public function delete($company_id, $id){

        $investment = Investment::find($id);

        $res = $investment->delete();

        if($res){
            $message = 'The Investment is deleted Successfully';
        }else{
            $message = 'The investment can not be deleted';
        }

        return Redirect::route('admin.company.investments', $investment->company_id)
                ->with('action', 'delete')
                ->with('result', $res)
                ->with('message', $message);
    }

    public function add_post($company_id){

        $user = Auth::user();

        //validate company
        $validator = Investment::validate(Input::all());

        if ($validator->fails())
        {
            return Redirect::route('admin.company.investment.edit', array($company_id))->withErrors($validator)->withInput();
        }

        //Company info
        $investment = new investment();

        if($investment->validate(Input::all())){
        	$investment->user_id = Input::get('user_id');
        	$investment->company_id = $company_id;
            $investment->amount = Input::get('amount');
            $investment->value = Input::get('value');
            $investment->status = Input::get('status');
            
            $res = $investment->save();
        }

        if($res){
            $message = 'The Investment is created Successfully';
        }else{
            $message = 'The Investment cannot be created';
        }

        return Redirect::route('admin.company.investments', $company_id)
                ->with('action', 'add')
                ->with('result', $res)
                ->with('message', $message);
    }

    public function edit_post($company_id,$id){

        $user = Auth::user();

        //validate company
        $validator = Investment::validate(Input::all());

        if ($validator->fails())
        {
            return Redirect::route('admin.company.investment.edit', array($company_id, $id))->withErrors($validator)->withInput();
        }

        //Company info
        $investment = Investment::find($id);

        if($investment->validate(Input::all())){
        	$investment->user_id = Input::get('user_id');
            $investment->amount = Input::get('amount');
            $investment->value = Input::get('value');
            $investment->status = Input::get('status');
            
            $res = $investment->save();
        }

        if($res){
            $message = 'The Investment is edited Successfully';
        }else{
            $message = 'The Investment cannot be edited';
        }

        return Redirect::route('admin.company.investments', $investment->company_id)
                ->with('action', 'edit')
                ->with('result', $res)
                ->with('message', $message);
    }
}