@extends('layouts.admin')

@section('title')
  Admin Newsletter View
@stop

@section('content')
	@parent
    <div class="container adminview">
    	<ol class="breadcrumb">
		  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
		  <li><a href="{{ URL::route('admin.newsletters') }}">Newsletters</a></li>
		  <li class="active">{{ $newsletter->title }}</li>
		  <li class="pull-right"><a href="{{ URL::route('admin.newsletter.edit', $newsletter->id) }}" class="label label-default"><span class="glyphicon glyphicon-edit action"></span> Edit</a></li>
		</ol>
    	<div class="row adminview-row">
			<div class="col-md-2 adminview-key">ID</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $newsletter->id }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Title</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $newsletter->title }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Content</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $newsletter->content }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $newsletter->type }}</div>
		</div>
	</div>
@stop