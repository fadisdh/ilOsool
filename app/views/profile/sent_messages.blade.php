@extends('layouts.user')

@section('inline_script')
	<script type="text/javascript">
		$('#messages a').click(function(){
			$(this).addClass('read');
		});
	</script>        
@stop

@section('title')
  Profile | Sent Messages
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<h2 class="page-title">Sent Messages</h2>
		<a href="{{ URL::route('messages') }}" class="btn btn-primary pull-right">Received Messages</a>
		<ul id="messages" class="messages list-unstyled">
			@foreach($messages as $message)
			<li class="profile-row clearfix">
				<a class="{{ ($message->viewed) ? 'read' : '' }}" data-class="read" href="{{ URL::route('message.view', $message->id) }}" data-title="Message To {{$message->receiver->nickname ? $message->receiver->nickname : $message->receiver->firstname . ' '. $message->receiver->lastname}}"> 
					<div class="row clearfix">
						<div class="col-md-2 message-from">
							@if($message->receiver->nickname)
								To: {{ $message->receiver->nickname }}
							@else
								To: {{ $message->receiver->firstname . ' '. $message->sender->lastname}}
							@endif
						</div>
						<div class="col-md-10 message-time">
							{{date("M d, Y h:i A", strtotime($message->created_at))}}
						</div>
					</div>
					<h3 class="message-title">{{ $message->title }}</h3>
				    <p>{{ trimWords($message->content, 20) }}</p>
				</a>
			</li>
			@endforeach
		</ul>
	</div>
@stop
