<li class="comment">
	<div class="comment-img">
		<img src="{{ ($message->sender->image) ? asset($message->sender->getImage()) : asset('images/default-staff-img.png') }}" class="img" />
	</div>
	<div class="comment-text">
		<h4 class="date">{{ date("M d, Y h:i A", strtotime($message->created_at)) }}</h4>
		@if(Auth::user()->id ==  $message->sender_id )
			<h3 class="title">{{trans("profile.messages.you")}}</h3>
		@else
			<h3 class="title">{{ $message->sender->firstname . ' '. $message->sender->lastname }}</h3>
		@endif
		<p class="text">{{ $message->content }}</p>
	</div>
</li>