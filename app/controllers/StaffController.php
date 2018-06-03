<?php

class StaffController extends BaseController {

	public function staff($companyId){
		if(Auth::user()->rule_id != 3){
			$company = Company::find($companyId);
			return View::make('company.staff.staff')->with('company', $company);
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function staffAdd($companyId){
		if(Auth::user()->rule_id != 3){
			$company = Company::find($companyId);
			if(isOwner($company->user_id) ){
				return View::make('company.staff.add')->with('company_id', $companyId);
			}else{
				return Redirect::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}

	}

	public function staffAddPost($companyId){

		if(Auth::user()->rule_id != 3){
			$company = Company::find($companyId);
			if(isOwner($company->user_id) ){
				$validator = Staff::validate(Input::all());

		        if ($validator->fails())
		        {
		            return Redirect::route('staff.add', $companyId)->withErrors($validator)->withInput();
		        }

		        //Company info
		        $staff = new Staff();

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

		            $staff->company_id = $companyId;

		            $res = $staff->save();
		        }

		        if($res){
		        	if(getLocale() == 'ar'){
		 				$message = sprintf(trans('general.messages.staff_success'), 'إضافة', $staff->name);
		 			}else{
		 				$message = sprintf(trans('general.messages.staff_success'), $staff->name, 'added');	
		 			}
		        }else{
		        	if(getLocale() == 'ar'){
		 				$message = sprintf(trans('general.messages.staff_unsuccess'), 'إضافة', $staff->name);
		 			}else{
		 				$message = sprintf(trans('general.messages.staff_unsuccess'), $staff->name, 'added');	
		 			}
		        }

		        if(Input::get('add_staff')){
		        	return View::make('company.staff.add')->with('company_id', $companyId);
		        }elseif(Input::get('add_attachment')){
		        	return View::make('company.attachments.add')->with('company_id', $companyId);
		        }else{
		        	return Redirect::route('staff', $staff->company_id)
		                ->with('action', 'add')
		                ->with('result', $res)
		                ->with('message', $message);
		        }
		        
		    }else{
				return Redirect::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function staffEdit($companyId, $staffId){
		if(Auth::user()->rule_id != 3){
			$company = Company::find($companyId);
			if(isOwner($company->user_id) ){
				$staff = Staff::find($staffId);
				return View::make('company.staff.edit')->with('staff', $staff)->with('company_id', $companyId);
			}else{
				return Redirect::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function staffEditPost($companyId, $staffId){
		if(Auth::user()->rule_id != 3){
			$company = Company::find($companyId);
			if(isOwner($company->user_id) ){
				$validator = Staff::validate(Input::all());

		        if ($validator->fails())
		        {
		            return Redirect::route('staff.edit', array($companyId, $staffId))->withErrors($validator)->withInput();
		        }

		        //Company info
		        $staff = Staff::find($staffId);

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
		            if(getLocale() == 'ar'){
		 				$message = sprintf(trans('general.messages.staff_success'), 'تعديل', $staff->name);
		 			}else{
		 				$message = sprintf(trans('general.messages.staff_success'), $staff->name, 'edited');	
		 			}
		        }else{
		        	if(getLocale() == 'ar'){
		 				$message = sprintf(trans('general.messages.staff_unsuccess'), 'تعديل', $staff->name);
		 			}else{
		 				$message = sprintf(trans('general.messages.staff_unsuccess'), $staff->name, 'edited');	
		 			}
		        }

		        return Redirect::route('staff', $staff->company_id)
		                ->with('action', 'edit')
		                ->with('result', $res)
		                ->with('message', $message);
		    }else{
				return Redirect::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	public function staffDelete($staffId){
		if(Auth::user()->rule_id != 3){
			$staff = Staff::find($staffId);
			$company = Company::find($staff->company_id);
			if(isOwner($company->user_id) ){

				$res = $staff->delete();

				if($res){
					if(getLocale() == 'ar'){
		 				$message = sprintf(trans('general.messages.staff_success'), 'حذف', $staff->name);
		 			}else{
		 				$message = sprintf(trans('general.messages.staff_success'), $staff->name, 'deleted');	
		 			}
		        }else{
		        	if(getLocale() == 'ar'){
		 				$message = sprintf(trans('general.messages.staff_unsuccess'), 'حذف', $staff->name);
		 			}else{
		 				$message = sprintf(trans('general.messages.staff_unsuccess'), $staff->name, 'deleted');	
		 			}
				}

				return Redirect::route('staff', $staff->company_id)
						->with('action', 'delete')
						->with('result', $res)
						->with('message', $message);
			}else{
				return Redirect::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', trans('general.messages.permission_denied'));
		}
	}

	// public function staff_post($companyId){
		
	// 	$company = Company::find($companyId);
	// 	$staff = Staff::where('company_id', '=', $companyId)->get();
	// 	$validation = array();
	// 	$validationNew = array();
	// 	$errors = array();
	// 	$errorsNew = array();
	// 	$makeView = true;
	// 	$res = false;
		
	// 	if(isOwner($company->user_id)){
	// 		$oldstaff = Input::get('staff', array());
	// 		$file = Input::file('staff', array());
			
	// 		foreach ($staff as $s) {
	// 			if(isset($oldstaff[$s->id])){
	// 				$error = false;
	// 				$validation[$s->id] = Staff::validate(array(
	// 					'name' =>  $oldstaff[$s->id]['name'],
	// 					'type' => $oldstaff[$s->id]['type'],
	// 					'position' => $oldstaff[$s->id]['position'],
	// 					'image' => $file[$s->id]['image'],
	// 				));

	// 				if($validation[$s->id]->fails()){
	// 					$errors[$s->id] = array('id' => $s->id, 'message' => $validation[$s->id]->getMessageBag() );
	// 					$error = true;
	// 					$makeView = false;
	// 				}

	// 				$s->name = $oldstaff[$s->id]['name'];
	// 				$s->position = $oldstaff[$s->id]['position'];
	// 				$s->type = $oldstaff[$s->id]['type'];
	// 				$s->description = $oldstaff[$s->id]['description'];
					
	// 				if($file[$s->id]['image']){
	// 					$destinationPath = sprintf(Config::get('ilosool.uploads.staff_dir'), $companyId);
	// 			        $filename = $file[$s->id]['image']->getClientOriginalName();
	// 			        $uploadSuccess = $file[$s->id]['image']->move($destinationPath, $filename);
			    	
	// 			        if($uploadSuccess) {
	// 		        		$s->image = $filename;
	// 			        }
	// 			    }
	// 			    if( $error == false)
	// 					$res = $s->save();
	// 			}else{
	// 				$s->delete();
	// 			}
	// 		}

	// 		$newstaff = Input::get('newstaff', array());
	// 		$files = Input::file('newstaff', array());

	// 		$i = 0;
	// 		foreach ($newstaff as $nstaff) {
	// 			// return var_dump($nstaff);
	// 			if(isset($nstaff['name']) && $nstaff['name']){
	// 				$errorNew = false;
	// 				$validationNew[$i] = Staff::validate(array(
	// 					'name' =>  $nstaff['name'],
	// 					'type' => $nstaff['type'],
	// 					'position' => $nstaff['position'],
	// 					'image' => $files[$i]['image']
	// 				));

	// 				if($validationNew[$i]->fails()){
	// 					$errorsNew[$i] = array('id' => $i, 'message' => $validationNew[$i]->getMessageBag() );
	// 					$errorNew = true;
	// 					$makeView = false;
	// 				}

	// 				if($errorNew == false){
	// 					$s = new Staff();
	// 					$s->name = $nstaff['name'];
	// 					$s->position = $nstaff['position'];
	// 					$s->type = $nstaff['type'];
	// 					$s->description = $nstaff['description'];
						
	// 					if($files[$i]['image']){
	// 						$destinationPath = sprintf(Config::get('ilosool.uploads.staff_dir'), $companyId);
	// 				        $filename = $files[$i]['image']->getClientOriginalName();
	// 				        $uploadSuccess = $files[$i]['image']->move($destinationPath, $filename);
				    	
	// 				        if($uploadSuccess) {
	// 			        		$s->image = $filename;
	// 				        }
	// 				    }
	// 					$s->company_id = $companyId;
	// 					$res = $s->save();
	// 				}
	// 				$i++;
	// 			}
	// 		}
	// 	}

	// 	if($res){
	// 		$message = 'Saved successfully';
	// 	}else{
	// 		$message = 'Invalid input';
	// 	}

	// 	if($makeView == false){
	// 		return Redirect::route('profile.companies')
	// 			->with('action', 'add')
	// 			->with('result', $res)
	// 			->with('message', $message);
	// 	}
	// 	else{
	// 		return Redirect::route('profile.companies')
	// 			->with('action', 'add')
	// 			->with('result', $res)
	// 			->with('message', $message);
	// 	}
	// }
}