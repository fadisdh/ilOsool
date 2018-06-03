@extends('layouts.admin')

@section('title')
	Admin Staff View
@stop

@section('content')
@parent
<div class="container adminview">

	<ol class="breadcrumb">
	  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
	  <li><a href="{{ URL::route('admin.companies') }}">Companies</a></li>
	  <li><a href="{{ URL::route('admin.company.view', $staff->company_id) }}">{{ $company_name }}</a></li>
	  <li><a href="{{ URL::route('admin.company.staff', $staff->company_id) }}">staff</a></li>
	  <li class="active">{{ $staff->name }}</li>
	  <li class="pull-right"><a href="{{ URL::route('admin.company.staff.edit', array($staff->company_id, $staff->id)) }}" class="label label-default"><span class="glyphicon glyphicon-edit action"></span> Edit</a></li>
	</ol>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">ID</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $staff->id }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Image</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">
			@if($staff->image)
                <img class="adminview-image" src="{{ asset($staff->getImage()) }}" />
            @else
                <img class="adminview-image" src="{{ asset(Config::get('ilosool.default_user_image')) }}" />
            @endif
		</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Name</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $staff->name }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Position</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $staff->position }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Description</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $staff->description }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Type</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $staff->type }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Access</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $staff->access }}</div>
	</div>
</div>
@stop