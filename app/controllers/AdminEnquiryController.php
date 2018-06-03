<?php

class AdminEnquiryController extends BaseController {


    public function index()
    {
        $col = Input::get('col');
        $rows = Input::get('rows');

        $q = Enquiry::select(array('*'));

        if(Input::get('search')){
            $q = $q ->where(function($q){
                $q  ->orWhere('title','LIKE', '%' . Input::get('search') . '%')
                    ->orWhere('id','=', Input::get('search'))
                    ->orWhere('from','LIKE','%' . Input::get('search') . '%')
                    ->orWhere('to','LIKE','%' . Input::get('search') . '%')
                    ->orWhere('type','LIKE','%' . Input::get('search') . '%')
                    ->orWhere('status','LIKE','%' . Input::get('search') . '%');
            });
        }

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
            $enquiries = $q->paginate($rows);
        }else{
            $enquiries = $q->paginate(Config::get('ilosool.rows_default'));
        }

	    return View::make('admin.enquiry.index')->with('enquiries', $enquiries);
	   
    }

    public function delete($id){

		$enquiry = Enquiry::find($id);
		$res = $enquiry->delete();

		if($res){
			$message = 'The Enquiry <strong>' . $enquiry->slug . '</strong> is deleted Successfully';
		}else{
			$message = 'The Enquiry <strong>' . $enquiry->slug . '</strong> can not be deleted';
		}

		return Redirect::route('admin.enquiries')
				->with('action', 'delete')
				->with('result', $res)
				->with('message', $message);
	}

    public function view($id){

        $enquiry = Enquiry::find($id);

        return View::make('admin.enquiry.view')->with('enquiry', $enquiry);

    }
}