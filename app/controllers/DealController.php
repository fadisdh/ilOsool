<?php

class DealController extends BaseController {

    public function index($id)
    {

    	// Grab all the Posts
        $deals = Deal::all();

        $search = Input::get('search');
        $col = Input::get('col');
        $rows = Input::get('rows');

        $q = Deal::select(array('*'))->where('company_id', '=', $id);

        if($search){
        	$q = $q ->where('title','LIKE', '%' . $search . '%')
        			->orWhere('id','=', $search)
				    ->orWhere('brief','LIKE','%' . $search . '%'); 
        }

        if($col){
        	$order = (Input::get('order')) ? Input::get('order') : 'ASC';
        	$q = $q->orderBy($col, $order);
        }

        if(isset($rows)){
        	$deals = $q->paginate($rows);
        }else{
        	$deals = $q->paginate(Config::get('ilosool.rows_default'));
        }       

        return View::make('deal.index')->with(array('deals' => $deals, 'id' => $id));
    }

    public function view($companyid, $id){

        $deal = Deal::find($id);

        return View::make('deal.view')->with('deal', $deal);

    }

	public function add($id)
	{	
		$company = Company::find($id);

		return View::make('deal.add')->with('id', $company->id);
	}

	public function edit($companyid, $id){
		
		$company = Company::find($companyid);
		$deal = Deal::find($id);

		return View::make('deal.edit', array(
			'company' => $company,
			'deal' => $deal
		));
	}

	public function delete($companyid, $id){

		$deal = Deal::find($id);
		$res = $deal->delete();

		if($res){
            $message = 'The Deal <strong>' . $deal->title . '</strong> is deleted Successfully';
        }else{
            $message = 'The Deal <strong>' . $deal->title . '</strong> can not be deleted';
        }

        return Redirect::route('deals', $companyid)
                ->with('action', 'delete')
                ->with('result', $res)
                ->with('message', $message);
    }
    
	public function add_post($id)
	{
		$user = Auth::user();
		$company = Company::find($id);

		//validate deal
	    $validator = Deal::validate(Input::all());

	    if ($validator->fails())
	    {
	        return Redirect::route('deal.add',$company->id)->withErrors($validator)->withInput();
	    }

	    //add Deal
		$deal = new Deal();
		$deal->title = Input::get('title');
	    $deal->description = Input::get('description');
	    $deal->brief = Input::get('brief');
	    $deal->video = Input::get('video');
	    $deal->startdate = Input::get('startdate');
	    $deal->duration = Input::get('duration');
	    $deal->target = Input::get('target');
	    $deal->tags = Input::get('tags');
		$deal->status = can('deal.editstatus') && Input::get('status') ? Input::get('status') : Config::get('ilosool.default_deal_status');
	    $deal->type = Input::get('type');
	    $deal->geo_interest = Input::get('geo_interest');
	    $deal->investment_type = Input::get('investment_type');
	    $deal->deal_size = Input::get('deal_size');

    	$file = Input::file('img');

	    if(!is_null($file)){
			$destinationPath = sprintf(Config::get('ilosool.uploads.deals_dir'), $company->id);
	        $filename = $file->getClientOriginalName();
	        $uploadSuccess = $file->move($destinationPath, $filename);
			
	        if($uploadSuccess) {
			    $deal->img = $filename;
			}
		}

	    $deal->company_id = $company->id;
		$res = $deal->save();

		if($res){
            $message = 'The Deal <strong>' . $deal->title . '</strong> is created Successfully';
        }else{
            $message = 'The Deal <strong>' . $deal->title . '</strong> can not be created';
        }

        return Redirect::route('deals', $company->id)
                ->with('action', 'add')
                ->with('result', $res)
                ->with('message', $message);

	}

	
	public function edit_post($companyid, $id)
	{
		$user = Auth::user();
		$deal = Deal::find($id);

		//validate deal
	    $validator = Deal::validate(Input::all());

	    if ($validator->fails())
	    {
	        return Redirect::route('deal.edit',  array('companyid' => $companyid, 'id' => $id) )->withErrors($validator)->withInput();
	    }

	    //edit Deal
	    $deal->title = Input::get('title');
	    $deal->description = Input::get('description');
	    $deal->brief = Input::get('brief');
	    $deal->video = Input::get('video');
	    $deal->startdate = Input::get('startdate');
	    $deal->duration = Input::get('duration');
	    $deal->target = Input::get('target');
	    $deal->tags = Input::get('tags');
	    if(can('deal.editstatus') && Input::get('status')){
	    	$deal->status = Input::get('status');
		}
	    $deal->type = Input::get('type');
	    $deal->geo_interest = Input::get('geo_interest');
	    $deal->investment_type = Input::get('investment_type');
	    $deal->deal_size = Input::get('deal_size');

    	$file = Input::file('img');
	    if(!is_null($file)){
			$destinationPath = Deal::getDir($deal->company->id);
	        $filename = $file->getClientOriginalName();
	        $uploadSuccess = $file->move($destinationPath, $filename);
			
	        if($uploadSuccess) {
			    $deal->img = $filename;
			}
		}

		$res = $deal->save();

		if($res){
            $message = 'The Deal <strong>' . $deal->title . '</strong> is edited Successfully';
        }else{
            $message = 'The Deal <strong>' . $deal->title . '</strong> can not be edited';
        }

        return Redirect::route('deals', $companyid)
                ->with('action', 'edit')
                ->with('result', $res)
                ->with('message', $message);
	}
}

