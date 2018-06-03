@extends('layouts.site')

@section('title')
  Early Access
@stop

@section('content')
	@parent
	<div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
    <div class="container">
    	<div class="page-container">
    		<div class="hline"></div>
    		<div class="page-content">
				<h2 class="page-title">Request an early access</h2>
		    	{{ $page->content }}
		    	@if(Session::has('action'))
					<div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
						{{ Session::get('message') }}
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					</div>
				@endif

		        {{ Form::open(array('route' => 'enquiry.submit', 
		                            'class' => 'form-horizontal')) }}
		            
		            <div class="form-group {{ $errors->first('firstname') ? 'has-error' : '' }}">
						{{ Form::label('firstname', 'First Name', array('class' => 'control-label col-md-2')) }}
					    <div class="col-md-10">
						   {{ Form::text('enquiry[firstname]', null, array('class' => 'form-control')) }}
					    </div>
					    <div class="col-md-4 col-md-offset-2">
					        <div class="help-block">{{ $errors->first('firstname') }}</div>
					    </div>
					</div>

					<div class="form-group {{ $errors->first('lastname') ? 'has-error' : '' }}">
						{{ Form::label('lastname', 'Last Name', array('class' => 'control-label col-md-2')) }}
					    <div class="col-md-10">
						   {{ Form::text('enquiry[lastname]', null, array('class' => 'form-control')) }}
					    </div>
					    <div class="col-md-4 col-md-offset-2">
					        <div class="help-block">{{ $errors->first('lastname') }}</div>
					    </div>
					</div>

					<div class="form-group">
						{{ Form::label('type', 'Register as', array('class' => 'control-label col-md-2')) }}
					    <div class="col-md-10">
						   {{ Form::select('enquiry[type]', Config::get('ilosool.register_type'), Input::get('type'), array('class' => 'form-control')) }}
					    </div>
					</div>

					<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
						{{ Form::label('email', 'Email', array('class' => 'control-label col-md-2')) }}
					    <div class="col-md-10">
						   {{ Form::text('enquiry[email]', null, array('class' => 'form-control')) }}
					    </div>
					    <div class="col-md-4 col-md-offset-2">
					        <div class="help-block">{{ $errors->first('email') }}</div>
					    </div>
					</div>

					<div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
						{{ Form::label('phone', 'Phone Number', array('class' => 'control-label col-md-2')) }}
					    <div class="col-md-10">
						   {{ Form::text('enquiry[phone]', null, array('class' => 'form-control')) }}
					    </div>
					    <div class="col-md-4 col-md-offset-2">
					        <div class="help-block">{{ $errors->first('phone') }}</div>
					    </div>
					</div>

					<div class="form-group {{ $errors->first('country') ? 'has-error' : '' }}">
						{{ Form::label('country', 'Country', array('class' => 'control-label col-md-2')) }}
					    <div class="col-md-10">
					    	{{ Form::select('enquiry[country]', Config::get('countries'), Input::get('country'), array('class' => 'form-control')) }}
					    </div>
					    <div class="col-md-4 col-md-offset-2">
					        <div class="help-block">{{ $errors->first('country') }}</div>
					    </div>
					</div>

					<div class="form-group {{ $errors->first('city') ? 'has-error' : '' }}">
						{{ Form::label('city', 'City', array('class' => 'control-label col-md-2')) }}
					    <div class="col-md-10">
						   {{ Form::text('enquiry[city]', null, array('class' => 'form-control')) }}
					    </div>
					    <div class="col-md-4 col-md-offset-2">
					        <div class="help-block">{{ $errors->first('city') }}</div>
					    </div>
					</div>

					{{ Form::hidden('_type', 'earlyaccess') }}
					{{ Form::hidden('_subject', 'Early Access | ilOsool') }}
					{{ Form::hidden('_redirect', 'earlyaccess') }}

		            <div class="form-group">
					    <div class="col-md-10 col-md-offset-2">
					        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
					    </div>
					</div>
					{{ Form::token() }}
		        {{ Form::close() }}
		    </div>
		</div>
    </div>
@stop