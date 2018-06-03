@extends('layouts.user')

@section('title')
  Investments
@stop

@section('sidemenu')
	@include('profile.filter')
@stop

@section('user_content')
	@parent
	<ul class="list-unstyled companies-list clearfix">
		@if($companies)
			@foreach($companies as $company)
				<li class="col-md-4 company-item animation">
					<a href="{{ URL::route('company.view', $company->id) }}" class="company-item-block" title="View">
						<div class="row">
							<img class="col-md-3" src="{{ ($company->logo) ? asset($company->getLogo()) : asset('images/default-logo-img.png') }}" />
							<div  class="col-md-9">
								<h3>{{ (strlen($company->deal_name)>16) ? substr($company->deal_name,0,16) . '...' :  $company->deal_name }}</h3>
								<h4>{{ $company->city }}, {{ $company->country }}</h4>
								<h4>{{ $company->type }}</h4>
							</div>
						</div>
						<div class="row company-info">
							<div class="left-info col-md-6">
								<h4>Min. Investment</h4>
								<h3>{{ $company->format($company->min_investment) }}</h3>
							</div>
							<div  class="right-info col-md-6">
								<h4>Time Left</h4>
								@if($company->isEnded())
									<h3>Deal is finished</h3>
								@elseif($company->daysLeft() == 0 && $company->hoursLeft() == 0)
									<h3>{{ $company->minutesLeft() }} Mins, {{ $company->secondsLeft() }} Secs</h3>
								@elseif($company->daysLeft() == 0)
									<h3>{{ $company->hoursLeft() }} Hours, {{ $company->minutesLeft() }} Mins</h3>
								@else
									<h3>{{ $company->daysLeft() }} Days, {{ $company->hoursLeft() }} Hours</h3>
								@endif
							</div>
						</div>

						<!--
						Progress Bar-->
						<div class="row progress-info">
							<div class="progress">
								<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{($company->investmentProgress()>100) ? '100' : $company->investmentProgress()}}%;">
								<span class="sr-only">{{$company->investmentProgress()}}% Complete</span>
								</div>
							</div>
							<h4>Raised {{ $company->format($company->current) }} of {{ $company->format($company->target) }}</h4>
						</div> 

						<div class="row description-info">
							<p>{{ trimWords($company->brief, 25) }}</p>
						</div>
						<div class="company-box-shadow"></div>
					</a>
				</li>
			@endforeach
		@else
			<h3 class="no-result">No results found for your search criteria. Please try again</h3>
		@endif
	</ul>
	<div  class="pagination-tab">
    	{{ $companies->appends(array('search_investors' => Input::get('search_investors'),
    			'geo_interest' => Input::get('geo_interest'),
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
