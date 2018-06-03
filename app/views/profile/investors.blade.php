@extends('layouts.user')

@section('title')
  Profile | Investors
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<div class="row clearfix">
			<div class="col-md-9">
				<h2 class="page-title">{{ $company->name }} Investors </h2>
			</div>
			<div class="col-md-3 profile-filter">
				{{ Form::open(array('route' => array('profile.investors', $company->id), 'method' => 'get')) }}
					{{ Form::select('status', Config::get('ilosool.investment_status_filter'), Input::get('status') ? Input::get('status') : null, array('class' => 'form-control')) }}
					{{ Form::submit('Filter', array('class' => 'btn btn-primary')) }}
				{{ Form::close() }}
			</div>
		</div>
		<ul class="investments list-unstyled">
			@foreach($investments as $investment)
			<li class="profile-row clearfix {{ ($investment->status == 'rejected') ? 'alert-danger' : ($investment->status == 'accepted' ? 'alert-success' : '') }}">
				<div class="row clearfix">
					<div class="col-md-8 company-name">
						{{ $investment->user->firstname . ' ' . $investment->user->lastname }}</a>
					</div>
					<div class="col-md-4 investment-time">
						{{date("M d, Y", strtotime($investment->created_at))}}
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-12">
						Investment ID: {{ $investment->id }}
					</div>
			    </div>
			    <div class="row clearfix">
			    	<div class="col-md-9">
						Investment Value: {{ $investment->value }}
					</div>
					<div class="col-md-3 profile-filter">
						<a href="{{URL::route('profile.investment.changeStatus', array($investment->id, 'accepted'))}}" class="btn btn-primary btn-sm">Accept</a>
					
						<a href="{{URL::route('profile.investment.changeStatus', array($investment->id, 'rejected'))}}" class="btn btn-danger btn-sm">Reject</a>
					</div>
					<div class="col-md-1 investment-status">
						{{ $investment->status }}
					</div>
			    </div>
			</li>
			@endforeach
			<div class="pagination-tab">
			{{ $investments->appends(array('status' => Input::get('status')))->links(array('class' => 'pagination')) }}
			</div>
		</ul>
	</div>
@stop
