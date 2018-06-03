<?php

class AdminOptionsController extends BaseController {


    public function index()
    {
    	$options = Option::getAllByGroup();

    	return View::make('admin.options.index')->with('options', $options);
    }

    public function edit_options(){
    	
    	$options = Option::all();

    	foreach($options as $option){
			Option::where('name', '=', $option->name)->update(array('value' => Input::get($option->key)));
		}
		
		$message = 'Options edited Successfully';
		
		return Redirect::route('admin.options')
				->with('action', 'edit')
                ->with('result', true)
                ->with('message', $message);	       
	}

}