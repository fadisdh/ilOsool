@extends('layouts.user')

@section('title')
  Profile | Requests
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<div class="row clearfix">
			<div class="col-md-9">
				<h2 class="page-title">Requests</h2>
			</div>
			<div class="col-md-3 profile-filter">
				{{ Form::open(array('route' => array('company.requests', $company_id), 'method' => 'get')) }}
					{{ Form::select('status', Config::get('ilosool.investment_status_filter'), Input::get('status') ? Input::get('status') : null, array('class' => 'form-control')) }}
					{{ Form::submit('Filter', array('class' => 'btn btn-primary')) }}
				{{ Form::close() }}
			</div>
		</div>
		<ul id="messages" class="investments list-unstyled">
			@if(count($requests) > 0)
				@foreach($requests as $req)
					<li class="profile-row clearfix {{ ($req->status == 'rejected') ? 'alert-danger' : ($req->status == 'accepted' ? 'alert-success' : '') }}">
						<div class="row clearfix">
					    	<div class="col-md-9">
								{{ $req->user->getPublicName() }} requests the private info of {{ $req->company->name}}
							</div>
							<div class="col-md-9">
								{{ $req->description }}
							</div>
							<div class="col-md-3 profile-filter">
								<a href="{{ Route('company.grant.access', array($req->id, 'accepted'))}}" class="btn btn-primary btn-sm popup" data-refresh="true">Accept</a>
							
								<a href="{{ Route('company.grant.access', array($req->id, 'rejected'))}}" class="btn btn-danger btn-sm popup" data-refresh="true">Reject</a>
							</div>
					    </div>
					
						<?php 
							switch ($req->status) {
								case 'accepted': echo "Request Accepted";
									break;
								case 'rejected': echo "Request Rejected";
									break;
								case 'pending': echo "Request is pending";
									break;
							}
						?>
					</li>
				@endforeach
			@else
				<h3 class="no-result">There is no {{ Input::get('status') }} requests for this listing...</h3>
			@endif
		</ul>
		<div class="pagination-tab">{{ $requests->appends(array('status' => Input::get('status')))->links() }}</div>
	</div>
@stop
