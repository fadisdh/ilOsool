@extends('layouts.user')

@section('title')
  Profile | Personal Info
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<div class="row clearfix">
			<div class="col-md-8">
				<h2 class="page-title">{{trans('profile.profile_info.profile_info')}}</h2>
			</div>
			<div class="col-md-4 addcompany-btn">
				<a href="{{ URL::route('profile.info.edit') }}" class="btn btn-primary" title="Edit Personal Info">{{trans('profile.profile_info.edit_profile_info')}}</a>
				<a href="{{ URL::route('profile.password.edit') }}" class="btn btn-primary" title="Edit Password">{{trans('profile.profile_info.edit_password')}}</a>
			</div>
		</div>
		@if(Session::has('action'))
			<div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
				{{ Session::get('message') }}
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>
		@endif
		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">{{trans('profile.profile_info.first_name')}}</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->firstname }}</div>
		</div>
		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">{{trans('profile.profile_info.last_name')}}</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->lastname }}</div>
		</div>

		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">{{trans('profile.profile_info.brief')}}</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->brief }}</div>
		</div>
		
		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">{{trans('profile.profile_info.nickname')}}</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->nickname }}</div>
		</div>
		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">{{trans('profile.profile_info.email')}}</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->email }}</div>
		</div>

		@if($user->user_type == strtolower(Config::get('ilosool.user_type.agent')))
			<div class="profile-row clearfix">
				<div class="col-md-2 profile-key">{{trans('profile.profile_info.regular_buyer_commission')}}</div>
			    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->rbc }}%</div>
			</div>
			<div class="profile-row clearfix">
				<div class="col-md-2 profile-key">{{trans('profile.profile_info.regular_seller_commission')}}</div>
			    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->rsc }}%</div>
			</div>
		@endif

		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">{{trans('profile.profile_info.city')}}</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->city }}</div>
		</div>
		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">{{trans('profile.profile_info.country')}}</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->country }}</div>
		</div>
		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">{{trans('profile.profile_info.address')}}</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->address }}</div>
		</div>
		<div class="profile-row clearfix">
			<div class="col-md-2 profile-key">{{trans('profile.profile_info.phone')}}</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->phone }}</div>
		</div>
		<!-- <div class="profile-row clearfix">
			<div class="col-md-2 profile-key">Date of birth</div>
		    <div class="col-md-9 col-md-offset-1 profile-val">{{ $user->birth }}</div>
		</div> -->
	</div>
@stop

