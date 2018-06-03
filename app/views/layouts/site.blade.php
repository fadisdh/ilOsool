@extends('layouts.master')

@section('styles')
    @parent
		{{ HTML::style('css/style.css') }}
	    {{ HTML::style('css/footer.css') }}
	@stop

	@section('scripts')
	    @parent
	@stop

	@section('header')
		@parent
		@include('common.header')
	@stop

	@section('content')
		@parent
		@include('common.content')
	@stop

	@section('footer')
		@parent
		@include('common.footer')
	@stop