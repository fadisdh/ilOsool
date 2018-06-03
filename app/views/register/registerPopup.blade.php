<div class="modal-body popup-register-body">
	<div class="row">
		<div class="col-md-5 register-left" >
			<div class="register-icon ilosool-icon"></div>
			<a href="{{ URL::route('register') }}?type={{$type}}" class="popup-register-user"> {{trans('menu.topmenu.register_new_user')}}</a>
		</div>

		<div class="col-md-2 popup-register-line"><span class="line"></span><span class="or">{{trans('menu.topmenu.or')}}</span></div>

		<div class="col-md-5 register-right">
			<div class="register-icon linkedin-icon"></div>
			<a href="javascript:loginWithLinkidin('{{ $type }}');" class="popup-register-linkedin"><span class="linkedin-icon"></span>{{trans('menu.topmenu.signup_with')}} Linkedin</a>
		</div>
	</div>
</div>

