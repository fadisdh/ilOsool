<div id="requestfiles-res">
	<div class="modal-body popup-alert-body">
		<div class="login-box-content register-box-content">
			{{ HTML::image('images/register.png') }}
			<div class="register-popup">
				<a href="{{URL::route('register', array('type' => 'individual'))}}" class="btn btn-register">{{trans('general.register_now')}}</a>
			</div>
			<div class="login-separator">
	            <div class="separator"><h3>{{trans('general.or')}}</h3></div>
	        </div>
	        <div class="register-popup">
				<a href="{{URL::route('login')}}" class="btn btn-default">{{trans('general.if_have_account')}}</a>
			</div>
        </div>
	</div>
</div>
