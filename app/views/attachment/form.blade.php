<?php $errors = (array) Session::get('errors'); ?>
<?php $errorsNew = (array) Session::get('errorsNew'); ?>

@foreach( $attachments as $a )
	<div class="form-group">
        <div class="col-md-4 {{ isset($errors[$a->id]) && $errors[$a->id]['message']->first('name') ? 'has-error' : '' }}">
	        {{ Form::text('attachment[' . $a->id . '][name]', $a->name, array('class' => 'form-control', 'placeholder' => 'Name' )) }}
        <div class="help-block">{{ isset($errors[$a->id]) ? $errors[$a->id]['message']->first('name') : '' }}</div>
	    </div>
        <div class="col-md-3">
            @if(isset($a->name))
                <div ><a href="{{ asset($a->getFullPath()) }}" target="_blank" class="label label-default"><span class="glyphicon glyphicon-download"></span> {{ $a->url }}</a></div>
            @endif
        </div>
        <div class="col-md-3 {{ isset($errors[$a->id]) && $errors[$a->id]['message']->first('file') ? 'has-error' : '' }}">
            {{ Form::file( 'attachment[' . $a->id . '][file]', '',null, array('class' => 'form-control')) }}
            <div class="help-block">{{ isset($errors[$a->id]) ? $errors[$a->id]['message']->first('file') : '' }}</div>
        </div>
        <div class="col-md-2 {{ isset($errors[$a->id]) && $errors[$a->id]['message']->first('access') ? 'has-error' : '' }}">
            {{ Form::select('attachment[' . $a->id . '][access]', Config::get('ilosool.attachments_permissions'), $a->access, array( 'class' => 'form-control' )) }}
            <div class="help-block">{{ isset($errors[$a->id]) ? $errors[$a->id]['message']->first('access') : '' }}</div>
        </div>
    </div>
@endforeach

<div class="form-group">
    <div class="col-md-4 {{ isset($errorsNew[0]) && $errorsNew[0]['message']->first('name') ? 'has-error' : '' }}">
        {{ Form::text('newattachment[0][name]', null, array('class' => 'form-control', 'placeholder' => 'Name')) }}
        <div class="help-block">{{ isset($errorsNew[0]) ? $errorsNew[0]['message']->first('name') : '' }}</div>
    </div>
    <div class="col-md-3">
        
    </div>
    <div class="col-md-3 {{ isset($errors[0]) && $errors[0]['message']->first('file') ? 'has-error' : '' }}">
        {{ Form::file( 'newattachment[0][file]', '',null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-2 {{ isset($errors[0]) && $errors[0]['message']->first('access') ? 'has-error' : '' }}">
        {{ Form::select('newattachment[0][access]', Config::get('ilosool.attachments_permissions'), $a->access, array( 'class' => 'form-control' )) }}
    </div>
</div>