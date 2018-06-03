<div id="requestfiles-res">
	<div class="modal-body popup-alert-body">
		<div class="row">
			<div class="col-md-12">
				<h4 class="popup-alert-content">{{ $message }}</h4>
			</div>
		</div>
	</div>
	<div class="modal-footer popup-alert-footer">
		<a href="{{URL::route('register', array('type' => 'individual'))}}" class="btn btn-primary">{{trans('general.register')}}</a>
		<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.cancel')}}</button>
	</div>
</div>
