<div class="modal-body popup-profile-body">
	<div class="message-view">
		<div class="message-time">
			<h3>{{ date("M d, Y h:i A", strtotime($message->created_at)) }}</h3>
		</div>
		<div class="message-from">
			<h3>From: {{ $message->sender->firstname . ' '. $message->sender->lastname }}</h3>
		</div>

	    <p>{{ $message->content }}</p>
	    @if($message->type == 'request')
        	<a href="{{URL::route('profile.grant.access', $message->id)}}" data-title="Grant Access" class="btn btn-primary popup">Grant Access</a>
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	    @elseif($message->type == 'invest')
	    	<a href="{{URL::route('profile.accept.investment', $message->id)}}" data-title="Accept Investment" class="btn btn-primary popup">Accept</a>
	    	<a href="{{URL::route('profile.reject.investment', $message->id)}}" data-title="Reject Investment" class="btn btn-primary popup">Reject</a>
		@endif
	</div>
</div>
