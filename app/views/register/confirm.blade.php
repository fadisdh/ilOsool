@extends('layouts.site')

@section('title')
  Register Confirm
@stop

@section('content')
	@parent

    <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
    <div class="container">
        <div class="page-container register-success">
            <div class="hline"></div>
            <div class="page-content">
                <h2>{{ $title }}</h2>
                <p>{{ $message }}</p>
                @if ($confirm == false)
                	<a href="{{ URL::route('register.resend.code') }}?email={{$email}}" class="btn btn-primary popup" data-title="{{trans('register.resend')}}">{{trans('register.resend')}}</a>
                @endif
            </div>
        </div>
    </div>
@stop