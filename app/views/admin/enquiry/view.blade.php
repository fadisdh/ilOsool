@extends('layouts.admin')

@section('title')
  Admin Enquiry View
@stop

@section('content')
	@parent
    <div class="container adminview">
    	<ol class="breadcrumb">
		  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
		  <li><a href="{{ URL::route('admin.enquiries') }}">Enquiries</a></li>
		  <li class="active">{{ $enquiry->title }}</li>
		</ol>
    	<div class="row adminview-row">
			<div class="col-md-2 adminview-key">ID</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $enquiry->id }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Title</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $enquiry->title }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Content</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $enquiry->content }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">From</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $enquiry->from }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">To</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $enquiry->to }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $enquiry->type }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Status</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $enquiry->status }}</div>
		</div>
    </div>
@stop