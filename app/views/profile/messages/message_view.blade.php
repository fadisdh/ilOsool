@extends('layouts.user')

@section('title')
  Profile | Message View
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<h2 class="page-title">
			@if($message->sender->nickname)
				{{ $message->sender->nickname . ' - ' . $message->company->deal_name }}
			@else
				{{ $message->sender->firstname . ' '. $message->sender->lastname . ' - ' . $message->company->deal_name }}
			@endif
		</h2>
		
		<ul class="comments">
			@foreach ($messages as $message)
				@include('profile.messages.message')
			@endforeach
		</ul>
		{{ Form::open(array('route' => array('profile.message.reply.post', 'messageId' => $message->message_id))) }}
			@include('profile.messages.message_new')
		{{ Form::close() }}
		
	</div>
@stop
