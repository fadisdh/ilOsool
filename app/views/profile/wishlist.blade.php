@extends('layouts.user')

@section('title')
  Profile | My Wishlist
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<h2 class="page-title">My Wishlist</h2>
		<ul class="list-unstyled companies-list clearfix">
			@foreach($wishlist as $company)
				<li class="col-md-4 company-item animation">
					<a href="{{ URL::route('company.view', $company->id) }}" class="company-item-block" title="View">
						<div class="row">
							<img class="col-md-3" src="{{ ($company->logo) ? asset($company->getLogo()) : asset('images/default-logo-img.png') }}" />
							<div  class="col-md-9">
								<h3>{{ (strlen($company->name)>16) ? substr($company->name,0,16) . '...' :  $company->name }}</h3>
								<h4>{{ $company->city }}, {{ $company->country }}</h4>
								@if( is_array($company->type))
									<h4>{{ implode(', ', $company->type) }}</h4>
								@endif
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
					</a>
				</li>
			@endforeach
			<div class="pagination-tab">
			{{ $wishlist->appends(array('status' => Input::get('status')))->links(array('class' => 'pagination')) }}
			</div>
		</ul>
	</div>
@stop
