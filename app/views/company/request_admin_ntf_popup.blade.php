<div id="requestfiles-res">
	{{ Form::open(array('route' => array('listing.request.confirm', 'company_id' => $company->id, 'request' => $request),
			'class' => 'form-horizontal ajax',
			'data-res' => '#requestfiles-res')) }}
	<div class="modal-body popup-request-body">
		<div class="row">
			<?php
				$placeholder = ($request == 'edit' ? trans('deal.request_edit_info') : trans('deal.request_delete_info'));
			?>
			<div class="col-md-12 {{ isset($error) ? 'has-error' : '' }}">
				<h4 class="popup-request-title">{{sprintf(trans('deal.do_you_want'), trans('general.'.$request), $company->deal_name)}}</h4>
				{{ Form::textarea('description', null, array('class' => 'form-control editor', 'placeholder' => $placeholder, 'rows' => '4')) }}
				@if( isset($error) && $error == true )
					@if($request == 'edit')
						<div class="help-block">{{trans('deal.request_edit_info')}}</div>
					@else
						<div class="help-block">{{trans('deal.request_delete_info')}}</div>
					@endif
				@endif
			</div>
		</div>
	</div>
	<div class="modal-footer popup-request-footer">
		{{ Form::submit(trans('general.confirm'), array('class' => 'btn btn-primary ajax')) }}
		<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.cancel')}}</button>
	</div>
	{{ Form::close() }}
</div>
