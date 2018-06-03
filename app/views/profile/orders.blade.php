@extends('layouts.user')

@section('title')
  Profile | My Investments
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<div class="row clearfix">
			<div class="col-md-9">
				<h2 class="page-title">My Investments</h2>
			</div>
			<div class="col-md-3 profile-filter">
				{{ Form::open(array('route' => 'profile.orders', 'method' => 'get')) }}
					{{ Form::select('status', Config::get('ilosool.investment_status_filter'), Input::get('status') ? Input::get('status') : null, array('class' => 'form-control')) }}
					{{ Form::submit('Filter', array('class' => 'btn btn-primary')) }}
				{{ Form::close() }}
			</div>
		</div>
		<ul class="investments list-unstyled">
			@foreach($investments as $investment)
			<li class="profile-row clearfix {{ ($investment->status == 'rejected') ? 'alert-danger' : ($investment->status == 'accepted' ? 'alert-success' : '') }}">	 
				<div class="row clearfix">
					<div class="col-md-4 company-name">
						<a href="{{ URL::route('company.view', $investment->company->id) }}">{{ $investment->company->name }}</a>
					</div>
					<div class="col-md-8 investment-time">
						{{date("M d, Y", strtotime($investment->created_at))}}
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-4">
						Investment ID: {{ $investment->id }}
					</div>
			    </div>
			    <div class="row clearfix">
			    	<div class="col-md-4">
						Investment Value: {{ $investment->value }}
					</div>
					<div class="col-md-8 investment-status">
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
