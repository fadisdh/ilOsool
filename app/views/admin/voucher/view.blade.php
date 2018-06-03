@extends('layouts.admin')

@section('title')
  Admin Page View
@stop

@section('content')
	@parent
    <div class="container adminview">
    	<ol class="breadcrumb">
		  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
		  <li><a href="{{ URL::route('admin.vouchers') }}">Vouchers</a></li>
		  <li class="active">{{ $voucher->id }}</li>
		  <li class="pull-right"><a href="{{ URL::route('admin.voucher.edit', $voucher->id) }}" class="label label-default"><span class="glyphicon glyphicon-edit action"></span> Edit</a></li>
		</ol>
    	<div class="row adminview-row">
			<div class="col-md-2 adminview-key">ID</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $voucher->id }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">User</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $voucher->user->firstname . ' ' .  $voucher->user->lastname }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Company</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $voucher->company->name }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $voucher->type }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">data</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $voucher->data }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Price</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $voucher->price }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Start Date</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $voucher->start_date }}</div>
		</div>
		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">End Date</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $voucher->end_date }}</div>
		</div>
	</div>
@stop