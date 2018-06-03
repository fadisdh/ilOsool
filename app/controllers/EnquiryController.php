<?php

class EnquiryController extends BaseController {

    public function view(){
        return View::make('enquiry.contact');
    }

    public function viewEarlyAccess(){
        $page = Page::where('slug', 'early-access')->first();
        return View::make('enquiry.earlyaccess')->with('page', $page);
    }

    public function submit(){
        $data = Input::get('enquiry', array());
        $validator = Enquiry::validate($data, Input::get('_type'));

        if ($validator->fails()){
            return Redirect::route(Input::get('_redirect'))->withErrors($validator)->withInput();
        }

        $enquiry = new Enquiry();

        $enquiry->content = '';
        foreach($data as $key => $val){
            $enquiry->content .= $key . ': ' . $val . '<br> ';
        }

        $enquiry->to = Config::get('ilosool.email');
        $enquiry->title = Input::get('_subject');
        $enquiry->type = Input::get('_type');

        $res = $enquiry->save();

        Mail::send('emails.enquiry.default', array('enquiry' => $enquiry), function($message) use ($enquiry)
        {
            $message->from('info@ilosool.com', 'ilOsool')->subject($enquiry->title);
            $message->to('f.saadeh@espira.jo', 'ilOsool')->subject($enquiry->title);
        });

        if($res){
            $message = 'Your message has been sent Successfully';
        }else{
            $message = 'There has been an error!';
        }

        return Redirect::route(Input::get('_redirect'))
                ->with('action', 'submit')
                ->with('result', $res)
                ->with('message', $message);
    }
}