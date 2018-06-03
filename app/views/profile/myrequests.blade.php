@extends('layouts.user')

@section('title')
  Profile | My Requests
@stop

@section('user_content')
	@parent

	<div class="page-content">
		<div class="row clearfix">
			<div class="col-md-9">
				<h2 class="page-title">{{trans('profile.my_requests.my_requests')}}</h2>
			</div>
			<div class="col-md-3 addcompany-btn">
				<a href="{{ URL::route('request.deal') }}" class="btn btn-primary" title="{{trans('profile.my_requests.add_new_request')}}">{{trans('profile.my_requests.add_new_request')}}</a>
			</div>
		</div>
		@if(Session::has('action'))
			<div class="alert company-form-alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
				{{ Session::get('message') }}
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>
		@endif
		<ul class="list-unstyled mycompanies companies-list clearfix">
			@if(count($requests) > 0)
				@foreach($requests as $request)
					<li class="row company-item animation">
						<div class="company-item-block">
							<a href="{{URL::route('request.deal.edit', $request->id)}}" class="company-item-row row">
							<div class="col-md-5">
								<div class="row">
									<img class="col-md-3" src="{{ ($request->user->image) ? asset($request->user->getImage()) : asset('images/default-logo-img.png') }}" />
									<div  class="col-md-9">
										@if($request->user->user_type == 'company')
								            <h3>{{ $request->user->company_name }}</h3>
								        @else
								            @if($request->user->nickname)
								                <h3>{{ $request->user->nickname }}</h3>
								            @else
								            	@if(!$request->user->hidden_name)
								                	<h3>{{ $request->user->firstname . ' ' .  $request->user->lastname }}</h3>
								                @else
								                	<h3>Private</h3>
							                	@endif
								            @endif
								        @endif
										<h4>{{ ucfirst(Config::get('ilosool.rules.'.$request->user->rule_id)) }}</h4>
										<h4>{{ ucfirst(trans('general.'.$request->user->user_type)) }}</h4>
										<h4>
										@if($request->user->pe_interested)
											PE 
										@endif
										@if($request->user->vc_interested)
											VC 
										@endif
										@if($request->user->re_interested)
											RE 
										@endif
										</h4>
									</div>
								</div>
							</div>
							<div class="col-md-7">
								<div class="row">
									<div  class="col-md-12">
										<h4 class="brief">{{ $request->brief }}</h4>
										<h4><span class="key">{{trans('request.deal_type')}}:</span> {{ ucfirst(trans('general.'.Config::get('ilosool.type.'.$request->asset_class))) }}</h4>
										<h4><span class="key">{{trans('request.deal_size')}}:</span> 
											<?php $count = count($request->deal_size); $i=0; $str='';?> 
											@foreach($request->deal_size as $ds)
												<?php $i++; ?>
												@if($count == $i)
													<?php $str .= trans('deal_values.'.$ds); ?>
												@else
													<?php $str .= trans('deal_values.'.$ds) . ', '; ?>
												@endif
											@endforeach
											{{trimWords($str, 8)}}
										</h4>
										<h4><span class="key">{{trans('request.geo_interests')}}:</span> 
											<?php $count = count($request->geo_interests); $i=0; $str='';?>
											@foreach($request->geo_interests as $geo)
												<?php $i++; ?>
												@if($count == $i)
													<?php $str .= trans('deal_values.'.$geo); ?>
												@else
													<?php $str .= trans('deal_values.'.$geo) . ', '; ?>
												@endif
											@endforeach
											{{trimWords($str, 8)}}
										</h4>
									</div>
								</div>
							</div>
							</a>
						</div>
					</li>
				@endforeach
			@else
				<div class="no-result">
					<h3>{{trans('profile.my_requests.no_requests')}}</h3>
				</div>
			@endif
		</ul>
		<div class="pagination-tab">{{ $requests->links() }}</div>
	</div>
@stop
