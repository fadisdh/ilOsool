@extends('layouts.user')

@section('inline_script')
	<script type="text/javascript">
		$('#messages a').click(function(){
			$(this).addClass('read');
		});
	</script>        
@stop

@section('title')
  Profile | Messages
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<h2 class="page-title">{{trans('profile.messages.messages')}}</h2>
		<ul id="messages" class="messages list-unstyled">
			@if(count($messages) > 0)
				@foreach($messages as $message)
				<li class="profile-row clearfix">
				@if($message->sender->id == Auth::user()->id)
					<a class="{{ $message->viewed_sender == 1 ? 'read' : ''}}" href="{{ URL::route('message.view', $message->id) }}">
				@else
					<a class="{{ $message->viewed_receiver == 1 ? 'read' : ''}}" href="{{ URL::route('message.view', $message->id) }}">
				@endif
						<div class="row clearfix">
							<div class="col-md-9 message-from">
								@if($message->sender->nickname)
									{{ $message->sender->nickname . ' - ' . (($message->reference_type == 'Company') ?  $message->reference->deal_name : 'Request a Deal')}}
								@else
									{{ $message->sender->firstname . ' '. $message->sender->lastname . ' - ' . (($message->reference_type == 'Company') ?  $message->reference->deal_name : 'Request a Deal')}}
								@endif
							</div>
							<div class="col-md-3 message-time">
								{{date("M d, Y h:i A", strtotime($message->created_at))}}
							</div>
						</div>
						<h3 class="message-title">{{ $message->title }}</h3>
					    <p>{{ trimWords($message->content, 20) }}</p>
					</a>
				</li>
				@endforeach
			@else
				<h3 class="no-result">{{trans('profile.messages.no_messages')}}...</h3>
			@endif
		</ul>
	</div>
@stop
