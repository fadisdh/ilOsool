@extends('layouts.master')

@section('styles')
    @parent
    {{ HTML::style('css/admin.css') }}
@stop

@section('scripts')
    @parent
@stop

@section('header')
	@parent
	@include('admin.common.header')
@stop

@section('content')
	@parent
	@include('admin.common.content')
@stop

@section('footer')
	@parent
	@include('admin.common.footer')
@stop