@extends('layouts.user')

@section('title')
  Profile | Message View
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<h2 class="page-title">
			@if($message->sender->nickname)
				{{ $message->sender->nickname }}
			@else
				{{ $message->sender->firstname . ' '. $message->sender->lastname}}
			@endif
		</h2>
		
		<ul class="comments">
			@foreach ($messages as $message)
				@include('message.message')
			@endforeach
		</ul>
		{{ Form::open(array('route' => array('message.reply.post', 'messageId' => $message->message_id))) }}
			@include('message.message_new')
		{{ Form::close() }}
	</div>
@stop
