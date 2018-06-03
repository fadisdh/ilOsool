@extends('layouts.site')

@section('title')
  Complete Registration
@stop

@section('content')
	@parent

    <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
    <div class="container">
        <div class="page-container">
            <div class="page-content">
                <h2 class="page-title">{{trans('register.complete_registration')}}</h2>
               	<h3>{{trans('register.select_user_type')}}</h3>
               	<div class="row user-container">
		    		<div class="col-md-4">
		            	<div class="user-box">
		            		<img class="user-box-img" src="{{ asset('images/invesetors-box.jpg')}}" />
		                	<div class="user-box-overlay animation">
		                		<h3>{{trans('register.deal_seekers')}}</h3>
		                		<?php $page = Page::where('slug', 'deal_seeker')->first(); ?>
		                		<p>{{ trimWords( $page->content, 100) }}</p>
		                		<div class="user-box-btns">
		                			<a class="col-md-12" href="{{ URL::route('register.investor', 'investor')}}" data-title="Register as Investor">{{trans('general.select')}}</a>
		                		</div>
		                	</div>	                	
		                </div>
		            </div>

		            <div class="col-md-4">
		                <div class="user-box">
		                	<img class="user-box-img" src="{{ asset('images/companies-box.jpg')}}" />
		                	<div class="user-box-overlay animation">
		                		<h3>{{trans('register.deal_listers')}}</h3>
		                		<?php $page = Page::where('slug', 'deal_lister')->first(); ?>
		                		<p>{{ trimWords( $page->content, 100) }}</p>
		                		<div class="user-box-btns">
		                			<a class="col-md-12" href="{{ URL::route('register.lister')}}?type=lister" data-title="Register as Company">{{trans('general.select')}}</a>
		                		</div>
		                	</div>	                	
		                </div>
		        	</div>

		        	<div class="col-md-4">
		                <div class="user-box">
		                	<img class="user-box-img" src="{{ asset('images/both-box.jpg')}}" />
		                	<div class="user-box-overlay animation">
		                		<h3>{{trans('register.both')}}</h3>
		                		<?php $page = Page::where('slug', 'deal_both')->first(); ?>
		                		<p>{{ trimWords( $page->content, 100) }}</p>
		                		<div class="user-box-btns">
		                			<a class="col-md-12" href="{{ URL::route('register.investor', 'both')}}" data-title="Register as Both">{{trans('general.select')}}</a>
		                		</div>
		                	</div>	                	
		                </div>
		            </div>
		        </div><!---user-container end here-->
            </div>
        </div>
    </div>
@stop