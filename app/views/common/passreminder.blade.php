<div class="modal-body popup-passremind-body" id="forgetpass-res">

		{{ Form::open(array('route' => 'passreminder.post', 
                	 		'class' => 'form-horizontal ajax',
                	 		'data-res' => '#modal .modal-container')) }}
		    	<div class="form-group {{ isset($error)  ? 'has-error' : '' }}">
					{{ Form::label('email', trans('general.email_address'), array('class' => 'control-label col-md-3')) }}
				    <div class="col-md-9">
					   {{ Form::text('email', null, array('class' => 'form-control')) }}
					   @if(isset($error))
					   		<div class="help-block">{{ $message }}</div>
					   @endif
				    </div>
				</div>
			    <div class="form-group">
				    <div class="login-btn col-md-9 col-md-offset-3">
				        {{ Form::submit(trans('general.send_email'), array('class' => 'btn btn-primary')) }}
				    </div>
				</div>
			{{ Form::token(); }}
		{{ Form::close() }}
</div>