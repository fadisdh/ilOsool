@extends('layouts.site')

@section('title')
  {{ $request->user->firstname . ' ' . $request->user->lastname }}
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
					url: "{{ URL::route('request.view', $request->id) }}",
					title: "ilOsool Deal Request",
					description: "{{ trimWords($request->brief, 500) }}",
					via: 'ilOsool',
					media: "{{ asset('images/default-company-img.jpg') }}"
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
	<div class="company-banner" style="background-image:url({{asset('images/default-company-img.jpg')}});">
		<div class="info">
			<div class="container">
				<div class="row info-wrapper">
					<div class="company-logo col-md-3">
						<img src="{{ ($request->user->image) ? asset($request->user->getImage()) : asset('images/default-logo-img.png') }}" />
					</div>
					<div class="company-title col-md-9">
						@if($request->user->user_type == 'company')
				            <h2>{{ $request->user->company_name }}</h2>
				        @else
				            @if($request->user->nickname)
				                <h2>{{ $request->user->nickname }}</h2>
				            @else
				            	@if(!$request->user->hidden_name)
				                	<h2>{{ $request->user->firstname . ' ' .  $request->user->lastname }}</h2>
				                @else
				                	<h2>{{trans('general.private')}}</h2>
			                	@endif
				            @endif
				        @endif
						<h4>{{trans('general.'.$request->user->user_type)}}</h4>
						<h4>
							@if($request->user->pe_interested)
								PE 
							@endif
							@if($request->user->vc_interested)
								VC 
							@endif
							@if($request->user->re_interested)
								RE 
							@endif
						</h4>
						@if(Auth::check())
							<h4>
								<?php $message = messageExists($request->id, 'RequestDeal'); ?>
								@if($message)
									<a href="{{URL::route('message.view', $message->id)}}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-envelope"></span> {{trans('general.view_conversation')}}</a>
								@else
									<a href="javascript:void(0);" data-href="{{URL::route('send.message.popup', array($request->id, 'request')) }}" class="btn btn-primary btn-xs popup" data-title="Contact Deal Requester"><span class="glyphicon glyphicon-envelope"></span> {{trans('general.send_message')}}</a>
								@endif
							</h4>
						@endif
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
					<h3 class="box-title">{{trans('request.basic_info')}}</h3>
					<div class="col-md-8 info-area">
						<div class="col-md-6">
							<ul class="list-unstyled clearfix">
								<li>
									<h4 class="col-md-6">{{trans('request.asset_class')}}</h4>
									<h3 class="col-md-6">{{ trans('general.'.Config::get('ilosool.type.'.$request->asset_class)) }}</h3>
								</li>
								<li>
									<h4 class="col-md-6">{{trans('request.geo_interests')}}</h4>
									<h3 class="col-md-6">
										@if($request->geo_interests)
											<?php $count = count($request->geo_interests); $i=0?> 
											@foreach($request->geo_interests as $value)
												<?php $i++; ?>
												@if($count == $i)
													{{ trans('deal_values.'.$value) }}
												@else
													{{ trans('deal_values.'.$value) . ', ' }}
												@endif
											@endforeach
										@else
											{{trans('general.not_set')}}
										@endif
									</h3>
								</li>
								<li>
									<h4 class="col-md-6">{{trans('request.deal_size')}}</h4>
									<h3 class="col-md-6">
										@if($request->deal_size)
											<?php $count = count($request->deal_size); $i=0?> 
											@foreach($request->deal_size as $value)
												<?php $i++; ?>
												@if($count == $i)
													{{ trans('deal_values.'.$value) }}
												@else
													{{ trans('deal_values.'.$value) . ', ' }}
												@endif
											@endforeach
										@else
											{{trans('general.not_set')}}
										@endif
									</h3>
								</li>
								@if($request->asset_class == 'vc')
									<li>
										<h4 class="col-md-6">{{trans('request.growth_rate')}}</h4>
										<h3 class="col-md-6">{{ $request->growth_rate . '%' }}
										</h3>
									</li>
									<li>
										<h4 class="col-md-6">{{trans('request.revenue')}}</h4>
										<h3 class="col-md-6">{{ $request->format($request->revenue) .' ' .  $request->revenue_suffix }}
										</h3>
									</li>
								@endif
								@if($request->asset_class == 'pe')
									<li>
										<h4 class="col-md-6">{{trans('request.maximum_price_earning')}}</h4>
										<h3 class="col-md-6">{{ $request->price_earning ? $request->price_earning . "x" : trans('general.not_set')}}
										</h3>
									</li>
								@endif
								@if($request->asset_class == 're')
									<li>
										<h4 class="col-md-6">{{trans('request.minimum_yield')}}</h4>
										<h3 class="col-md-6">{{ $request->yield ? $request->yield . "%" : trans('general.not_set')}}
										</h3>
									</li>
								@endif
							</ul>
						</div>
						<div class="col-md-6">
			    			<ul class="list-unstyled clearfix">
			    				<li>
									<h4 class="col-md-6">{{trans('request.investment_sector')}}</h4>
									<h3 class="col-md-6">
										@if($request->investment_sector)
											<?php $count = count($request->investment_sector); $i=0?> 
											@foreach($request->investment_sector as $value)
												<?php $i++; ?>
												@if($count == $i)
													{{ trans('deal_values.'.$value) }}
												@else
													{{ trans('deal_values.'.$value) . ', ' }}
												@endif
											@endforeach
										@else
											{{trans('general.not_set')}}
										@endif
									</h3>
								</li>
								<li>
									<h4 class="col-md-6">{{trans('request.investment_stage')}}</h4>
									<h3 class="col-md-6">
										@if($request->investment_stage)
											<?php $count = count($request->investment_stage); $i=0?> 
											@foreach($request->investment_stage as $value)
												<?php $i++; ?>
												@if($count == $i)
													{{ trans('deal_values.'.$value) }}
												@else
													{{ trans('deal_values.'.$value) . ', ' }}
												@endif
											@endforeach
										@else
											{{trans('general.not_set')}}
										@endif
									</h3>
								</li>
								<li>
									<h4 class="col-md-6">{{trans('request.investment_type')}}</h4>
									<h3 class="col-md-6">
										@if($request->investment_type)
											<?php $count = count($request->investment_type); $i=0?> 
											@foreach($request->investment_type as $value)
												<?php $i++; ?>
												@if($count == $i)
													{{ trans('deal_values.'.$value) }}
												@else
													{{ trans('deal_values.'.$value) . ', ' }}
												@endif
											@endforeach
										@else
											{{trans('general.not_set')}}
										@endif
									</h3>
								</li>
								<li>
									<h4 class="col-md-6">{{trans('request.investment_style')}}</h4>
									<h3 class="col-md-6">
										@if($request->investment_style)
											<?php $count = count($request->investment_style); $i=0?> 
											@foreach($request->investment_style as $value)
												<?php $i++; ?>
												@if($count == $i)
													{{ trans('deal_values.'.$value) }}
												@else
													{{ trans('deal_values.'.$value) . ', ' }}
												@endif
											@endforeach
										@else
											{{trans('general.not_set')}}
										@endif
									</h3>
								</li>
							</ul>
			    		</div>
					</div>
					<div class="col-md-4 details-box">
		    			<ul class="list-unstyled clearfix">
		    				<li>
		    					<h4>{{trans('deal.deal_owner')}}: <a href="{{ URL::route('profile.view', $request->user->id) }}">{{ $request->user->nickname ? $request->user->nickname : $request->user->firstname . ' ' . $request->user->lastname  }}</a>
		    					</h4>
		    				</li>
							<li class="investment-dealsize">
								<h4>{{trans('deal.deal_size')}}</h4>
								<h4 class="dealsize">
									@if($request->deal_size)
										<?php $count = count($request->deal_size); $i=0?> 
										@foreach($request->deal_size as $value)
											<?php $i++; ?>
											@if($count == $i)
												{{ trans('deal_values.'.$value) }}
											@else
												{{ trans('deal_values.'.$value) . ', ' }}
											@endif
										@endforeach
									@else
										{{trans('general.not_set')}}
									@endif
								</h4>
							</li>
							<li class="clearfix">
								<h4>{{trans('request.asset_class')}}</h4>
								<h2>
									{{ trans('general.'.Config::get('ilosool.type.'.$request->asset_class)) }}
								</h2>
							</li>
							<li class="investment-btns">
								@if(Auth::check())
									<h4>
									<?php $message = messageExists($request->id, 'RequestDeal'); ?>
									@if($message)
										<a href="{{URL::route('message.view', $message->id)}}" class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span> {{trans('general.view_conversation')}}</a>
									@else
										<a href="javascript:void(0);" data-href="{{URL::route('send.message.popup', array($request->id, 'request')) }}" class="btn btn-primary popup" data-title="Contact Deal Requester"><span class="glyphicon glyphicon-envelope"></span> {{trans('general.send_message')}}</a>
									@endif
									</h4>
								@endif
							</li>							
						</ul>
		    		</div>
				</div>
			</div>
		</div>

		<div class="row company-row">
			<div class="col-md-12">
				<div class="hline"></div>
				<div class="company-box clearfix brief">
					<h3 class="box-title">{{trans('request.one_liner')}}</h3>
					<div class="col-md-12 textarea-box">{{ $request->brief }}</div>
				</div>
			</div>
		</div>

		@if($request->description)
			<div class="row company-row">
				<div class="col-md-12">
					<div class="hline"></div>
					<div class="company-box clearfix">
						<h3 class="box-title">{{trans('request.description')}}</h3>
						<div class="col-md-12 textarea-box">{{ $request->description ? $request->description : trans('general.not_set')}}</div>
					</div>
				</div>
			</div>
		@endif
	</div>
	@include('common.socialbar')
@stop