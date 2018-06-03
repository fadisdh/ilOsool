@extends('layouts.site')

@section('title')
  Login
@stop

@section('content')
	@parent
	<div class="page-login">
		<div class="login-box">
			<div class="hline"></div>
			<div class="login-box-content">
				<h2 class="page-title">{{trans('general.login')}}</h2>

				@if(Session::has('error'))
					<div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
						{{ Session::get('error') }}
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					</div>
				@endif

				{{ Auth::check() ? Auth::user()->email : '' }}

				{{ Form::open(array('route' => 'login', 
	                	 			'class' => 'form-horizontal')) }}
	  					
			    	<div class="form-group {{ Session::get('error')  ? 'has-error' : '' }}">
						{{ Form::label('email', trans('general.email_address'), array('class' => 'control-label col-md-4')) }}
					    <div class="col-md-7">
						   {{ Form::text('email', null, array('class' => 'form-control')) }}
					    </div>
					</div>

					<div class="form-group {{ Session::get('error') ? 'has-error' : '' }}">
						{{ Form::label('password', trans('general.password'), array('class' => 'control-label col-md-4')) }}
					    <div class="col-md-7">
						   {{ Form::password('password', array('class' => 'form-control')) }}
					    </div>
					</div>

					<div class="form-group {{ $errors->first('remember') ? 'has-error' : '' }}">
					    <div class="col-md-7 col-md-offset-4">
					        <div class="checkbox">
					            {{ Form::checkbox('remember', '1', null, array('id' => 'remember')) }}
			    				{{ Form::label('remember', trans('general.remember_me')) }}
					        </div>
					    </div>
					</div>

					<div class="form-group">
						<div class="forgot-pass col-md-5 col-md-offset-4">
	                        <a class="popup" href="{{ URL::route('passreminder')}}" data-title="Password Reset">{{trans('general.forget_password')}}</a>
	                    </div>
					    <div class="login-btn col-md-2">
					        {{ Form::submit(trans('general.login'), array('class' => 'btn btn-primary')) }}
					    </div>
					    
					</div>

					<div class="login-separator">
                        <div class="separator"><h3>{{trans('general.or')}}</h3></div>
                    </div>
                    <a href="javascript:loginWithLinkidin('');" class="linkedin-login-btn">{{trans('general.login_linkedin')}}</a>
                    
					{{ Form::token(); }}

				{{ Form::close() }}
			</div>
		</div>
	</div>
		
@stop