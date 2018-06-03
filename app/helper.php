<?php 

//set timezone
date_default_timezone_set('Asia/Riyadh'); 

function query_url($url, $q){
    return $url . '?' . http_build_query(array_merge($_GET, $q));
}

function getLocale(){
    return Config::get('app.locale');
}

function can(){
	if(!Auth::check()) return false;
	
	$pers = func_get_args();
	if(!$pers) return false;

	$res = true;
	foreach($pers as $per) {
		if(!$res) break;
        $res = $res && Auth::user()->rule->hasPermission($per);
    }
	return $res;
}

function isOwner($val){
    if( Auth::check() && $val == Auth::user()->id)
        return true;
    else
        return false;
}

function stripTags($string, $remove_breaks = false) {
	$string = preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $string );
	$string = strip_tags($string);

	if ( $remove_breaks )
		$string = preg_replace('/[\r\n\t ]+/', ' ', $string);

	return trim( $string );
}

function trimWords( $text, $num_words = 55, $more = null ) {
    if ( null === $more ) $more = '&hellip;';
 
    $original_text = $text;
    $text = stripTags( $text );
    $words_array = preg_split( "/[\n\r\t ]+/", $text, $num_words + 1, PREG_SPLIT_NO_EMPTY );
 
    if(count( $words_array ) > $num_words) {
        array_pop( $words_array );
        $text = implode( ' ', $words_array);
        $text = $text . $more;
 
    }else{
        $text = implode( ' ', $words_array);
    }

    return $text;
}

function getOption($key) {
    return Option::getValue($key);
}

function getSelect($array, $id = null){

    $array = Config::get('ilosool.' . $array);
    foreach ($array as $key) {
        $selectArray[$key] = trans('deal_values.'.$key);
    }

    $select = '';    
    $select .= '<div class="">'.
        Form::select($id, $selectArray, null,array('class' => 'form-control'))
    .'</div>';

    return $select;
}

function getCheckboxes($array, $name, $class, $oldData = null){

    $array = Config::get('ilosool.' . $array);

    $checkboxes = '';
    if(!is_null($oldData)){
        foreach ($array as $key) {
            $checkboxes .= '<div class="'. $class .'">
                <div class="checkbox">
                    <label>' .
                        Form::checkbox($name,$key, in_array($key, $oldData) ? true : '') . ' ' . trans('deal_values.'.$key)
                    . '</label>
                </div>
            </div>';
        }
    }else{
        foreach ($array as $key) {
            $checkboxes .= '<div class="'. $class .'">
                <div class="checkbox">
                    <label>' .
                        Form::checkbox($name,$key,'') . ' ' . trans('deal_values.'.$key)
                    . '</label>
                </div>
            </div>';
        }
    }

    return $checkboxes;
}

function arrayToSqlString($array){
    if(!$array) return '';

    $array = implode(',', $array);
    return $array;
}

function upload($file, $destination){

    $filename = uniqid() . '.' . strtolower($file->getClientOriginalExtension());
    $uploadSuccess = $file->move($destination, $filename);

    if($uploadSuccess) {
        return $filename;
    }

    return false;
}

//Check if exists message thread between (deal lister, Auth, listing)
function messageExists($id, $type){
    if($type == 'Company'){
        $reference = Company::find($id);
    }elseif($type == 'RequestDeal'){
        $reference = RequestDeal::find($id);
    }

    $message = Message::where('reference_id', '=', $reference->id)
                        ->where('reference_type', '=', $type)
                        ->where('sender_id', '=', Auth::user()->id)
                        ->where('receiver_id', '=', $reference->user_id)
                        ->first();
    if($message){
        return $message;
    }else{
       return false ;
    }

}

//Form
Form::macro('date', function($name, $value = null, $options = array()) {
    $input =  '<input type="text" name="' . $name . '" value="' . $value . '"';

    $class = false;
    foreach ($options as $key => $value) {
        if($key == 'class'){
            $input .= ' ' . $key . '="datepicker ' . $value . '"';
            $class = true;
        }else{
            $input .= ' ' . $key . '="' . $value . '"';
        }
        if(!$class) $input .= ' class="datepicker"';
    }

    $input .= ' />';

    return $input;
});

Form::macro('datetime', function($name, $value = null, $options = array()) {
    $input =  '<input type="datetime" name="' . $name . '" value="' . $value . '"';

    foreach ($options as $key => $value) {
        $input .= ' ' . $key . '="' . $value . '"';
    }

    $input .= '/>';

    return $input;
});

Form::macro('currency', function($name, $currentValue = null) {
    $currencies = Config::get('ilosool.currency');

    $input =  '<select name='. $name .' class="form-control">';

    foreach ($currencies as $currency => $value) {

        if($currentValue == $currency){
            $input .= '<option value='. $currency .' selected>'. $value .'</option>';
        }else{
            $input .= '<option value='. $currency .'>'. $value .'</option>';
        }
        
    }

    $input .= '<select/>';

    return $input;
});

Form::macro('area', function($name, $currentValue = null) {

    $areas = Config::get('ilosool.area_units');

    $input =  '<select name='. $name .' class="form-control">';

    foreach ($areas as $area => $value) {

        if($currentValue == $area){
            $input .= '<option value='. $area .' selected>'. $value .'</option>';
        }else{
            $input .= '<option value='. $area .'>'. $value .'</option>';
        }
        
    }

    $input .= '<select/>';

    return $input;
});

//composers
View::composer('profile.popup_notifications', function($view){
    $notifications = Notification::where('user_id', '=', Auth::user()->id)
                                        ->orderBy('created_at', 'desc')
                                        ->take(5)
                                        ->get();
    
    $unread = Notification::where('user_id', '=', Auth::user()->id)
                            ->where('viewed', '=', 0)
                            ->count();
    $view->with('notifications', $notifications)->with('unread', $unread);
});

View::composer('profile.popup_messages', function($view){
    // $messages = Message::where('receiver_id', '=', Auth::user()->id)
    //                                     ->orderBy('created_at', 'desc')
    //                                     ->take(5)
    //                                     ->get();
    
    $messages = Message::where('receiver_id', '=', Auth::user()->id)
                            ->orWhere('sender_id', '=', Auth::user()->id)
                            ->groupBy('message_id')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();

    $unreadMessages = Message::
                        where(function($q){
                            $q  ->where('receiver_id', '=', Auth::user()->id)
                                ->where('viewed_receiver', '=', 0);
                        })
                        ->orWhere(function($q){
                            $q  ->where('sender_id', '=', Auth::user()->id)
                                ->where('viewed_sender', '=', 0);
                        })->count();

    $view->with('messages', $messages)->with('unreadMessages', $unreadMessages);
});



