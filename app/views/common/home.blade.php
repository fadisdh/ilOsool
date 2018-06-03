@extends('layouts.site')

@section('title')
  Home
@stop

@section('scripts')
	@parent
	{{ HTML::style('js/responsiveslides/responsiveslides.css') }}
	{{ HTML::script('js/responsiveslides/responsiveslides.min.js') }}
	<script type="text/javascript">
		$(function() {
	    	$("#slider").responsiveSlides({
	    		timeout: 10000,
	    		prevText: '',
	    		nextText: ''
	    	});
	  	});
	</script>
@stop

@section('content')
	<div class="slider">
		<ul id="slider">
			<li>
				{{ HTML::image('images/slider1.jpg') }}
				<div class="slider-text">
					<h2>{{ getLocale() == 'en' ? $slider1->title : $slider1->title_arabic }}</h2>
					<p>{{ getLocale() == 'en' ?  trimWords($slider1->content, 60) :  trimWords($slider1->content_arabic, 60) }}</p>
				</div>
			</li>
			<li>
				{{ HTML::image('images/slider2.jpg') }}
				<div class="slider-text">
					<h2>{{ getLocale() == 'en' ? $slider2->title : $slider2->title_arabic }}</h2>
					<p>{{ getLocale() == 'en' ?  trimWords($slider2->content, 60) :  trimWords($slider2->content_arabic, 60) }}</p>
				</div>
			</li>
			<li>
				{{ HTML::image('images/slider3.jpg') }}
				<div class="slider-text">
					<h2>{{ getLocale() == 'en' ? $slider3->title : $slider3->title_arabic }}</h2>
					<p>{{ getLocale() == 'en' ?  trimWords($slider3->content, 60) :  trimWords($slider3->content_arabic, 60) }}</p>
				</div>
			</li>
			<li>
				{{ HTML::image('images/slider4.jpg') }}
				<div class="slider-text">
					<h2>{{ getLocale() == 'en' ? $slider4->title : $slider4->title_arabic }}</h2>
					<p>{{ getLocale() == 'en' ?  trimWords($slider4->content, 60) :  trimWords($slider4->content_arabic, 60) }}</p>
				</div>
			</li>
		</ul>
	</div>
	<div class="container">
		@if(Session::has('action'))
			<div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
				{{ Session::get('message') }}
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>
		@endif
		<div class="row category-container">
			<div class="boxes-category">
				<a href="{{ URL::route('page', array('slug' => 'pe')) }}" class="col-md-4 box-category yellow-bg">
					<h1>PE</h1>
					<h3>{{trans('home.private_equity')}}</h3>
				</a>
				
				<a href="{{ URL::route('page', array('slug' => 'vc')) }}" class="col-md-4 box-category green-bg">
					<h1>VC</h1>
					<h3>{{trans('home.venture_capital')}}</h3>
				</a>
				
				<a href="{{ URL::route('page', array('slug' => 're')) }}" class="col-md-4 box-category blue-bg">
					<h1>RE</h1>
					<h3>{{trans('home.real_estate')}}</h3>
				</a>
			</div>
			<div class="text-category">{{trans('home.ilosools_asset_clasess')}}</div>
		</div><!---category-container end here-->
		
		<h2 class="page-title">{{trans('home.join_ilosool_as')}}</h2>
    	
    	<div class="row user-container">
    		<div class="col-md-4">
            	<div class="user-box">
            		<img class="user-box-img" src="{{ asset('images/invesetors-box.jpg')}}" />
                	<div class="user-box-overlay animation">
                		<h3>{{trans('home.individual')}}</h3>
                		<?php $page = Page::where('slug', 'individual')->first(); ?>
                		<p>{{ getLocale() == 'en' ? trimWords( $page->content, 55) : trimWords( $page->content_arabic, 55)}}</p>
                		<div class="user-box-btns">
                			<a href="{{ URL::route('page', 'individual') }}" class="col-md-6 first">{{trans('home.read_more')}}</a>
                			<a class="col-md-6 popup" href="javascript:void(0);" data-href="{{ URL::route('register.popup')}}?type=individual" data-title='{{trans("general.register_as")}}{{trans("general.individual")}}'>{{trans('home.register')}}</a>
                		</div>
                	</div>	                	
                </div>
            </div>

            <div class="col-md-4">
                <div class="user-box">
                	<img class="user-box-img" src="{{ asset('images/companies-box.jpg')}}" />
                	<div class="user-box-overlay animation">
                		<h3>{{trans('home.company')}}</h3>
                		<?php $page = Page::where('slug', 'companies')->first(); ?>
                		<p>{{ getLocale() == 'en' ? trimWords( $page->content, 55) : trimWords( $page->content_arabic, 55)}}</p>
                		<div class="user-box-btns">
                			<a href="{{ URL::route('page', 'companies') }}" class="col-md-6 first">{{trans('home.read_more')}}</a>
                			<a class="col-md-6 popup" href="javascript:void(0);" data-href="{{ URL::route('register.popup')}}?type=company" data-title='{{trans("general.register_as")}}{{trans("general.company")}}'>{{trans('home.register')}}</a>
                		</div>
                	</div>	                	
                </div>
        	</div>

        	<div class="col-md-4">
                <div class="user-box">
                	<img class="user-box-img" src="{{ asset('images/both-box.jpg')}}" />
                	<div class="user-box-overlay animation">
                		<h3>{{trans('home.agent')}}</h3>
                		<?php $page = Page::where('slug', 'agent')->first(); ?>
                		<p>{{ getLocale() == 'en' ? trimWords( $page->content, 55) : trimWords( $page->content_arabic, 55)}}</p>
                		<div class="user-box-btns">
                			<a href="{{ URL::route('page', 'agent') }}" class="col-md-6 first">{{trans('home.read_more')}}</a>
                			<a class="col-md-6 popup" href="javascript:void(0);" data-href="{{ URL::route('register.popup')}}?type=agent" data-title='{{trans("general.register_as")}}{{trans("general.agent")}}'>{{trans('home.register')}}</a>
                		</div>
                	</div>	                	
                </div>
            </div>
        </div><!---user-container end here-->

        @if(count($companies))
	        <h2 class="page-title">{{trans('home.featured_deals')}}</h2>
			
			<div id="carousel" class="carousel">
				<a href="#" class="carousel-nav next"></a>
				<a href="#" class="carousel-nav prev"></a>
				<div class="deals featured">
					<div class="wrapper row">
							<?php $i = 0; ?>
							@foreach($companies as $company)
								@if($i % 6 == 0)
									<div class="deals-section item">
								@endif
								<div class="col-md-4">
									<a class="deal animation" href="{{ $company->slug ? URL::route('company.view', $company->slug) : URL::route('company.view', $company->id) }}" title="View">
				        				<div class="deal-header" style="background-image:url({{ ($company->image) ? asset($company->getImage()) : asset('images/default-company-img.jpg') }});">
				        					<img src="{{ ($company->logo) ? asset($company->getLogo()) : asset('images/default-logo-img.png') }}" alt="" class="deal-img">
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
				                @if($i % 6 == 5)
									</div>
								@endif
								<?php $i++; ?>
							@endforeach
						</div>
					</div>
				</div><!-- #carousel -->
			</div><!-- .deals -->
        @endif
    </div><!---container end here-->
@stop