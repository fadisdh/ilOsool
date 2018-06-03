<div id="requestfiles-res">
	{{ Form::open(array('route' => array('request.confirm', 'companyId' => $company->id, 'senderId' => Auth::user()->id),
			'class' => 'form-horizontal ajax',
			'data-res' => '#requestfiles-res')) }}
	<div class="modal-body popup-request-body">
		<div class="row">
			<div class="col-md-12">
				<h4 class="popup-request-title">{{trans('deal.request_info_from')}} {{ $company->deal_name }}?</h4>
				{{ Form::textarea('description', null, array('class' => 'form-control editor', 'placeholder' => trans('deal.request_reason'), 'rows' => '4')) }}
			</div>
		</div>
	</div>
	<div class="modal-footer popup-request-footer">
		{{ Form::submit(trans('general.confirm'), array('class' => 'btn btn-primary ajax')) }}
		<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.cancel')}}</button>
	</div>
	{{ Form::close() }}
</div>
