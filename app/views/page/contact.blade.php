@extends('layouts.site')

@section('title')
  {{trans('contact.contact')}}
@stop

@section('content')
	@parent

	<script type="text/javascript">
	//   function initialize() {
	// 	var latlng = new google.maps.LatLng(32.027539,35.852053);
	// 	var myOptions = {
	// 	  center: latlng,
	// 	  zoom: 15,
	// 	  mapTypeId: google.maps.MapTypeId.HYBRID
	// 	};
	// 	var map = new google.maps.Map(document.getElementById("map_canvas"),
	// 		myOptions);
			
	// 	var marker = new google.maps.Marker({
	// 		position: latlng,
	// 		title: 'ilOsool',
	// 		map: map	
	// 	})
	//   }
	  
	//   $(function(){
	// 	  var script = document.createElement("script");
	// 	  script.type = "text/javascript";
	// 	  script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCZTWIt2GBp113S8nnhyMWOdMImEwlgxKk&sensor=false&callback=initialize";
	// 	  document.body.appendChild(script);
	//   });
	// </script>

	<div class="page-img">
		<img src="{{ ($page->image) ? asset($page->getImage()) : asset('images/default-page-img.jpg') }}" />
	</div>

	<div class="container">
		<div class="page-container contact-us">
			<div class="hline"></div>
			<div class="page-content">
				<h2 class="page-title">{{trans('contact.contact')}}</h2>
				<div class="row">
					<div class="left-section col-md-8">
						@if(Session::has('action'))
						<div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
							{{ Session::get('message') }}
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						</div>
						@endif
						<h4>{{trans('contact.contact_us')}}</h4>
				        {{ Form::open(array('route' => 'enquiry.submit', 
				                            'class' => 'form-horizontal')) }}

			            <div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
							<label for="title" class="control-label col-md-2"><span class="required">*</span> {{trans('contact.title')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("contact.title_hint")}}'>[?]</a></label>
						    <div class="col-md-9">
							   {{ Form::text('enquiry[title]', null, array('class' => 'form-control')) }}
						    </div>
						    <div class="col-md-6 col-md-offset-2">
						        <div class="help-block">{{ $errors->first('title') }}</div>
						    </div>
						</div>

						<div class="form-group {{ $errors->first('subject') ? 'has-error' : '' }}">
							<label for="enquiry[subject]" class="control-label col-md-2"><span class="required">*</span> {{trans('contact.subject')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("contact.subject_hint")}}'>[?]</a></label>
						    <div class="col-md-9">
							   {{ Form::text('enquiry[subject]', null, array('class' => 'form-control')) }}
						    </div>
						    <div class="col-md-6 col-md-offset-2">
						        <div class="help-block">{{ $errors->first('subject') }}</div>
						    </div>
						</div>

						<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
							<label for="enquiry[email]" class="control-label col-md-2"><span class="required">*</span> {{trans('contact.email')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("contact.email_hint")}}'>[?]</a></label>
						    <div class="col-md-9">
							   {{ Form::text('enquiry[email]', null, array('class' => 'form-control')) }}
						    </div>
						    <div class="col-md-6 col-md-offset-2">
						        <div class="help-block">{{ $errors->first('email') }}</div>
						    </div>
						</div>

						<div class="form-group {{ $errors->first('message') ? 'has-error' : '' }}">
							<label for="enquiry[message]" class="control-label col-md-2"><span class="required">*</span> {{trans('contact.message')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("contact.message_hint")}}'>[?]</a></label>
						    <div class="col-md-9">
							   {{ Form::textarea('enquiry[message]', null, array('class' => 'form-control')) }}
						    </div>
						    <div class="col-md-6 col-md-offset-2">
						        <div class="help-block">{{ $errors->first('message') }}</div>
						    </div>
						</div>

						{{ Form::hidden('_type', 'contact') }}
						{{ Form::hidden('_subject', 'Contact Us | ilOsool') }}
						{{ Form::hidden('_redirect', 'page.contact') }}

			            <div class="form-group">
						    <div class="btn-container col-md-9 col-md-offset-2">
						        {{ Form::submit(trans('general.send'), array('class' => 'btn btn-primary')) }}
						    </div>
						</div>
						{{ Form::token() }}
			        {{ Form::close() }}
					</div>

					<div class="right-section col-md-4">
						<h3 class="box-title">{{trans('contact.location_contact_info')}}</h3>
			    		<div class="contact-info">
			    			<!-- <div id="map_canvas" class="contact-map"></div> -->
{{-- 
		    				<div class="contact-info-item">
		    					<h4>{{trans('contact.phone_number')}}</h4>
		    					<p>{{ getOption('phone') }}</p>
		    				</div> --}}

		    				<div class="contact-info-item">
		    					<h4>{{trans('contact.email')}}</h4>
		    					<p>{{ getOption('email') }}</p>
		    				</div>

		    				<!-- <div class="contact-info-item">
		    					<h4>Address</h4>
		    					{{ getOption('address') }}
		    				</div> -->

		    				<div class="footer-social">
		                    	<ul class="list-unstyled clearfix">
		                        	<li class="col-md-3"><a href="{{ getOption('facebook') }}" target="_blank"><img src="{{ asset('images/facebook.png')}}"></a></li>
		                            <li class="col-md-3"><a href="{{ getOption('twitter') }}" target="_blank"><img src="{{ asset('images/twitter.png')}}"></a></li>
		                            <li class="col-md-3"><a href="{{ getOption('linkedin') }}" target="_blank"><img src="{{ asset('images/linkedin.png')}}"></a></li>
		                            <li class="col-md-3"><a href="{{ getOption('googleplus') }}" target="_blank"><img src="{{ asset('images/googleplus.png')}}"></a></li>
		                        </ul>
		                    </div>

			    		</div>
					</div>
				</div>
			</div>
		</div>
	</div>  	
@stop