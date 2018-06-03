@extends('layouts.admin')

@section('title')
  Admin Post View
@stop

@section('content')
	@parent
    <div class="container adminview">
    	<ol class="breadcrumb">
		  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
		  <li><a href="{{ URL::route('admin.posts') }}">Posts</a></li>
		  <li class="active">{{ $post->title }}</li>
		  <li class="pull-right"><a href="{{ URL::route('admin.post.edit', $post->id) }}" class="label label-default"><span class="glyphicon glyphicon-edit action"></span> Edit</a></li>
		</ol>
    	<div class="row adminview-row">
			<div class="col-md-2 adminview-key">ID</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $post->id }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Title</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $post->title }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Content</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $post->content }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Image</div>
	    	<div class="col-md-9 col-md-offset-1 adminview-val admin-view">
				@if($post->image)
		        	<img class="adminview-image" src="{{ asset($post->getImage()) }}" />
		        @endif
			</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $post->type }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Tags</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $post->tags }}</div>
		</div>
	</div>
@stop