<?php

class RequestController extends BaseController {

  public function requested_deals(){
      $asset_class = Input::get('asset_class');

      $q = RequestDeal::select(array('*'));
      
      if(Input::get('search_requests')){
          $q = $q ->where(function($q){
            $q  ->orWhere('asset_class','LIKE', '%' . Input::get('search_requests') . '%')
                ->orWhere('geo_interests','LIKE', '%' . Input::get('search_requests') . '%')
                ->orWhere('investment_stage','LIKE', '%' . Input::get('search_requests') . '%')
                ->orWhere('investment_type','LIKE', '%' . Input::get('search_requests') . '%')
                ->orWhere('investment_style','LIKE', '%' . Input::get('search_requests') . '%')
                ->orWhere('investment_sector','LIKE', '%' . Input::get('search_requests') . '%');
          });
        }

    if($asset_class == 'pe'){
      $q->where('asset_class','=', 'pe' );
    }

    if($asset_class == 're'){
      $q->where('asset_class','=', 're' );
    }

    if($asset_class == 'vc'){
      $q->where('asset_class','=', 'vc' );
    }

    $q->where('status', '=', 1);
    $q = $q->orderBy('id', 'desc');

    $requests = $q->paginate(12);

    return View::make('request.requests')
          ->with('requests', $requests)
          ->with('asset_class', $asset_class)
          ->with('topmenu', 'requests');
    }

    public function view($id){
      $request = RequestDeal::find($id);
      return View::make('request.view')
                  ->with('request', $request)
                  ->with('topmenu', 'requests');
    }

    public function request_deal(){
      return View::make('request.request')
                  ->with('topmenu', 'request-deal');
    }

    public function request_deal_add($type) {
      $request = new RequestDeal();
      if($type == 're' || $type == 'pe' || $type == 'vc'){
        return View::make('request.request_form')
                    ->with('type', $type)
                    ->with('request', $request);
      }else{
        return View::make('common.error')->with('msg', 'This Page does not exists');
      }
    }

    public function request_deal_edit($id){
      $request = RequestDeal::find($id);
      if($request->asset_class == 're' || $request->asset_class == 'pe' || $request->asset_class == 'vc'){
        return View::make('request.request_form')
                    ->with('type', $request->asset_class)
                    ->with('request', $request);
      }else{
        return View::make('common.error')->with('msg', 'This Page does not exists');
      }
    }

    public function request_deal_post($id, $type){

      $validator = RequestDeal::validate(Input::all());

      if ($validator->fails())
      {
        if($id == 0)
          return Redirect::route('request.deal.add', $type)->withErrors($validator)->withInput();
        else
          return Redirect::route('request.deal.edit', $id)->withErrors($validator)->withInput();
      }

      if($id == 0){
        $request = new RequestDeal();
        $request->user_id = Auth::user()->id;
        $request->asset_class = $type;
      }
      else{
        $request = RequestDeal::find($id);
      }

      if(Input::get('geo_interests')) $request->geo_interests = Input::get('geo_interests');
      if(Input::get('investment_sector')) $request->investment_sector = Input::get('investment_sector');
      if(Input::get('investment_stage')) $request->investment_stage = Input::get('investment_stage');
      if(Input::get('investment_type')) $request->investment_type = Input::get('investment_type');
      if(Input::get('investment_style')) $request->investment_style = Input::get('investment_style');
      if(Input::get('deal_size')) $request->deal_size = Input::get('deal_size');
      if(Input::get('growth_rate')) $request->growth_rate = Input::get('growth_rate');
      if(Input::get('revenue')) $request->revenue = Input::get('revenue');
      if(Input::get('revenue_suffix')) $request->revenue_suffix = Input::get('revenue_suffix');
      if(Input::get('description')) $request->description = Input::get('description');
      if(Input::get('brief')) $request->brief = Input::get('brief');
      if(Input::get('price_earning')) $request->price_earning = Input::get('price_earning');
      if(Input::get('yield')) $request->yield = Input::get('yield');
      $request->status = 0;

      $res = $request->save();

      //Send notification to admin
      $admin_ntf = new AdminNotification();
      $admin_ntf->reference_id = Auth::user()->id;
      $admin_ntf->request = 'request_deal';
      $admin_ntf->title = sprintf(Config::get('ilosool.messages.request_deal'), Auth::user()->firstname . ' ' . Auth::user()->lastname);
      $admin_ntf->description = '<a href="' . URL::route('admin.request.view', $request->id) . '" target="_blank">View Requested Deal</a>';
      $admin_ntf->save();

      //Job
      $url = URL::route('admin.notifications');
      $title =  $admin_ntf->title;
      $description = $admin_ntf->description;
      Job::adminNotification('notification+email', 'request_deal', $description, $url, $title);

      $message = "Your Request has been sent for approval.";
      if($id == 0){
        return Redirect::route('requested.deals')
            ->with('action', 'create')
            ->with('result', $res)
            ->with('message', $message);  
      }else{
        return Redirect::route('profile.requests')
            ->with('action', 'create')
            ->with('result', $res)
            ->with('message', $message);
      }
      
    }
}