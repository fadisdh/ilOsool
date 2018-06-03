<?php

class AdminStaffController extends BaseController {

	public function index($company_id){

        $col = Input::get('col');
        $rows = Input::get('rows');
        $type = Input::get('type');

        $q = Staff::select(array('*'))->where('company_id', '=', $company_id);

        if(Input::get('search')){
            $q = $q ->where(function($q){
                $q  ->orWhere('name', 'LIKE', '%' . Input::get('search') . '%')
                    ->orWhere('id','=', Input::get('search'))
                    ->orWhere('type','LIKE', '%' . Input::get('search') . '%');
            });
        }

        if($col){
            $order = (Input::get('order')) ? Input::get('order') : 'ASC';
            $q = $q->orderBy($col, $order);
        }

        $staff = array();
        if(isset($rows)){
            $staff = $q->paginate($rows);
        }else{
            $staff = $q->paginate(Config::get('ilosool.rows_default'));
        }

        //get company name
        $company = Company::find($company_id);

        // Show the page
	    return View::make('admin.company.staff.index')->with('staff', $staff)->with('company', $company);
    }

    public function view($company_id,$id){

        $staff = Staff::find($id);

        //get company name
        $company = Company::find($company_id);
        $company_name = $company->name;

        return View::make('admin.company.staff.view')->with('staff', $staff)->with('company_name', $company_name);
    }

    public function add($company_id){

        $company = Company::find($company_id);

        return View::make('admin.company.staff.add')->with('company',$company);
    }

    public function edit($company_id,$id){
        
        $staff = Staff::find($id);

        //get company name
        $company = Company::find($company_id);
        $company_name = $company->name;

        return View::make('admin.company.staff.edit', array('staff' => $staff, 'company_name' => $company_name));
    }

    public function delete($company_id, $id){

        $staff = Staff::find($id);

        $res = $staff->delete();

        if($res){
            $message = 'The Staff Memeber <strong>' . $staff->name . '</strong> is deleted Successfully';
        }else{
            $message = 'The Staff Memeber <strong>' . $staff->name . '</strong> can not be deleted';
        }

        return Redirect::route('admin.company.staff', $staff->company_id)
                ->with('action', 'delete')
                ->with('result', $res)
                ->with('message', $message);
    }

    public function add_post($company_id){

        $user = Auth::user();

        //validate company
        $validator = Staff::validate(Input::all());

        if ($validator->fails())
        {
            return Redirect::route('admin.company.staff.edit', array($company_id))->withErrors($validator)->withInput();
        }

        //Company info
        $staff = new Staff();

        if($staff->validate(Input::all())){
            $staff->company_id = $company_id;
            $staff->name = Input::get('name');
            $staff->position = Input::get('position');
            $staff->description = Input::get('description');
            $staff->type = Input::get('type');
            $staff->access = Input::get('access');
            
            $file = Input::file('image');
            
            if($file){
                $staff->image = upload($file, Staff::getDir($companyId));
            }

            $res = $staff->save();
        }

        if($res){
            $message = 'The Staff Member <strong>' . $staff->name . '</strong> is edited Successfully';
        }else{
            $message = 'The Staff Member <strong>' . $staff->name . '</strong> can not be edited';
        }

        return Redirect::route('admin.company.staff', $staff->company_id)
                ->with('action', 'edit')
                ->with('result', $res)
                ->with('message', $message);
    }

    public function edit_post($company_id,$id){

        $user = Auth::user();

        //validate company
        $validator = Staff::validate(Input::all());

        if ($validator->fails())
        {
            return Redirect::route('admin.company.staff.edit', array($company_id, $id))->withErrors($validator)->withInput();
        }

        //Company info
        $staff = Staff::find($id);

        if($staff->validate(Input::all())){
            $staff->name = Input::get('name');
            $staff->position = Input::get('position');
            $staff->description = Input::get('description');
            $staff->type = Input::get('type');
            $staff->access = Input::get('access');
            
            $file = Input::file('image');

            if($file){
                $staff->image = upload($file, Staff::getDir($companyId));
            }

            $res = $staff->save();
        }

        if($res){
            $message = 'The Staff Member <strong>' . $staff->name . '</strong> is edited Successfully';
        }else{
            $message = 'The Staff Member <strong>' . $staff->name . '</strong> can not be edited';
        }

        return Redirect::route('admin.company.staff', $staff->company_id)
                ->with('action', 'edit')
                ->with('result', $res)
                ->with('message', $message);
    }
}

