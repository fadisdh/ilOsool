@extends('layouts.site')

@section('title')
  Individual
@stop

@section('content')
	@parent
	<div class="page-img">
		<img src="{{ ($page->image) ? asset($page->getImage()) : asset('images/default-page-img.jpg') }}" />
	</div>
	<div class="container">
		<div class="page-container">
			<div class="hline"></div>
			<div class="page-content">
				<h2 class="page-title">{{ $page->title }}</h2>

				<div>{{ $page->content }}</div>
				@if(!Auth::check())
					<a href="javascript:void(0);" data-href="{{ URL::route('register.popup')}}?type=individual" data-title="Register as Individual" class="btn btn-lg btn-primary popup">{{trans('general.register_now')}} <span class="glyphicon glyphicon-chevron-right"></a>
				@endif
			</div>
		</div>
	</div>  	
@stop