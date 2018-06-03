<div class="form-group {{ $errors->first('user_type') ? 'has-error' : '' }}">
    {{ Form::label('user_type', 'User Type', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
        {{ Form::select('user_type', Config::get('ilosool.user_type'), Input::old('user_type'), array('class' => 'form-control')) }}
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('user_type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('firstname') ? 'has-error' : '' }}">
    {{ Form::label('firstname', 'First Name', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
    	{{ Form::text('firstname', Input::old('firstname'), array('class' => 'form-control')) }}
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('firstname') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('lastname') ? 'has-error' : '' }}">
    {{ Form::label('lastname', 'Last Name', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
    	{{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control')) }}
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('lastname') }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('nickname', 'Nickname', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
    	{{ Form::text('nickname', Input::old('nickname'), array('class' => 'form-control')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
    {{ Form::label('email', 'E-Mail Address', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
    	{{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('email') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
	{{ Form::label('password', 'Password', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
    	{{ Form::password('password', array('class' => 'form-control')) }}
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('password') }}</div>
    </div>
</div>


<div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
    {{ Form::label('password_confirmation', 'Confirm Password', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
    	{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('birth') ? 'has-error' : '' }}">
    {{ Form::label('birth', 'Date of birth', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
        {{ Form::date('birth',isset($user->birth) ? $user->birth : Input::old('birth'), array('class' => 'form-control', 'id' => 'date_of_birth')) }}
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('birth') }}</div>
    </div>
</div>

<div class="form-group stepper-btns">
    <div class="col-md-12">
        <a href="#" class="btn btn-lg btn-primary disabled"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="2">Next <span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>