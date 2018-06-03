@extends('layouts.site')

@section('title')
	 Page Search
@stop

@section('content')
	@parent

	<div class="page-img">
		<div class="page-img">{{ HTML::image('images/news-cover.jpg') }}</div>
	</div>
	<div class="container">
		<div class="page-container">
			<div class="hline"></div>
			<div class="page-content">
				<h2 class="page-title">{{trans('general.search_for')}} - {{ $search }}</h2>
				<ul class="posts-list list-unstyled">
					@if(isset($pages))
						@foreach($pages as $page)
							<li class="row">
								<a href="{{ URL::route('page', $page->slug) }}">
									<h3>{{ $page->title }}</h3>
									<p>{{ trimWords($page->content, 70) }}</p>
								</a>
							</li>
						@endforeach
					@else
						<h3>{{trans('general.no_result')}}</h3>
					@endif
				</ul>
				@if(isset($pages))
					<div class="pagination-tab">{{ $pages->appends(array('search' => Input::get('search')))->links(array('class' => 'pagination')) }}</div>
				@endif
				
			</div>
		</div>
	</div>  	
@stop