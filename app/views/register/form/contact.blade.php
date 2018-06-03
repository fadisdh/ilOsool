<div class="form-group {{ $errors->first('city') ? 'has-error' : '' }}">
	{{ Form::label('city', 'City', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
    	{{ Form::text('city', Input::old('city'), array('class' => 'form-control')) }}
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('city') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('country') ? 'has-error' : '' }}">
	{{ Form::label('country', 'Country', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
        {{ Form::select('country', Config::get('countries'), Input::old('country'), array('class' => 'form-control')) }}
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('country') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('address') ? 'has-error' : '' }}">
	{{ Form::label('address', 'Address', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
	   {{ Form::textarea('address', Input::old('address'), array('class' => 'form-control')) }}
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('address') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
	{{ Form::label('phone', 'Phone Number', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
	   {{ Form::text('phone', Input::old('phone'), array('class' => 'form-control')) }}
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('phone') }}</div>
    </div>
</div>

<div class="form-group stepper-btns">
    <div class="col-md-12">
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="1"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="3">Next <span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>