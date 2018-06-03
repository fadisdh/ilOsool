<div id="requestfiles-res">
	{{ Form::open(array('route' => array('send.message.post', 'companyId' => $companyId),
			'class' => 'form-horizontal ajax',
			'data-res' => '#requestfiles-res')) }}
	<div class="modal-body popup-request-body">
		<div class="row">
			<div class="col-md-12 {{ isset($error) ? 'has-error' : '' }}">
				<h4 class="popup-request-title">Send new message</h4>
				{{ Form::textarea('content', null, array('class' => 'form-control editor', 'rows' => '4')) }}
				@if( isset($error) && $error == true )
					<div class="help-block">Please write some content to the owner of this deal</div>
				@endif
			</div>
		</div>
	</div>
	<div class="modal-footer popup-request-footer">
		{{ Form::submit('Confirm', array('class' => 'btn btn-primary ajax')) }}
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	</div>
	{{ Form::close() }}
</div>
