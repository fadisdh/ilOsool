@extends('layouts.admin')

@section('title')
  Admin Message View
@stop

@section('content')
	@parent
    <div class="container adminview">
    	<ol class="breadcrumb">
			<li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
			<li><a href="{{ URL::route('admin.users') }}">Users</a></li>
			<li><a href="{{ URL::route('admin.user.view',$id) }}">{{ $username }}</a></li>
			<li><a href="{{ URL::route('admin.messages.view', array($id, $messageType)) }}"><?php ( $messageType == "sent" ) ?  print "Sent Messages" : print "Received Messages" ?></a></li>
			<li class="active">{{$message->title}}</li>
		</ol>
    	<div class="row adminview-row">
			<div class="col-md-2 adminview-key">ID</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $message->id }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Title</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $message->title }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Content</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $message->content }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $message->type }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key"><?php ( $messageType == "sent" ) ?  print "Sent to" : print "Received from" ?></div>
		    <div class="col-md-9 col-md-offset-1 adminview-val"><a href="{{ URL::route('admin.user.view',$message->receiver_id) }}">{{ $userTypeName }}</a></div>
		</div>
	</div>
@stop