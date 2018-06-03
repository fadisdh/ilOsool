@extends('layouts.user')

@section('title')
  Investments
@stop

@section('sidemenu')
	@include('profile.filter')
@stop

@section('user_content')
	@parent
	@if(Input::get('search_investments') || Input::get('asset_class') || Input::get('timer') )
	    <h2 class="search-title page-title">{{trans('general.search_result')}}</h2>
	@endif
	
	<ul class="list-unstyled companies-list clearfix">
		@if(count($companies) > 0)
			@foreach($companies as $company)
				@if (Auth::check())
					<?php $status = $company->grantedAccess(Auth::user()->id, $company->id); ?>
				@endif
				<li class="col-md-4 company-item animation">
					<a href="{{ $company->slug ? URL::route('company.view', $company->slug) : URL::route('company.view', $company->id) }}" class="company-item-block" title="View">
						<div class="row">
							<img class="col-md-3" src="{{ ($company->logo) ? asset($company->getLogo()) : asset('images/default-logo-img.png') }}" />
							<div  class="col-md-9">
								<h3>{{ (strlen($company->deal_name)>16) ? substr($company->deal_name,0,16) . '...' :  $company->deal_name }}</h3>
								<h4>{{ $company->city }}, {{ $company->country }}</h4>
								<h4>{{ trans('deal_values.'.Config::get('ilosool.type.'. $company->type)) }}</h4>
							</div>
						</div>
						<div class="row company-info">
							<div class="left-info col-md-6">
								<h4>{{trans('profile.my_listings.min_investment')}}</h4>
								<h3>
									@if($company->companyHidden)
										<h3>{{ $company->getPrivateField($company, $company->format($company->min_investment)  . ' ' . $company->min_investment_suffix, $company->companyHidden->min_investment, $status, array('pending' => trans('general.private'), 'rejected' => trans('general.private'), 'request' => trans('general.private'))) }}</h3>
									@else
										<h3>{{$company->format($company->min_investment) . ' ' . $company->min_investment_suffix }}</h3>
									@endif
								</h3>
							</div>
							<div  class="right-info col-md-6">
								<h4>{{trans('profile.my_listings.sector')}}</h4>
								<h3>{{ trans('deal_values.'.$company->sector) }}</h3>
							</div>
						</div>

						<!-- Listing Status -->
						<div class="row listing-status ">
							@if($company->listing_status == 'open')
								<img src="{{asset('images/open.png')}}">
								<span class='open'>{{ trans('deal.status.'.$company->listing_status) }}</span>
							@elseif($company->listing_status == 'closed')
								<img src="{{asset('images/closed.png')}}">
								<span class='closed'>{{ trans('deal.status.'.$company->listing_status) }}</span>
							@elseif($company->listing_status == 'negotiation')
								<img src="{{asset('images/negotiation.png')}}">
								<span class='negotiation'>{{ trans('deal.status.'.$company->listing_status) }}</span>
							@else
								<img src="{{asset('images/open.png')}}">
								<span class='open'>{{ trans('deal.status.open') }}</span>
							@endif
						</div> 

						<div class="row description-info">
							<p>{{ trimWords($company->brief, 25) }}</p>
						</div>
						<div class="company-box-shadow"></div>
					</a>
				</li>
			@endforeach
		@else
		<div class="no-result">
			<h3>{{trans('general.no_result')}}</h3>
			<a href="{{ URL::current() }}" title="{{trans('general.return_home')}}" class="search-btn btn btn-primary">{{trans('general.return_home')}}</a>
		</div>
		@endif
	</ul>
	<div  class="pagination-tab">
    	{{ $companies->appends(array('search_investments' => Input::get('search_investments'),
    			'geo_interests' => Input::get('geo_interests'),
    			'asset_class' => $asset_class,
    			'pe_sector_interests' => Input::get('pe_sector_interests'),
    			're_sector_interests' => Input::get('re_sector_interests'),
    			'vc_sector_interests' => Input::get('vc_sector_interests'),
    			'pe_deal_size' => Input::get('pe_deal_size'),
    			're_deal_size' => Input::get('re_deal_size'),
    			'vc_deal_size' => Input::get('vc_deal_size'),
    			'timer' => Input::get('timer')))->links(array('class' => 'pagination')) }}
    </div>
@stop
