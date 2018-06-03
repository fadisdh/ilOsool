<?php

class RemindersController extends Controller {

  /**
   * Display the password reminder view.
   *
   * @return Response
   */
  public function getRemind()
  {
    return View::make('common.passreminder');
  }

  /**
   * Handle a POST request to remind a user of their password.
   *
   * @return Response
   */
  public function postRemind()
  {
    $user = User::where('email', '=', Input::get('email'))->first();

    if (!filter_var(Input::get('email'), FILTER_VALIDATE_EMAIL)) {
      $message = trans('general.messages.valid_email_id');
      return json_encode(array('message' => (string )View::make('common.passreminder')->with('error', 'error')->with('message', $message)));
    }elseif($user){
      Password::remind(Input::only('email'), function($message)
      {
          $message->from('info@ilosool.com', 'ilOsool');
          $message->subject('Password Reset');
      });
      $message = trans('general.messages.email_password_sent');
      return json_encode(array('message' => (string )View::make('common.popup_alert')->with('message', $message)));
    }else{
      $message =  trans('general.messages.no_user');
      return json_encode(array('message' => (string )View::make('common.passreminder')->with('error', 'error')->with('message', $message)));
    }
    
  }

  /**
   * Display the password reset view for the given token.
   *
   * @param  string  $token
   * @return Response
   */
  public function getReset($token = null)
  {
    if (is_null($token)) App::abort(404);

    return View::make('common.passreset')->with('token', $token);
  }

  /**
   * Handle a POST request to reset a user's password.
   *
   * @return Response
   */
  public function postReset(){
    $validator = User::validetPassReset(Input::all());

    if ($validator->fails()){
      return Redirect::route('passreset', Input::get('token'))->withErrors($validator)->withInput();
    }else{
        $user = User::leftJoin('password_reminders', 'users.email', '=', 'password_reminders.email')
                ->where('users.email', '=', Input::get('email'))
                ->where('token', '=', Input::get('token'))
                ->first();

        if($user){
           $user->password = Hash::make(Input::get('password'));
           $res = $user->save();
           Auth::login($user);
           return Redirect::route('home');
        }else{
          return Redirect::route('passreset', Input::get('token'))
          ->with('action', 'error')
          ->with('result', false)
          ->with('message', trans('general.messages.reset_again'));
        }
    }
  }
}
?>