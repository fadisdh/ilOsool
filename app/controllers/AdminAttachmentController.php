<?php

class AdminAttachmentController extends BaseController {

    public function index($company_id)
    {

        $col = Input::get('col');
        $rows = Input::get('rows');

        $q = Attachment::select(array('*'))->where('company_id', '=', $company_id);

        if(Input::get('search')){
            $q = $q ->where(function($q){
                $q  ->orWhere('name','LIKE', '%' . Input::get('search') . '%')
                    ->orWhere('id','=', Input::get('search'))
                    ->orWhere('type','LIKE','%' . Input::get('search') . '%');
            });
        }

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
        	$attachments = $q->paginate($rows);
        }else{
        	$attachments = $q->paginate(Config::get('ilosool.rows_default'));
        }

        //get company name
        $company = Company::find($company_id);

        return View::make('admin.company.attachment.index')->with( array('attachments' => $attachments,'company' => $company));
    }

    public function add($company_id){

        $attachment = Attachment::find($company_id);

        //get company name
        $company = Company::find($company_id);
        $company_name = $company->name;

        return View::make('admin.company.attachment.add', array('company_name' => $company_name, 'company_id' => $company_id));
    }

    public function edit($company_id,$id){
        
        $attachment = Attachment::find($id);

        //get company name
        $company = Company::find($company_id);
        $company_name = $company->name;

        return View::make('admin.company.attachment.edit', array('attachment' => $attachment, 'company_name' => $company_name));
    }

    public function delete($company_id, $id){

        $attachment = Attachment::find($id);
        
        $res = $attachment->delete();

        if($res){
            $message = 'The Attachment <strong>' . $attachment->name . '</strong> is deleted Successfully';
        }else{
            $message = 'The Attachment <strong>' . $attachment->name . '</strong> can not be deleted';
        }

        return Redirect::route('admin.company.attachments', $attachment->company_id)
                ->with('action', 'delete')
                ->with('result', $res)
                ->with('message', $message);
    }

    public function add_post($company_id){

        $user = Auth::user();

        //validate company
        $validator = Attachment::validate(Input::all());
        $file = Input::file('file');

        if ($validator->fails())
        {
            return Redirect::route('admin.company.attachment.add', array($company_id))->withErrors($validator)->withInput();
        }

        $attachment = new Attachment();

        if($attachment->validate(Input::all())){
            $attachment->name = Input::get('name');
            $attachment->access = Input::get('access');
            $attachment->company_id = $company_id;

            if($file){
                $attachment->url = upload($file, Attachment::getDir($company_id));
                $attachment->type = $file->getClientOriginalExtension();
            }

            $res = $attachment->save();
        }

        if($res){
            $message = 'The Attachment <strong>' . $attachment->name . '</strong> is added Successfully';
        }else{
            $message = 'The Attachment <strong>' . $attachment->name . '</strong> can not be added';
        }

        return Redirect::route('admin.company.attachments', $attachment->company_id)
                ->with('action', 'add')
                ->with('result', $res)
                ->with('message', $message);
    }

    public function edit_post($company_id,$id){

        $user = Auth::user();

        //validate company
        $validator = Attachment::validate(Input::all());

        if ($validator->fails())
        {
            return Redirect::route('admin.company.attachment.edit', array($company_id, $id))->withErrors($validator)->withInput();
        }

        //Company info
        $attachment = Attachment::find($id);

        if($attachment->validate(Input::all())){
           
            $attachment->name = Input::get('name');
            $attachment->access = Input::get('access');

            $file = Input::file('file');

            if($file){
                $attachment->url = upload($file, Attachment::getDir($company_id));
                $attachment->type = $file->getClientOriginalExtension();
            }
            
            $res = $attachment->save();
        }

        if($res){
            $message = 'The Attachment <strong>' . $attachment->name . '</strong> is edited Successfully';
        }else{
            $message = 'The Attachment <strong>' . $attachment->name . '</strong> can not be edited';
        }

        return Redirect::route('admin.company.attachments', $attachment->company_id)
                ->with('action', 'edit')
                ->with('result', $res)
                ->with('message', $message);
    }

}