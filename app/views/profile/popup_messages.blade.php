<a href="javascript:void(0);" id="messages-icon" class="notifications-icon notifications-opener" data-ref="#messages-wrapper"><span class="glyphicon glyphicon-envelope"> </span>
	@if($unreadMessages)
		<span class="badge">{{ $unreadMessages }}</span>
	@endif
	</a>
<div id="messages-wrapper" class="notifications-wrapper notifications-box messages-wrapper">
	<h3>{{trans('menu.topmenu.messages')}}</h3>
	<ul class="list-unstyled">
		@if(count($messages) > 0)
			@foreach ($messages as $msg)
				<li>
					<a href="{{route('message.view', $msg->id)}}" class="row {{ ($msg->viewed) ? 'viewed' : '' }}">
						<img src="{{ ($msg->sender->image) ? asset($msg->sender->getImage()) : asset('images/default-staff-img.png') }}" class="col-md-2" />
						<div class="col-md-10">
							@if(Auth::user()->id == $msg->receiver->id)
								<p>{{trans('general.message_from')}} {{ $msg->sender->nickname ? $msg->sender->nickname : $msg->sender->firstname . ' ' . $msg->sender->lastname}}</p>
							@elseif(Auth::user()->id == $msg->sender->id)
								<p>{{trans('general.message_from')}} {{ $msg->receiver->nickname ? $msg->receiver->nickname : $msg->receiver->firstname . ' ' . $msg->receiver->lastname}}</p>
							@endif
							<h4>{{ date("M d, Y", strtotime($msg->updated_at)) }}</h4>
						</div>
					</a>
				</li>
			@endforeach
		@else
			<li><h3 class="no-result">{{trans('profile.messages.no_messages')}}!</h3></li>
		@endif
		
		<li class="see-all">
			<a href="{{ URL::route('messages') }}#topmenu" class="row">{{trans('general.see_all')}}...</a>
		</li>
	</ul>
	<div class="hline"></div>
</div>