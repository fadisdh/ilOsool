@extends('layouts.user')

@section('title')
	Profile | Contact Info
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<div class="row clearfix">
			<div class="col-md-9">
				<h2 class="page-title">Contact Info</h2>
			</div>
			<div class="col-md-3 addcompany-btn">
				<a href="{{ URL::route('profile.contact.edit') }}" class="btn btn-primary" title="Edit Contact Info">Edit Contact Info</a>
			</div>
		</div>
		@if(Session::has('action'))
			<div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
				{{ Session::get('message') }}
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>
		@endif
		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">City</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->city }}</div>
		</div>
		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">Country</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->country }}</div>
		</div>
		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">Address</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->address }}</div>
		</div>
		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">Phone</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->phone }}</div>
		</div>
	</div>
@stop

