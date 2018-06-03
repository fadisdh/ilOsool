@extends('layouts.site')

@section('title')
	 {{trans('general.reset_password')}}
@stop

@section('content')
	@parent

	<div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
	<div class="container">
		<div class="page-container">
			<div class="hline"></div>
			<div class="page-content">
				<h2 class="page-title">{{trans('general.reset_password')}}</h2>
				@if(Session::has('action'))
					<div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
						{{ Session::get('message') }}
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					</div>
				@endif

				{{ Form::open(array('route' => 'passreset.post', 
		                	 		'class' => 'form-horizontal')) }}
		               	{{ Form::hidden('token',  $token) }}
				    	<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
							{{ Form::label('email', trans('general.email_address'), array('class' => 'control-label col-md-4')) }}
						    <div class="col-md-6">
							   {{ Form::text('email', null, array('class' => 'form-control')) }}
						    </div>
						    <div class="col-md-6 col-md-offset-4">
			                    <div class="help-block">{{ $errors->first('email') }}</div>
			                </div>
						</div>
						<div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
							{{ Form::label('password', trans('general.password'), array('class' => 'control-label col-md-4')) }}
						    <div class="col-md-6">
							   {{ Form::password('password', array('class' => 'form-control')) }}
						    </div>
						    <div class="col-md-6 col-md-offset-4">
			                    <div class="help-block">{{ $errors->first('password') }}</div>
			                </div>
						</div>
						<div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
							{{ Form::label('password', trans('general.password_confirm'), array('class' => 'control-label col-md-4')) }}
						    <div class="col-md-6">
							   {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
						    </div>
						    <div class="col-md-6 col-md-offset-4">
			                    <div class="help-block">{{ $errors->first('password') }}</div>
			                </div>
						</div>
					    <div class="form-group">
						    <div class="login-btn col-md-6 col-md-offset-4">
						        {{ Form::submit(trans('general.reset_password'), array('class' => 'btn btn-primary')) }}
						    </div>
						</div>
				{{ Form::close() }}
			</div>
		</div>
	</div>  	
@stop
