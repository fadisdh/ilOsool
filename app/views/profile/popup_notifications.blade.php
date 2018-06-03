<a href="javascript:void(0);" id="notifications-icon" class="notifications-icon notifications-opener" data-ref="#notifications-wrapper" data-url="{{ URL::route("profile.notifications.switch")}}"><span class="glyphicon glyphicon-globe"> </span>
	@if($unread)
		<span class="badge">{{ $unread }}</span>
	@endif
</a>
<div id="notifications-wrapper" class="notifications-wrapper notifications-box">
	<h3>{{trans('menu.topmenu.notifications')}}</h3>
	<ul class="list-unstyled">
		@if(count($notifications) > 0)
			@foreach ($notifications as $nf)
				<li>
					<a href="{{$nf->url}}" class="row {{ ($nf->viewed) ? 'viewed' : '' }}">
						<img src="{{ asset('images/default-staff-img.png') }}" class="col-md-2" />
						<div class="col-md-10">
							@if(getLocale() == 'ar')
								@if($nf->title_arabic)
									<p>{{ $nf->title_arabic }}</p>
								@elseif($nf->message_arabic)
									<p>{{ $nf->message_arabic }}</p>
								@else
									<p>{{ $nf->title ?  $nf->title : $nf->message }}</p>
								@endif
							@else
								<p>{{ $nf->title ?  $nf->title : $nf->message }}</p>
							@endif
							<h4>{{ date("M d, Y", strtotime($nf->updated_at)) }}</h4>
						</div>
					</a>
				</li>
			@endforeach
		@else
			<li><h3 class="no-result">{{trans('profile.notifications.no_notifications')}}!</h3></li>
		@endif
		
		<li class="see-all">
			<a href="{{ URL::route('profile.notifications') }}#topmenu" class="row">{{trans('general.see_all')}}...</a>
		</li>
	</ul>
	<div class="hline"></div>
</div>