@extends('layouts.user')

@section('inline_script')
	<script type="text/javascript">
		$('#messages a').click(function(){
			$(this).addClass('read');
		});
	</script>        
@stop

@section('title')
  Profile | Requests
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<h2 class="page-title">Requests</h2>
		<ul id="messages" class="messages list-unstyled">
			@foreach($messages as $message)
			<li class="profile-row clearfix">
				<a class="popup {{ ($message->viewed) ? 'read' : '' }}" data-class="read" href="{{ URL::route('profile.message-view', $message->id) }}" data-title="{{$message->title}}"> 
					<div class="row clearfix">
						<div class="col-md-2 message-from">
							From: {{ $message->sender->firstname . ' '. $message->sender->lastname}}
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
