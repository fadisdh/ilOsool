@extends('layouts.site')

@section('title')
  {{ $company->deal_name }}
@stop

@section('scripts')
  @parent
  {{ HTML::script('js/shareme.jquery.js') }}
@stop

@section('inline_script')
	<script type="text/javascript">
		$(function(){
			var $socialbar = $('#socialbar');
			var $btns = $socialbar.find('.social-btn');
			$btns.shareMe({
				data: {
					url: "{{ URL::route('company.view', $company->slug) }}",
					title: "{{ $company->deal_name }} | ilOsool Deal",
					description: "{{ trimWords($company->brief, 500) }}",
					via: 'ilOsool',
					media: "{{ asset($company->getImage()) }}"
				}
			});

			$(window).scroll(function(){
				var scrollTop = $(window).scrollTop();
				if(scrollTop > {{ Auth::check() ? 435 : 400 }}){
					$socialbar.addClass('affix');
				}else{
					$socialbar.removeClass('affix');
				}
			});
		});


	</script>

	@if(!Auth::check())
		<script type="text/javascript">
			$(function() {

				var $registerModal = $('#register-modal');
    			var $registerTitle = $registerModal.find('.modal-title');
    			var $registerContainer = $registerModal.find('.modal-container');
    			var $registerLoading = $registerModal.find('.modal-loading');

		        var href = '{{ URL::route("require.register.popup")}}';
		        var title = 'Register';
		        
		        $registerTitle.text(title);
		        $registerModal.modal('show');

		        $.ajax({
		            url : href,
		            beforeSend: function(){
		                $registerLoading.show();
		            },
		            complete: function(){
		                $registerLoading.hide();
		            },
		            error: function(){
		                alert('Error in Connection');
		            },
		            success: function(data){
		                $registerContainer.html(data);
		                $registerContainer.show('fast');
		            }
		        });

		        return false;
		    });
		</script>
	@endif
@stop


@section('content')
	@parent

	@if (Auth::check())
		<?php $status = $company->grantedAccess(Auth::user()->id, $company->id); ?>
	@else
		<?php $status = null; ?>
	@endif
	
	<div class="company-banner" style="background-image:url({{ ($company->image) ? asset($company->getImage()) : asset('images/default-company-img.jpg') }});">
		<div class="info">
			<div class="container">

				<div class="row info-wrapper">
					<div class="company-logo col-md-3">
						<img src="{{ ($company->logo) ? asset($company->getLogo()) : asset('images/default-logo-img.png') }}" />
					</div>
					<div class="company-title col-md-9">
						<h2>{{ $company->deal_name }}</h2>
						<h4>{{ $company->getPrivateField($company, $company->name, $companyHidden->name, $status, array('pending' => '', 'rejected' => '', 'request' => '' )) }}</h4>
						<h4>{{ $company->city }}, {{ $company->country }}</h4>
						<h4>{{ $company->getPrivateField($company, '<a href=http://'. $company->website .'>'.$company->website . '</a>', $companyHidden->website, $status, array('pending' => '', 'rejected' => '', 'request' => '' )) }}</h4>
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
		    <div class="col-md-12">
		    	<div class="hline"></div>
		    	<div class="company-box investment-box">
		    		<h3 class="clearfix box-title">{{trans('deal.investment_details')}}</h3>
					<div class="col-md-8 info-area">
			    		<div class="col-md-6">
			    			<ul class="list-unstyled clearfix">
								<li class="row">
									<h4 class="col-md-6">{{trans('deal.type')}}</h4>
									<h3 class="col-md-6">{{trans('general.'.Config::get('ilosool.type.'.$company->type))}}</h3>
								</li>
								
								@if($company->sector)
								<li class="row">
									<h4 class="col-md-6">{{trans('deal.sector')}}</h4>
									<h3 class="col-md-6">
										{{ trans('deal.sectors.'.$company->sector) }}
									</h3>
								</li>
								@endif
								<li class="row">
									<h4 class="col-md-6">{{trans('deal.investment_stage')}}</h4>
									<h3 class="col-md-6">
										{{ trans('deal.stages.'.$company->investment_stage) }}
									</h3>
								</li>
								<li class="row">
									<h4 class="col-md-6">{{trans('deal.investment_target')}}</h4>
									<h3 class="col-md-6"> {{ $company->getPrivateField($company, $company->format($company->target) . ' ' . $company->target_suffix, $companyHidden->target, $status) }}
									</h3>
								</li>
								<li class="row">
									<h4 class="col-md-6">{{trans('deal.investment_type')}}</h4>
									<h3 class="col-md-6">
										{{ trans('deal.invest_types.'.$company->investment_type) }}
									</h3>
								</li>
								<li class="row">
									<h4 class="col-md-6">{{trans('deal.investment_style')}}</h4>
									<h3 class="col-md-6">
										{{ trans('deal.styles.'.$company->investment_style) }}
									</h3>
								</li>
								<li class="row">
									<h4 class="col-md-6">{{trans('deal.deal_size')}}</h4>
									<h3 class="col-md-6">
										{{ trans('deal.deal_sizes.'.$company->deal_size) }}
									</h3>
								</li>
								@if( $company->user->user_type == strtolower(Config::get('ilosool.user_type.agent')) || $company->user->rule_id == 1)
									<li class="row">
										<h4 class="col-md-6">{{trans('deal.cfb')}}</h4>
										<h3 class="col-md-6">
											{{ $company->cfb . '%'}}
										</h3>
									</li>
								@endif
							</ul>
			    		</div>
			    		<div class="col-md-6">
			    			<ul class="list-unstyled clearfix">
			    				<li class="row">
									<h4 class="col-md-6">{{trans('deal.investment_start_date')}}</h4>
									<h3 class="col-md-6">{{ $company->getPrivateField($company, $company->startdate, $companyHidden->startdate, $status) }}</h3>
								</li>
								
								@if($company->type == 're')
				    				<li class="row">
										<h4 class="col-md-6">{{trans('deal.yield')}}</h4>
										<h3 class="col-md-6">{{ $company->getPrivateField($company, $company->yield . '%', $companyHidden->yield, $status) }}
										</h3>
									</li>
								
									<li class="row">
										<h4 class="col-md-6">{{trans('deal.built_up_area')}}</h4>
										<h3 class="col-md-6">{{ $company->getPrivateField($company, $company->number_sqf . ' ' . $company->number_sqf_suffix, $companyHidden->number_sqf, $status) }}</h3>
									</li>
								
									<li class="row">
										<h4 class="col-md-6">{{trans('deal.price_per_area_unit')}}</h4>
										<h3 class="col-md-6">{{ $company->getPrivateField($company, $company->format($company->price_sqf) . ' ' . $company->price_sqf_suffix, $companyHidden->price_sqf, $status) }}
										</h3>
									</li>
								@endif

								@if($company->type == 'vc' || $company->type == 'pe')
									<li class="row">
										<h4 class="col-md-6">{{trans('deal.price_per_share')}}</h4>
										<h3 class="col-md-6">{{ $company->getPrivateField($company, $company->format($company->price_shares) . ' ' . $company->price_shares_suffix, $companyHidden->price_shares, $status) }}
										</h3>
									</li>
								
									<li class="row">
										<h4 class="col-md-6">{{trans('deal.number_of_shares')}}</h4>
										<h3 class="col-md-6">{{ $company->getPrivateField($company, $company->format($company->number_shares), $companyHidden->number_shares, $status) }}
										</h3>
									</li>
								
									<li class="row">
										@if($company->type == 'vc')
											<h4 class="col-md-6">{{trans('deal.revenue')}}</h4>
										@elseif($company->type == 'pe')
											<h4 class="col-md-6">{{trans('deal.price_earning')}} (P/E)</h4>
										@endif
										
										<h3 class="col-md-6">{{ $company->getPrivateField($company, $company->price_earning . 'x', $companyHidden->price_earning, $status) }}
										</h3>
									</li>
								
									<li class="row">
										<h4 class="col-md-6">{{trans('deal.percentage_from_company')}} </h4>
										<h3 class="col-md-6">{{ $company->getPrivateField($company, $company->percentage . '%', $companyHidden->percentage, $status) }}
										</h3>
									</li>
								@endif

								@if($company->type == 'vc')
									<li class="row">
										<h4 class="col-md-6">{{trans('deal.growth_rate')}}</h4>
										<h3 class="col-md-6">{{ $company->getPrivateField($company, $company->growth_rate . '%', $companyHidden->growth_rate, $status) }}</h3>
									</li>
								@endif

								<li class="row">
									<h4 class="col-md-6">{{trans('deal.leverage_ratio')}}</h4>
									<h3 class="col-md-6">{{ $company->getPrivateField($company, $company->leverage_ratio . '%', $companyHidden->leverage_ratio, $status) }}</h3>
								</li>
							</ul>
			    		</div>
			    	</div>
		    		<div class="col-md-4 details-box">
		    			<ul class="list-unstyled clearfix">
		    				<li>
		    					<h4>{{trans('deal.deal_owner')}}: <a href="{{ URL::route('profile.view', $company->user->id) }}">{{ $company->user->nickname ? $company->user->nickname : $company->user->firstname . ' ' . $company->user->lastname  }}</a>
		    					</h4>
		    				</li>
							<li>
								<h4>{{trans('deal.minimum_investment')}}</h4>
								<h2>{{ $company->getPrivateField($company, $company->format($company->min_investment) . ' ' . $company->min_investment_suffix, $companyHidden->min_investment, $status) }}
								</h2>
							</li>
							<li class="clearfix">
								<h4>{{trans('deal.sector')}}</h4>
								<h2>{{ trans('deal.sectors.'.$company->sector) }}</h2>
							</li>
							<li class="investment-progress">
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
							</li>
							<li class="investment-btns">
								@if (Auth::check())
									<?php  $bookmarked = $company->bookmarked(Auth::user()->id, $company->id); ?>
									@if($bookmarked)
										<a href="javascript:void(0);" data-href="{{URL::route('bookmark.popup', array($company->id, 'remove'))}}" data-title=" {{trans('general.remove')}} {{trans('deal.bookmark')}}" class="btn btn-danger popup"><span class="glyphicon glyphicon-check"></span> {{trans('general.remove')}} {{trans('deal.bookmark')}}</a>
									@else
										<a href="javascript:void(0);" data-href="{{URL::route('bookmark.popup', array($company->id, 'add'))}}" data-title="{{trans('deal.bookmark')}}" class="btn btn-primary popup"><span class="glyphicon glyphicon-check"></span> {{trans('deal.bookmark')}}</a>
									@endif
								@else
									<a href="javascript:void(0);" data-href="{{URL::route('bookmark.popup', array($company->id, 'add'))}}" data-title="Bookmark" class="btn btn-primary popup"><span class="glyphicon glyphicon-check"></span> {{trans('deal.bookmark')}}</a>
								@endif 

								@if (Auth::check())
									@if (!$company->hasPrivateInfo($company->id))
										<a href="#" class="btn btn-default disabled"><span class="glyphicon glyphicon-info-sign"></span> {{trans('deal.no_private_info')}}</a>
									@elseif(isOwner($company->user_id))
										<a href="#Attachments" class="btn btn-default"> <span class="glyphicon glyphicon-eye-open"></span> {{trans('deal.see_private_info')}}</a>
									@elseif ($status == false)
										<a href="javascript:void(0);" data-href="{{URL::route('request.popup', $company->id)}}" class="btn btn-default popup" data-title="{{trans('deal.request_private_info')}}"><span class="glyphicon glyphicon-info-sign"></span> {{trans('deal.request_info')}}</a>
									@elseif($status == 'accepted')
										<a href="#Attachments" class="btn btn-default"> <span class="glyphicon glyphicon-eye-open"></span> {{trans('deal.see_private_info')}}</a>
									@elseif($status == 'rejected')
										<a href="#" class="btn btn-default disabled"  data-title="Pending"><span class="glyphicon glyphicon-info-sign"></span> {{trans('deal.request_rejected')}}</a>
									@elseif ($status == 'pending') 
										<a href="#" class="btn btn-default disabled"  data-title="Pending"><span class="glyphicon glyphicon-info-sign"></span> {{trans('deal.pending')}}</a>
									@endif
								@else
									<a href="javascript:void(0);" data-href="{{URL::route('request.popup', $company->id)}}" class="btn btn-default <?php $company->hasPrivateInfo($company->id) ? print "popup" : print "disabled"; ?>"  data-title="{{trans('deal.request_private_info')}}"><span class="glyphicon glyphicon-info-sign"></span> {{trans('deal.request_info')}}</a>
								@endif
							</li>
							@if(Auth::check())
								@if(Auth::user()->id != $company->user_id)
									<li class="investment-btns">
										<?php $message = messageExists($company->id, 'Company'); ?>
										@if($message)
											<a href="{{URL::route('message.view', $message->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></span> {{trans('deal.view_conversation')}}</a>
										@else
											<a href="javascript:void(0);" data-href="{{URL::route('send.message.popup',array($company->id, 'company') )}}" class="btn btn-default popup" data-title="{{trans('deal.contact_deal_lister')}}"><span class="glyphicon glyphicon-envelope"></span> {{trans('deal.send_message')}}</a>
										@endif
									</li>
								@endif
							@endif
						</ul>
		    		</div>
				</div>
		    </div>
		</div>

    	<div class="row company-row">
			<div class="col-md-6">
				<div class="hline"></div>
				<div class="company-box clearfix">
					<h3 class="box-title">{{trans('deal.basic_info')}}</h3>
					<ul class="list-unstyled clearfix">
						<li>
							<h4 class="col-md-4">{{trans('deal.listing_name')}}</h4>
							<h3 class="col-md-8">{{ $company->getPrivateField($company, $company->name, $companyHidden->name, $status) }}
							</h3>
						</li>
						@if($company->name_arabic)
						<li>
							<h4 class="col-md-4">{{trans('deal.arabic_listing_name')}}</h4>
							<h3 class="col-md-8">{{ $company->getPrivateField($company, $company->name_arabic, $companyHidden->name_arabic, $status) }}
							</h3>
						</li>
						@endif
						<li>
							<h4 class="col-md-4">{{trans('deal.founded_year')}}</h4>
							<h3 class="col-md-8">{{ $company->getPrivateField($company, $company->started, $companyHidden->started, $status) }}
							</h3>
						</li>
						<li>
							<h4 class="col-md-4">{{trans('deal.brief')}}</h4>
							<h4 class="col-md-8">{{ trimWords($company->brief, 60) }}</h4>
						</li>
						<li>
							<h4 class="col-md-4">{{	trans('deal.geographical_region')}}</h4>
							<h3 class="col-md-8">
								<?php $count = count($company->geo_interests); $i=0?> 
								@foreach($company->geo_interests as $geo)
									<?php $i++; ?>
									@if($count == $i)
										{{ trans('deal.geos.'.$geo) }}
									@else
										{{ trans('deal.geos.'.$geo) . ', ' }}
									@endif
								@endforeach
							</h3>
						</li>
					</ul>
				</div>
			</div>

			@if($company->show_contact)
			    <div class="col-md-6">
			    	<div class="hline"></div>
			    	<div class="company-box clearfix">
			    		<h3 class="box-title">{{trans('deal.contact_info')}}</h3>
			    		<ul class="list-unstyled clearfix">
							<li>
								<h4 class="col-md-4">{{trans('deal.address')}}</h4>
								<h3 class="col-md-8">
									{{ $company->getPrivateField($company, $company->address, $companyHidden->address, $status) }}
								</h3>
							</li>
							<li>
								<h4 class="col-md-4">{{trans('deal.city')}}</h4>
								<h3 class="col-md-8">{{ $company->city }}</h3>
							</li>
							<li>
								<h4 class="col-md-4">{{trans('deal.country')}}</h4>
								<h3 class="col-md-8">{{ $company->country }}</h3>
							</li>
							<li>
								<h4 class="col-md-4">{{trans('deal.phone_number')}}</h4>
								<h3 class="col-md-8">{{ $company->getPrivateField($company, $company->phone, $companyHidden->phone, $status) }}</h3>
							</li>
							<li>
								<h4 class="col-md-4">{{trans('deal.email')}}</h4>
								<h3 class="col-md-8">{{ $company->getPrivateField($company, $company->email, $companyHidden->email, $status) }}</h3>
							</li>
							<li>
								<h4 class="col-md-4">{{trans('deal.website')}}</h4>
								<h4 class="col-md-8"><strong>{{ $company->getPrivateField($company, '<a href=http://'. $company->website .' target="_blank">'.$company->website . '</a>', $companyHidden->website, $status) }}
									</strong></h4>
							</li>
						</ul>
					</div>
			    </div>
		    @else
			    <div class="col-md-6">
			    	<div class="hline"></div>
			    	<div class="company-box">
			    		<h3 class="box-title">{{trans('deal.location_map')}} {{$company->getPrivateField($company, $company->map, $companyHidden->map, $status, array('pending' => '('.trans('deal.request_pending').')', 'rejected' => '('.trans('deal.request_rejected').')', 'request' => '(<a href="javascript:void(0);" data-href="'.URL::route("request.popup", $company->id).'" class="popup" data-title='.trans("deal.request_private_info").'>'.trans("deal.request_location").'</a>)')) }}</h3>
			    		<div class="map clearfix" id="map-canvas" style="height: 241px;">
							<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
					        <script>
					            function initialize() {
					              var marker = null;
					              var pos="{{ $company->getPrivateField($company, $company->map, $companyHidden->map, $status, array('pending' => '', 'rejected' => '', 'request' => '')) }}";
					              var setMarker = false;
					              if(pos){
					                setMarker = true;
					              }else{
					                pos = '26.194877,23.598633';
					              }
					              pos = pos.split(',');

					              var map = new google.maps.Map(document.getElementById('map-canvas'), {
					                zoom: 4,
					                center: new google.maps.LatLng(pos[0], pos[1])  
					              });

					              if(setMarker){
					                var latlng = new google.maps.LatLng(pos[0], pos[1]);
					                 marker = new google.maps.Marker({
					                  position: latlng,
					                  map: map
					                });

					                map.panTo(latlng);
					              }
					            }
					            google.maps.event.addDomListener(window, 'load', initialize);
					        </script>
					        <div id="map-canvas" style="height:250px;"></div>
						</div>
					</div>
			    </div>
		    @endif

		</div>

		@if($company->description)
		<div class="company-row">
			<div class="hline"></div>
		    <div class="col-md-12">
		    	<div class="company-box row">
		    		<h3 class="clearfix box-title">{{trans('deal.description')}}</h3>
		    		<?php $show_video = $company->getPrivateField($company, $company->video, $companyHidden->video, $status, array('pending' => false, 'rejected' => false, 'request' => false)) ?>

		    		<div class="{{($company->video && $show_video) ? 'col-md-6' : 'col-md-12'}}">
			    		<p><?php $show_description = $company->getPrivateField($company, trimWords($company->description, 180), $companyHidden->description, $status, array('pending' => false, 'rejected' => false, 'request' => false)) ?>
			    			@if($show_description)
			    					{{ $company->description }}
			    			@else
			    				@if($status == "pending")
			    					{{trimWords($company->brief, 180) . ' <b>('.trans('deal.request_pending').')</b>'}}
			    				@elseif($status == "rejected")
			    					{{trimWords($company->brief, 180) . ' <b>('.trans('deal.request_rejected').')</b>'}}
			    				@else
			    					{{trimWords($company->brief, 180) . ' <a href="javascript:void(0);" data-href="'.URL::route("request.popup", $company->id).'" class="popup" data-title=' . trans("deal.request_private_info") .'>'.trans("deal.request_more_description").'</a>'}}
			    				@endif
			    			@endif
			    		</p>
			    	</div>
			    	@if($company->video && $show_video)
				    	<div class="col-md-6 video-box">
				    		<iframe width="100%" height="300" src="{{ str_replace('watch?v=', 'embed/', $company->video) }}" frameborder="0" allowfullscreen></iframe>
			    		</div>
		    		@endif
				</div>
		    </div>
		</div>
		@endif
		
		@if($company->show_contact)
			<div class="row company-row">
			    <div class="col-md-6">
			    	<div class="hline"></div>
			    	<div class="company-box">
			    		<h3 class="box-title">{{trans('deal.location_map')}} {{$company->getPrivateField($company, '', $companyHidden->map, $status, array('pending' => '('.trans('deal.request_pending').')', 'rejected' => '('.trans('deal.request_rejected').')', 'request' => '(<a href="javascript:void(0);" data-href="'.URL::route("request.popup", $company->id).'" class="popup" data-title=' . trans("deal.request_private_info") .'>'.trans("deal.request_location").'</a>)')) }}</h3>
			    		
				    		<div class="map clearfix" id="map-canvas" style="height: 241px;">
								<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
						        <script>
						            function initialize() {
						              var marker = null;
						              var pos="{{ $company->getPrivateField($company, $company->map, $companyHidden->map, $status, array('pending' => '', 'rejected' => '', 'request' => '')) }}";
						              var setMarker = false;
						              if(pos){
						                setMarker = true;
						              }else{
						                pos = '26.194877,23.598633';
						              }
						              pos = pos.split(',');

						              var map = new google.maps.Map(document.getElementById('map-canvas'), {
						                zoom: 4,
						                center: new google.maps.LatLng(pos[0], pos[1])  
						              });

						              if(setMarker){
						                var latlng = new google.maps.LatLng(pos[0], pos[1]);
						                 marker = new google.maps.Marker({
						                  position: latlng,
						                  map: map
						                });

						                map.panTo(latlng);
						              }
						            }
						            google.maps.event.addDomListener(window, 'load', initialize);
						        </script>
						        <div id="map-canvas" style="height:250px;"></div>
							</div>
					</div>
			    </div>
				
				<div class="col-md-6">
			    	<div class="hline"></div>
			    	<div class="company-box social-box">
			    		<h3 class="box-title">{{trans('deal.social_links')}} {{ $company->getPrivateField($company, '', $companyHidden->social, $status, array('pending' => '('.trans('deal.request_pending').')', 'rejected' => '('.trans('deal.request_rejected').')', 'request' => '(<a href="javascript:void(0);" data-href="'.URL::route("request.popup", $company->id).'" class="popup" data-title=' . trans("deal.request_private_info") .'>'.trans("deal.request_social_links").'</a>)')) }}</h3>
			    		<ul class="list-unstyled clearfix">
			    			<?php $show_social = $company->getPrivateField($company, $company->social, $companyHidden->social, $status, array('pending' => false, 'rejected' => false, 'request' => false));
			    			?>
			    			@if($show_social)
	                        @foreach (Config::get('ilosool.social') as $key => $value)
	                            <li>
									<a {{ isset($company->social[$key]) ? 'href="' . $company->social[$key] . '" title="' . $value . '" class="available"' : 'href="javascript:void(0);" class="disabled" title="Not Available"' }} target="_blank">
										<img src="{{ isset($company->social[$key]) ? asset('images/company-social/company-' . $key . '.png') : asset('images/company-social/company-gray-' . $key . '.png') }}" />
									</a>
								</li>
	                        @endforeach
	                        @else
	                        @foreach (Config::get('ilosool.social') as $key => $value)
	                            <li>
									<a href="javascript:void(0);" class="disabled" title="Not Available" target="_blank">
										<img src="{{ asset('images/company-social/company-gray-' . $key . '.png') }}" />
									</a>
								</li>
	                        @endforeach
	                        @endif
						</ul>
					</div>
			    </div>
			</div>
		@endif
		<div class="row company-row">
		    <div id="Staff" class="col-md-6">
		    	<div class="hline"></div>
		    	<div class="company-box staff-box">
		    		<h3 class="box-title">{{trans('deal.listing_staff')}}</h3>
		    		@if($company->hasPrivateStaff() && $status != "accepted" && !isOwner($company->user_id))
		    			<div class="request">
		    				@if($status == "pending")
		    					<span>{{trans('deal.request_pending')}}</span>
		    				@elseif($status == "rejected")
		    					<span>{{trans('deal.request_rejected')}}</span>
		    				@else
		    					<a href="javascript:void(0);" data-href="{{ URL::route('request.popup', $company->id) }}" class="popup" data-title="{{trans('deal.request_private_info')}}">{{trans('deal.request_staff')}}</a>
		    				@endif
		    			</div>
	    			@endif
		    		@if(count($staff) > 0)
			    		<ul class="list-unstyled clearfix">
			    			@foreach($staff as $s)
								<li>
									<a class="clearfix animation popup" href="{{ URL::route('staff.view', array($company->id,$s->id))}}" data-title="{{trans('deal.staff_info')}}">
										<div class="staff-img col-md-2">
											<img src="{{ ($s->image) ? asset($s->getImage()) : asset('images/default-staff-img.png') }}"/>
										</div>
										<div class="staff-info col-md-10">
											<h4 class="staff-name">{{ $s->name }}</h4>
											<h4 class="staff-pos">{{ $s->position }}</h4>
											<h4>{{ trans('general.'.$s->access) }}</h4>
											<h4 class="staff-des">{{ trimWords($s->description, 18) }}</h4>
										</div>
									</a>
								</li>
							@endforeach
						</ul>
					@elseif(!$company->hasPrivateStaff())
						<h2 class="empty-msg">{{trans('deal.no_members')}}</h2>
					@endif
				</div>
		    </div>
			
			<div id="Attachments" class="col-md-6">
		    	<div class="hline"></div>
		    	<div class="company-box files-box">
		    		<h3 class="box-title">{{trans('deal.listing_attachments')}}</h3>
		    		@if($company->hasPrivateAttachments() && $status != "accepted" && !isOwner($company->user_id))
		    			<div class="request">
		    				@if($status == "pending")
		    					<span>{{trans('deal.request_pending')}}</span>
		    				@elseif($status == "rejected")
		    					<span>{{trans('deal.request_rejected')}}</span>
		    				@else
		    					<a href="javascript:void(0);" data-href="{{ URL::route('request.popup', $company->id) }}" class="popup" data-title="{{trans('deal.request_private_info')}}">{{trans('deal.request_attachments')}}</a>
		    				@endif
		    			</div>
	    			@endif
		    		@if(count($attachments) > 0)
			    		<ul class="list-unstyled clearfix">
			    			@foreach($attachments as $attachment)
								<li class="clearfix animation">
									<div class="col-md-8">
										<h3>{{$attachment->name}}</h3>
										<h4>{{trans('general.'.$attachment->access)}}</h4>
									</div>
									<div class="col-md-4">
										<a href="{{ asset($attachment->getFullPath()) }}" target="_blank" title="Get File" class="btn btn-default"><span class="glyphicon glyphicon-cloud-download"></span> {{trans('deal.download')}}</a>
									</div>
								</li>
							@endforeach
						</ul>
					@elseif(!$company->hasPrivateAttachments())
						<h2 class="empty-msg">{{trans('deal.no_files')}}</h2>
					@endif
				</div>
		    </div>
		</div>
	</div>
	@include('common.socialbar')
@stop