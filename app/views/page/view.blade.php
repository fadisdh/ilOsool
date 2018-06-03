@extends('layouts.site')

@section('title')
	 {{ $page->title }}
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
				<h2 class="page-title">{{ getLocale() == 'en' ? $page->title : $page->title_arabic }}</h2>
				<?php
					$pattern = '/ilOsool/';
					$replacement = '<a class="ilosool-name popover-right" data-toggle="popover" data-placement="auto">ilOsool</a>';
					getLocale() == 'en' ? $content = $page->content : $content =  $page->content_arabic;
				?>
				<div>{{ preg_replace($pattern, $replacement, $content) }}</div>
			</div>
		</div>
	</div>  	
@stop