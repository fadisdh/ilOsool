@extends('layouts.site')

@section('title')
  {{ $user->nickname }}
@stop

@section('content')
	@parent
	<div class="company-banner" style="background-image:url({{ ($user->cover) ? asset($user->getCover()) : asset('images/default-company-img.jpg') }});">
		<div class="info">
			<div class="container">
				<div class="row info-wrapper">
					<div class="company-logo col-md-3">
						<img src="{{ ($user->image) ? asset($user->getImage()) : asset('images/default-logo-img.png') }}" />
					</div>
					<div class="company-title col-md-9">
						@if($user->user_type == 'company')
				            <h2>{{ $user->company_name }}</h2>
				        @else
				            @if($user->nickname)
				                <h2>{{ $user->nickname }}</h2>
				            @else
				            	@if(!$user->hidden_name)
				                	<h2>{{ $user->firstname . ' ' .  $user->lastname }}</h2>
				                @else
				                	<h2>{{trans('general.private')}}</h2>
			                	@endif
				            @endif
				        @endif
						<h4>{{ trans('general.'.$user->user_type) }}</h4>
						<h4>
							@if($user->pe_interested)
								PE 
							@endif
							@if($user->vc_interested)
								VC 
							@endif
							@if($user->re_interested)
								RE 
							@endif
						</h4>
						<h4>
							@if(Auth::user()->id == $user->id)
								<a href="{{ URL::route('profile.info.edit') }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-check"></span> {{trans('profile.profile_info.edit_profile')}}</a>
							@endif
						</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	@if(Auth::check())
		@section('topmenu')
			@include('profile.topmenu')
		@show
	@endif
    <div class="container">
    	@if(Session::has('action'))
			<div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
				{{ Session::get('message') }}
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>
		@endif

    	<div class="row company-row">
			<div class="col-md-6">
				<div class="hline"></div>
				<div class="company-box clearfix">
					<h3 class="box-title">{{trans('profile.profile_info.user_info')}}</h3>
					<ul class="list-unstyled clearfix">
						<li>
							<h4 class="col-md-5">{{trans('profile.profile_info.name')}}</h4>
							<h3 class="col-md-7">{{ !$user->hidden_name ? $user->firstname . ' ' .  $user->lastname : trans('general.private')}}</h3>
						</li>
						<li>
							<h4 class="col-md-5">{{trans('profile.profile_info.nickname')}}</h4>
							<h3 class="col-md-7">{{ $user->nickname }}</h3>
						</li>
						<li>
							<h4 class="col-md-5">{{trans('profile.profile_info.user_type')}}</h4>
							<h3 class="col-md-7">{{ trans('general.'.$user->user_type) }}</h3>
						</li>
						@if($user->user_type == strtolower(Config::get('ilosool.user_type.agent')))
							<li>
								<h4 class="col-md-5">{{trans('profile.profile_info.rbc')}}</h4>
								<h3 class="col-md-7">{{ $user->rbc }}</h3>
							</li>
							<li>
								<h4 class="col-md-5">{{trans('profile.profile_info.rsc')}}</h4>
								<h3 class="col-md-7">{{ $user->rsc }}</h3>
							</li>
						@endif
					</ul>
				</div>
			</div>

			<div class="col-md-6">
				<div class="hline"></div>
				<div class="company-box clearfix">
					<h3 class="box-title">{{trans('profile.profile_info.contact_info')}}</h3>
					@if(!$user->hidden_contact_info)
					    <ul class="list-unstyled clearfix">
							<li>
								<h4 class="col-md-4">{{trans('profile.profile_info.city')}}</h4>
								<h3 class="col-md-8">{{ $user->city }}
								</h3>
							</li>
							<li>
								<h4 class="col-md-4">{{trans('profile.profile_info.country')}}</h4>
								<h3 class="col-md-8">{{ $user->country }}</h3>
							</li>
							<li>
								<h4 class="col-md-4">{{trans('profile.profile_info.phone')}}</h4>
								<h3 class="col-md-8">{{ $user->phone }}</h3>
							</li>
							<li>
								<h4 class="col-md-4">{{trans('profile.profile_info.email')}}</h4>
								<h3 class="col-md-8">{{ $user->email }}</h3>
							</li>
							@if($user->website)
								<li>
									<h4 class="col-md-4">{{trans('profile.profile_info.website')}}</h4>
									<h3 class="col-md-8">{{ $user->website }}</h3>
								</li>
							@endif
							<li>
								<h4 class="col-md-4">{{trans('profile.profile_info.address')}}</h4>
								<h3 class="col-md-8">{{ $user->address }}
								</h3>
							</li>
						</ul>
					@else
						<h4 class="empty-msg">{{trans('general.private')}}</h4>
					@endif
					
				</div>
			</div>
		</div>

		@if($user->brief)
		    <div class="row company-row">
				<div class="col-md-12">
					<div class="hline"></div>
					<div class="company-box clearfix">
						<h3 class="box-title">{{trans('profile.profile_info.brief')}} </h3>
						<div class="col-md-12">{{ $user->brief }}</div>
						
					</div>
				</div>
			</div>
		@endif
		
		@if(count($companies))
	        <h2 class="page-title page-title-profile">{{trans('profile.profile_info.user_deals')}}</h2>
			<div class="deals">
				<div class="row">
					@foreach($companies as $company)
						<div class="col-md-4">
							<a class="deal animation" href="{{ URL::route('company.view', $company->id) }}">
		        				<div class="deal-header" style="background-image:url({{ ($company->image) ? asset($company->getImage()) : asset('images/default-company-img.jpg') }});">
		        					<img src="{{ ($company->logo) ? asset($company->getLogo()) : asset('images/default-logo-img.png') }}" alt="" class="deal-img"/>
		        					<div class="deal-titles">
		        						<h3 class="deal-title">{{ $company->deal_name }}</h3>
		        						<h4 class="deal-subtitle">{{ $company->city }}, {{ $company->country }}</h4>
		        						@if( is_array($company->type))
											<h4 class="deal-subtitle">{{ implode(', ', $company->type) }}</h4>
										@endif
		        					</div>
		        					<div class="deal-overlay"></div>
		        				</div>
		        				<div class="deal-body">{{ trimWords($company->brief, 20) }}</div>
			                </a>
		                </div>
					@endforeach
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="pull-right">
							{{$companies->links()}}
						</div>
					</div>
				</div>
			</div><!-- .deals -->
        @endif

        @if(count($requests))
	        <h2 class="page-title page-title-profile">{{trans('profile.profile_info.user_requests')}}</h2>
			<div class="deals">
				<div class="row">
					@foreach($requests as $request)
						<div class="col-md-4">
							<a class="deal animation" href="{{URL::route('request.view', $request->id)}}" class="company-item-row row">
		        				<div class="request-header">
		        					<div class="request-titles">
		        						<h3 class="request-title">{{ucfirst(trans('general.'.Config::get('ilosool.type.'.$request->asset_class))) }}</h3>
		        						<h4 class="request-subtitle">
		        						<?php $count = count($request->geo_interests); $i=0; $str='';?>
											@foreach($request->geo_interests as $geo)
												<?php $i++; ?>
												@if($count == $i)
													<?php $str .= trans('deal_values.'.$geo); ?>
												@else
													<?php $str .= trans('deal_values.'.$geo) . ', '; ?>
												@endif
											@endforeach
											{{$str}}
										</h4>
		        					</div>
		        					<div class="request-overlay"></div>
		        				</div>
		        				<div class="deal-body">{{ trimWords($request->brief, 20) }}</div>
			                </a>
		                </div>
					@endforeach
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="pull-right">
							{{$companies->links()}}
						</div>
					</div>
				</div>
			</div><!-- .deals -->
        @endif
	</div>
@stop