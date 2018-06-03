@extends('layouts.user')

@section('title')
  Profile | My Listings
@stop

@section('user_content')
	@parent

	<div class="page-content">
		<div class="row clearfix">
			<div class="col-md-9">
				<h2 class="page-title">{{trans('profile.my_listings.my_listings')}}</h2>
			</div>
			<div class="col-md-3 addcompany-btn">
				<a href="{{ URL::route('company.type') }}" class="btn btn-primary" title="{{trans('profile.my_listings.add_new_listing')}}">{{trans('profile.my_listings.add_new_listing')}}</a>
			</div>
		</div>
		@if(Session::has('action'))
			<div class="alert company-form-alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
				{{ Session::get('message') }}
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>
		@endif
		<ul class="list-unstyled mycompanies companies-list clearfix">
			@if(count($companies) > 0)
				@foreach($companies as $company)
					@if (Auth::check())
						<?php $status = $company->grantedAccess(Auth::user()->id, $company->id); ?>
					@endif
					<li class="row company-item animation">
						<div class="company-item-block">
							<!-- <a href="{{ URL::route('profile.company.delete', $company->id ) }}" class="delete-listing confirm-action" title="Delete Listing" data-name="{{ $company->name }}"><span class="glyphicon glyphicon-remove"></span></a> -->
							<a href="javascript:void(0);" data-href="{{URL::route('listing.request.popup', array($company->id, 'delete'))}}" class="delete-listing popup" data-title='{{trans("profile.my_listings.request_delete")}}' title="{{trans("profile.my_listings.request_delete")}}"><span class="glyphicon glyphicon-remove"></span></a>

							<a href="{{ $company->slug ? URL::route('company.view', $company->slug) : URL::route('company.view', $company->id) }}" class="company-item-row row">
							@if(!$company->approved )
								<div class="company-pending">
									<h1>{{trans('profile.my_listings.pending_approval')}}</h1>
								</div>
							@endif
								<div class="col-md-5">
									<div class="row">
										<img class="col-md-3" src="{{ ($company->logo) ? asset($company->getLogo()) : asset('images/default-logo-img.png') }}" />
										<div  class="col-md-9">
											<h3>{{ $company->deal_name }}</h3>
											<h4>{{ $company->city }}, {{ $company->country }}</h4>
											<h4>{{ trans('deal_values.'.Config::get('ilosool.type.'. $company->type)) }}</h4>
										</div>
									</div>
									<div class="row company-info">
										<div class="left-info col-md-6">
											<h4>{{trans('profile.my_listings.min_investment')}}</h4>
											@if($company->companyHidden)
												<h3>{{ $company->getPrivateField($company, $company->format($company->min_investment) . ' ' . $company->min_investment_suffix, $company->companyHidden->min_investment, $status) }}</h3>
											@else
												<h3>{{$company->format($company->min_investment)  . ' ' . $company->min_investment_suffix}}</h3>
											@endif
										</div>
										<div  class="right-info col-md-6">
											<h4>{{trans('profile.my_listings.sector')}}</h4>
											<h3>{{trans('deal_values.'.$company->sector)}}</h3>
										</div>
									</div>
								</div>
								<div class="col-md-7">
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
										<p>{{ trimWords($company->brief, 60) }}</p>
									</div>
								</div>
							</a>
							<div class="row company-btns clearfix">
								<a href="{{ URL::route('company.edit', $company->id ) }}" class="col-md-2" title="{{trans('profile.my_listings.edit_listing')}}">{{trans('profile.my_listings.edit_listing')}}</a>

								<a href="{{ URL::route('company.update_status', $company->id ) }}" data-title="{{trans('deal.update_status')}}" class="col-md-2 popup" title="{{trans('profile.my_listings.update_status')}}">{{trans('profile.my_listings.update_status')}}</a>

								<a href="{{ URL::route('attachments', $company->id ) }}" class="col-md-2" title="{{trans('profile.my_listings.attachments')}}">{{trans('profile.my_listings.attachments')}}</a>

								<a href="{{ URL::route('staff', $company->id ) }}" class="col-md-2" title="{{trans('profile.my_listings.staff')}}">{{trans('profile.my_listings.staff')}}</a>

								<a href="{{ URL::route('company.statistics') }}" data-title="{{trans('deal.statistics')}}" class="col-md-2 popup" title="{{trans('profile.my_listings.statistics')}}">{{trans('profile.my_listings.statistics')}}</a>

								<a href="{{ URL::route('company.requests', $company->id ) }}" class="col-md-2" title="{{trans('profile.my_listings.requests')}}">{{trans('profile.my_listings.requests')}}</a>
							</div>
						</div>
					</li>
				@endforeach
			@else
				<div class="no-result">
					<h3>{{trans('profile.my_listings.no_listings')}}</h3>
				</div>
			@endif
		</ul>
		<div class="pagination-tab">{{ $companies->links() }}</div>
	</div>
@stop
