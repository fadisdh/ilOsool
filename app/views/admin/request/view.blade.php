@extends('layouts.admin')

@section('title')
  Admin Request View
@stop

@section('content')
	@parent
    <div class="container adminview">

    	<ol class="breadcrumb">
		  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
		  <li><a href="{{ URL::route('admin.requests') }}">Requests</a></li>
		  <li class="active">{{ $request->id }}</li>
		</ol>
    	<div class="row adminview-row">
			<div class="col-md-2 adminview-key">ID</div>
		    <div class="col-md-5 col-md-offset-1 adminview-val">{{ $request->id }}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">User</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->user->firstname . ' ' . $request->user->lastname}}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Asset Class</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ Config::get('ilosool.type.'.$request->asset_class) }}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">geo_interests</div>
	    	 <div class="col-md-9 col-md-offset-1 adminview-val">{{ implode(', ', $request->geo_interests) }}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">investment_sector</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->investment_sector ? implode(', ', $request->investment_sector) : 'Not Set'}}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">investment_stage</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->investment_stage ? implode(', ', $request->investment_stage) : 'Not Set' }}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">investment_type</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->investment_type ? implode(', ', $request->investment_type) : 'Not Set'}}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">investment_style</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->investment_style ? implode(', ', $request->investment_style) : 'Not Set'}}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">deal_size</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->deal_size ? implode(', ', $request->deal_size) : ''}}</div>
		</div>

		@if($request->asset_class == 'vc')
			<div class="row adminview-row">
				<div class="col-md-2 adminview-key">growth_rate</div>
			    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->growth_rate . ' %'}}</div>
			</div>
			<div class="row adminview-row">
				<div class="col-md-2 adminview-key">revenue</div>
			    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->revenue . ' ' . $request->revenue_suffix}}
			    </div>
			</div>
		@endif

		@if($request->asset_class == 'pe')
			<div class="row adminview-row">
				<div class="col-md-2 adminview-key">Minimum Price Earning</div>
			    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->price_earning ? $request->price_earning : 'Not Set' }}</div>
			</div>
		@endif

		@if($request->asset_class == 're')
			<div class="row adminview-row">
				<div class="col-md-2 adminview-key">Minimum Yield</div>
			    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->yield ? $request->yield : 'Not Set'}}</div>
			</div>
		@endif

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Description</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->description ? $request->description : 'Not Set'}}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Brief</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $request->brief}}</div>
		</div>

		<div class="row adminview-row">
			<div class="col-md-2 adminview-key">Status</div>
		    <div class="col-md-9 col-md-offset-1 adminview-val">{{$request->status ? 'Approved' : 'Not Approved'}}</div>
		</div>
		<div class="row adminview-row">
			<a href="{{URL::route('admin.request.approve', array($request->id, 1) )}}" class="btn btn-md btn-primary">Approve</a>
			<a href="{{URL::route('admin.request.approve', array($request->id, 0) )}}" class="btn btn-md btn-primary btn-danger">Unapproved</a>
		</div>
	</div>
@stop