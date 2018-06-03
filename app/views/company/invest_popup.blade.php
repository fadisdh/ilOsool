<div id="requestfiles-res">
	{{ Form::open(array('route' => array('invest.confirm', $company->id, Auth::user()->id),
						'class' => 'form-horizontal ajax',
						'data-res' => '#requestfiles-res')) }}

	<div class="modal-body popup-requestfiles-body">
		<div class="row">
			<div class="col-md-12">
				<h4 class="popup-requestfiles-title">{{trans('deal.insert_amount')}}</h4>
			</div>
			<div class="form-group {{ isset($error) ? 'has-error' : '' }}">
			 	{{ Form::label('amount', trans('deal.amount'), array('class' => 'control-label col-md-2')) }}
			 	<div class="col-md-9">
			 		
					{{ Form::text('amount', isset($error) ? $amount : '', array('class' => 'form-control')) }}
					 
					@if( isset($error) && $error == true )
						<div class="help-block">{{trans('validation.custom.correct_value')}}</div>
					@endif
				</div>
				
			</div>
		</div>
	</div>
	<div class="modal-footer popup-requestfiles-footer">
		{{ Form::submit(trans('general.confirm'), array('class' => 'btn btn-primary')) }}
		<button type="button" class="btn btn-default" data-dismiss="modal">{{trans('general.cancel')}}</button>
	</div>
	{{ Form::token(); }}
	{{ Form::close() }}
</div>
