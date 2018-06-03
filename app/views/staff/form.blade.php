<?php $errors = (array) Session::get('errors'); ?>
<?php $errorsNew = (array) Session::get('errorsNew'); ?>

@foreach( $staff as $s )
	<div class="form-group">
        <div class="col-md-4 {{ isset($errors[$s->id]) && $errors[$s->id]['message']->first('name') ? 'has-error' : '' }}">
	        {{ Form::text('staff[' . $s->id . '][name]', $s->name, array('class' => 'form-control', 'placeholder' => 'Name' )) }}
        <div class="help-block">{{ isset($errors[$s->id]) ? $errors[$s->id]['message']->first('name') : '' }}</div>
	    </div>
	    
	    <div class="col-md-4 {{ isset($errors[$s->id]) && $errors[$s->id]['message']->first('position') ? 'has-error' : '' }}">
	        {{ Form::text('staff[' . $s->id . '][position]', $s->position, array('class' => 'form-control', 'placeholder' => 'Position')) }}
            <div class="help-block">{{ isset($errors[$s->id]) ? $errors[$s->id]['message']->first('position') : '' }}</div>
	    </div>
	    
	    <div class="col-md-4 {{ isset($errors[$s->id]) && $errors[$s->id]['message']->first('type') ? 'has-error' : '' }}">
	        {{ Form::select('staff[' . $s->id . '][type]', Config::get('ilosool.staff_type'), $s->type, array('class' => 'form-control', 'placeholder' => 'Type'))}}
            <div class="help-block">{{ isset($errors[$s->id]) ? $errors[$s->id]['message']->first('type') : '' }}</div>
	    </div>
	</div>
	<div class="form-group">
	    <div class="col-md-2">
            @if(isset($s))
                @if($s->image)
                    <img src="{{ asset($s->getImage()) }}" />
                @else
                    <img src="{{ asset(Config::get('ilosool.default_user_image')) }}" />
                @endif
            @endif
            {{ Form::file('staff[' . $s->id . '][image]', '', null, array('class' => 'form-control')) }}
        </div>

        <div class="col-md-10">
	        {{ Form::textarea('staff[' . $s->id . '][description]', $s->description, array('class' => 'form-control', 'rows' => 4, 'placeholder' => 'Description')) }}
	    </div>
	</div>

@endforeach

<div class="form-group">
    <div class="col-md-4 {{ isset($errorsNew[0]) && $errorsNew[0]['message']->first('name') ? 'has-error' : '' }}">
        {{ Form::text('newstaff[0][name]', null, array('class' => 'form-control', 'placeholder' => 'Name')) }}
        <div class="help-block">{{ isset($errorsNew[0]) ? $errorsNew[0]['message']->first('name') : '' }}</div>
    </div>

    <div class="col-md-4 {{ isset($errorsNew[0]) && $errorsNew[0]['message']->first('position') ? 'has-error' : '' }}">
        {{ Form::text('newstaff[0][position]', null, array('class' => 'form-control', 'placeholder' => 'Position')) }}
        <div class="help-block">{{ isset($errorsNew[0]) ? $errorsNew[0]['message']->first('position') : '' }}</div>
    </div>

    <div class="col-md-4 {{ isset($errorsNew[0]) && $errorsNew[0]['message']->first('type') ? 'has-error' : '' }}">
        {{ Form::select('newstaff[0][type]', Config::get('ilosool.staff_type'), null, array('class' => 'form-control'))}}
         <div class="help-block">{{ isset($errorsNew[0]) ? $errorsNew[0]['message']->first('type') : '' }}</div>
    </div>
</div>
<div class="form-group">
    <div class="col-md-2">
		<img src="{{ asset(Config::get('ilosool.default_user_image')) }}" />
		{{ Form::file( 'newstaff[0][image]', '',null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10">
        {{ Form::textarea('newstaff[0][description]', null, array('class' => 'form-control', 'rows' => 2, 'placeholder' => 'Description')) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-4 {{ isset($errorsNew[1]) && $errorsNew[1]['message']->first('name') ? 'has-error' : '' }}">
        {{ Form::text('newstaff[1][name]', null, array('class' => 'form-control', 'placeholder' => 'Name')) }}
        <div class="help-block">{{ isset($errorsNew[1]) ? $errorsNew[1]['message']->first('name') : '' }}</div>
    </div>

    <div class="col-md-4 {{ isset($errorsNew[1]) && $errorsNew[1]['message']->first('position') ? 'has-error' : '' }}">
        {{ Form::text('newstaff[1][position]', null, array('class' => 'form-control', 'placeholder' => 'Position')) }}
        <div class="help-block">{{ isset($errorsNew[1]) ? $errorsNew[1]['message']->first('position') : '' }}</div>
    </div>

    <div class="col-md-4 {{ isset($errorsNew[1]) && $errorsNew[1]['message']->first('type') ? 'has-error' : '' }}">
        {{ Form::select('newstaff[1][type]', Config::get('ilosool.staff_type'), null, array('class' => 'form-control'))}}
         <div class="help-block">{{ isset($errorsNew[1]) ? $errorsNew[1]['message']->first('type') : '' }}</div>
    </div>
</div>
<div class="form-group">
    <div class="col-md-2">
        <img src="{{ asset(Config::get('ilosool.default_user_image')) }}" />
        {{ Form::file( 'newstaff[1][image]', '',null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10">
        {{ Form::textarea('newstaff[1][description]', null, array('class' => 'form-control', 'rows' => 2, 'placeholder' => 'Description')) }}
    </div>
</div>