@extends('layouts.admin')

@section('title')
  Admin Page View
@stop

@section('content')
	@parent
    <div class="container adminview">
    	<ol class="breadcrumb">
		  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
		  <li><a href="{{ URL::route('admin.pages') }}">Pages</a></li>
		  <li class="active">{{ $page->title }}</li>
		  <li class="pull-right"><a href="{{ URL::route('admin.page.edit', $page->id) }}" class="label label-default"><span class="glyphicon glyphicon-edit action"></span> Edit</a></li>
		</ol>
    	<div class="row adminview-row">
			<div class="col-md-2 adminview-key">ID</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $page->id }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Title</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $page->title }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Arabic Title</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $page->title_arabic }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">slug</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $page->slug }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Content</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $page->content }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Arabic Content</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $page->content_arabic }}</div>
		</div>
		<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Image</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">
			@if($page->image)
                <img class="adminview-image" src="{{ asset($page->getImage()) }}" />
            @endif
		</div>
	</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $page->type }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Tags</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $page->tags }}</div>
		</div>
	</div>
@stop