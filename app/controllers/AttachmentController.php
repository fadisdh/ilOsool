<?php

class AttachmentController extends BaseController {

	public function attachments($companyId){
		if(Auth::user()->rule_id != 3){
			$company = Company::find($companyId);
			return View::make('company.attachments.attachments')->with('company', $company);
		}else{
			return View::make('common.error')->with('msg', 'Sorry! You dont have permissions to view this page.');
		}
	}

	public function attachmentAdd($company_id){
		if(Auth::user()->rule_id != 3){
			$company = Company::find($company_id);
			if(isOwner($company->user_id) ){
				return View::make('company.attachments.add')->with('company_id', $company_id);
			}else{
				return Redirect::route('user.home');	
			}
		}else{
			return View::make('common.error')->with('msg', 'Sorry! You dont have permissions to view this page.');
		}
	}

	public function attachmentAddPost($companyId){
		if(Auth::user()->rule_id != 3){
			$company = Company::find($companyId);
			if(isOwner($company->user_id) ){
				$attachment = new Attachment();

				$validator = Attachment::validate(Input::all());

				if($validator->fails()){
					return Redirect::route('attachment.add', $companyId)->withErrors($validator)->withInput();
				}

				$attachment->name = Input::get('name');
				$attachment->access = Input::get('access');
				$file = Input::file('file');

		        if($file){
		        	$attachment->url = upload($file, Attachment::getDir($companyId));
		            $attachment->type = $file->getClientOriginalExtension();
		        }

		        $attachment->company_id = $companyId;

				$res = $attachment->save();

				if($res){
					$message = 'Saved successfully';
				}else{
					$message = 'Invalid Input';
				}

				
				if(Input::get('add_staff')){
		        	return View::make('company.staff.add')->with('company_id', $companyId);
		        }elseif(Input::get('add_attachment')){
		        	return View::make('company.attachments.add')->with('company_id', $companyId);
		        }else{
					return Redirect::route('attachments', $companyId)
						->with('company', $company)
						->with('action', 'edit')
						->with('result', $res)
						->with('message', $message);
				}
			}else{
				return Redirect::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', 'Sorry! You dont have permissions to view this page.');
		}
	}

	public function attachmentEdit($attachmentId){
		if(Auth::user()->rule_id != 3){
			$attachment = Attachment::find($attachmentId);

			$company = Company::find($attachment->company_id);
			if(isOwner($company->user_id) ){
				
				$attachment = Attachment::find($attachmentId);

				return View::make('company.attachments.edit')->with('attachment', $attachment);
			}else{
				return Redirect::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', 'Sorry! You dont have permissions to view this page.');
		}

	}

	public function attachmentEditPost($attachmentId){
		if(Auth::user()->rule_id != 3){
			$attachment = Attachment::find($attachmentId);

			$company = Company::find($attachment->company_id);
			if(isOwner($company->user_id) ){
				$file = Input::file('file');

				if($file){
					$validator = Attachment::validate(Input::all());
				}else{
					$validator = Attachment::validateEdit(Input::all());
				}

				if($validator->fails()){
					return Redirect::route('attachment.edit', $attachment->id)->withErrors($validator)->withInput();
				}

				$attachment->name = Input::get('name');
				$attachment->access = Input::get('access');

			    if($file){
		        	$attachment->url = upload($file, Attachment::getDir($attachment->company_id));
		            $attachment->type = $file->getClientOriginalExtension();
		        }

				$res = $attachment->save();

				if($res){
					$message = 'The Attachment <strong>' . $attachment->name . '</strong> is edited Successfully';
				}else{
					$message = 'The Attachment <strong>' . $attachment->name . '</strong> can not be edited';
				}

				

				return Redirect::route('attachments', $attachment->company_id)
					->with('company', $company)
					->with('action', 'edit')
					->with('result', $res)
					->with('message', $message);
			}else{
				return Redirect::route('user.home');			
			}
		}else{
			return View::make('common.error')->with('msg', 'Sorry! You dont have permissions to view this page.');
		}
	}

	public function attachmentDelete($attachmentId){
		if(Auth::user()->rule_id != 3){
			$attachment = Attachment::find($attachmentId);
			$company = Company::find($attachment->company_id);
				if(isOwner($company->user_id) ){
				$res = $attachment->delete();

				if($res){
					$message = 'The Attachment <strong>' . $attachment->name . '</strong> is deleted Successfully';
				}else{
					$message = 'The Attachment <strong>' . $attachment->name . '</strong> can not be deleted';
				}

				return Redirect::route('attachments', $attachment->company_id)
						->with('action', 'delete')
						->with('result', $res)
						->with('message', $message);
			}else{
				return Redirect::route('user.home');
			}
		}else{
			return View::make('common.error')->with('msg', 'Sorry! You dont have permissions to view this page.');
		}
	}

	public function attachmentDownload($company_id,$id){

		$notFoundTitle = "File not found";
		$notFound = "The provided file path is not valid.";
		$noPerrmissionTitle = "Permission Denied";
		$noPerrmission = "You dont have permissions to download this file.";

		$company = Company::find($company_id);

        $attachment = Attachment::find($id);

        if($attachment){
	        if($attachment->access == 'private'){

	        	$granted = CompanyPermissions::where('company_id', '=', $company_id)
	        								->where('user_id', '=', Auth::user()->id)
	        								->where('status', '=', 'accepted')
	        								->first();
	        							
	        	if($granted || isOwner($company->user_id)) {

	        		$filePath = public_path('uploads/companies/' . $company_id .'/attachments/' . $attachment->url);

			        if(file_exists($filePath)) {

			            $fileName = basename($filePath);
			            $fileSize = filesize($filePath);

			            // Output headers.
			            header("Cache-Control: private");
			            header("Content-Type: application/stream");
			            header("Content-Length: ".$fileSize);
			            header("Content-Disposition: attachment; filename=".$fileName);

			            // Output file.
			            readfile ($filePath);

			            exit();

			        }else {
			             return View::make('common.error')->with('msg', $notFound)->with('title', $notFoundTitle);
			        }
	        	}else {
	        		return View::make('common.error')->with('msg', $noPerrmission)->with('title', $noPerrmissionTitle);
	        	}
	        }else {
	        	$filePath = public_path('uploads/companies/' . $company_id .'/attachments/' . $attachment->url);

			        if(file_exists($filePath)) {
			            $fileName = basename($filePath);
			            $fileSize = filesize($filePath);

			            // Output headers.
			            header("Cache-Control: private");
			            header("Content-Type: application/stream");
			            header("Content-Length: ".$fileSize);
			            header("Content-Disposition: attachment; filename=".$fileName);

			            // Output file.
			            readfile ($filePath);                   
			            exit();
			        }
			        else {
			             return View::make('common.error')->with('msg', $notFound)->with('title', $notFoundTitle);
			        }
	        }
       	}else {
		        return View::make('common.error')->with('msg', $notFound)->with('title', $notFoundTitle);
		}       	
    }
}