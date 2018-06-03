@extends('layouts.user')

@section('title')
  Profile | Investment Info
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<h2 class="page-title">{{trans('profile.investment_info.investment_info')}}</h2>
		@if(Session::has('action'))
			<div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
				{{ Session::get('message') }}
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>
		@endif
		<div class="row profile-investment-info clearfix">
            <div class="type-boxes">
                <h3>{{trans('profile.investment_info.info')}}</h3>
                <div class="col-md-4">
                    <a href="{{ URL::route('profile.investment.pe') }}#topmenu" class="yellow-bg">
                        <h1>PE</h1>
                        <h3>Private Equity</h3>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ URL::route('profile.investment.vc') }}#topmenu" class="green-bg">
                        <h1>VC</h1>
                        <h3>Venture Capital</h3>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ URL::route('profile.investment.re') }}#topmenu" class="blue-bg">
                        <h1>RE</h1>
                        <h3>Real Estate</h3>
                    </a>
                </div>
            </div>
        </div>		
	</div>
@stop
