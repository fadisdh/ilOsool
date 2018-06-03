@extends('layouts.admin')

@section('title')
	Admin Investment View
@stop

@section('content')
@parent
<div class="container adminview">

	<ol class="breadcrumb">
	  <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
	  <li><a href="{{ URL::route('admin.companies') }}">Companies</a></li>
	  <li><a href="{{ URL::route('admin.company.view', $investment->company_id) }}">{{ $company->name }}</a></li>
	  <li><a href="{{ URL::route('admin.company.investments', $investment->company_id) }}">Investments</a></li>
	  <li class="active">{{ $investment->id }}</li>
	  <li class="pull-right"><a href="{{ URL::route('admin.company.investment.edit', array($investment->company_id, $investment->id)) }}" class="label label-default"><span class="glyphicon glyphicon-edit action"></span> Edit</a></li>
	</ol>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">ID</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $investment->id }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Amount</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $investment->amount }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Value</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val">{{ $investment->value }}</div>
	</div>

	<div class="row adminview-row">
		<div class="col-md-2 adminview-key">Investor</div>
	    <div class="col-md-9 col-md-offset-1 adminview-val"><a href="{{ URL::route('admin.user.view', $user->id)}}">{{ $user->firstname . ' ' . $user->lastname }}</a></div>
	</div>

</div>
@stop