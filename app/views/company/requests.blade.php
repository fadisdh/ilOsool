@extends('layouts.user')

@section('title')
  Listing | Requests
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<div class="row clearfix">
			<div class="col-md-9">
				<h2 class="page-title">{{trans('deal.listing_requests')}}</h2>
			</div>
			<div class="col-md-3 profile-filter">
				{{ Form::open(array('route' => array('company.requests', $company_id), 'method' => 'get')) }}
					{{ Form::select('status', (getLocale() == "ar") ? Config::get('ilosool.investment_status_filter_arabic') : Config::get('ilosool.investment_status_filter'), Input::get('status') ? Input::get('status') : null, array('class' => 'form-control')) }}
					{{ Form::submit(trans('general.filter'), array('class' => 'btn btn-primary')) }}
				{{ Form::close() }}
			</div>
		</div>
		<ul id="messages" class="investments list-unstyled">
			@if(count($requests) > 0)
				@foreach($requests as $req)
					<li class="profile-row clearfix {{ ($req->status == 'rejected') ? 'alert-danger' : ($req->status == 'accepted' ? 'alert-success' : '') }}">
						<div class="row clearfix">
					    	<div class="col-md-9">
					    		@if(getLocale() == 'ar')
					    			{{ sprintf(trans('deal.requests_label'), $req->company->name, $req->user->getPublicName())}}
					    		@else
					    			{{ sprintf(trans('deal.requests_label'), $req->user->getPublicName(), $req->company->name)}}
					    		@endif
							</div>
							<div class="col-md-9">
								{{ $req->description ? $req->description : trans("general.no_description") }}
							</div>
							<div class="col-md-3 profile-filter">
								<a href="{{ Route('company.grant.access', array($req->id, 'accepted'))}}" class="btn btn-primary btn-sm popup" data-refresh="true">{{trans('general.accept')}}</a>
							
								<a href="{{ Route('company.grant.access', array($req->id, 'rejected'))}}" class="btn btn-danger btn-sm popup" data-refresh="true">{{trans('general.reject')}}</a>
							</div>
					    </div>
					
						<?php 
							switch ($req->status) {
								case 'accepted': echo trans('deal.request_accepted');
									break;
								case 'rejected': echo trans('deal.request_rejected');
									break;
								case 'pending': echo trans('deal.request_pending');
									break;
							}
						?>
					</li>
				@endforeach
			@else
				<h3 class="no-result">{{trans('deal.no_listing_requests')}}...</h3>
			@endif
		</ul>
		<div class="pagination-tab">{{ $requests->appends(array('status' => Input::get('status')))->links() }}</div>
	</div>
@stop
