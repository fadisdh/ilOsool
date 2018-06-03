@extends('layouts.site')

@section('title')
  Registration Confirm
@stop

@section('content')
	@parent

    <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
    <div class="container">
        <div class="page-container">
            <div class="hline"></div>
            <div class="page-content register-success">
                <h2 class="page-title">{{ getLocale() == 'en' ? $page->title : $page->title_arabic }}</h2>
                <p>{{ getLocale() == 'en' ? $page->content : $page->content_arabic }}</p>
            </div>
        </div>
    </div>
@stop