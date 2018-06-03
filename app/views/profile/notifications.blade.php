@extends('layouts.user')

@section('inline_script')
	<script type="text/javascript">
		$(function(){
			//status
			$.ajax({
				url: '{{ URL::route("profile.notifications.switch")}}',
				dataType: 'JSON',
				type: 'post'
			});

			//color
			$('#messages a').click(function(){
				$(this).addClass('read');
			});
		});
	</script>        
@stop

@section('title')
  Profile | Notifications
@stop

@section('user_content')
	@parent
	<div class="page-content">
		<h2 class="page-title">{{trans('profile.notifications.notifications')}}</h2>
		<div class="notifications-wrapper">
			<ul class="messages list-unstyled">
				@if(count($notifications) > 0)
					@foreach ($notifications as $nf)
						<li>
							<a class="popup row {{ ($nf->viewed) ? 'viewed' : '' }}" href="{{URL::route('notification.view', $nf->id)}}" data-title="{{trans('profile.notifications.notification')}}">
								<img src="{{ asset('images/default-staff-img.png') }}" class="col-md-1" />
								<div class="col-md-9">
									@if(getLocale() == 'ar')
										<p>{{ $nf->title_arabic ? $nf->title_arabic : $nf->title }}</p>
									@else
										<p>{{ $nf->title }}</p>
									@endif
								</div>
								<h4 class="col-md-2">{{ date("M d, Y", strtotime($nf->updated_at)) }}</h4>
							</a>
						</li>
					@endforeach
				@else
					<h3 class="no-result">{{trans('profile.notifications.no_notifications')}}...</h3>
				@endif
			</ul>
		</div>
		<div class="pagination-tab">{{ $notifications->links() }}</div>
	</div>
@stop
