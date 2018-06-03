@extends('layouts.site')

@section('title')
  Deal Lister Registration
@stop

@section('content')
	@parent

    <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
    @if(Session::has('action'))
        <div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    @endif
    <div class="container">
        <div class="page-container registration-page">
            <div class="page-content">
                <h2 class="page-title">{{trans('register.register_as_deal_lister')}}</h2>
                <div class="register-lister">
                    <p>{{trans('register.deal_lister_info')}}</p>
                    <div class="col-md-12">
                        <a href="{{ URL::route('register.lister.post')}}?type={{$type}}" class="btn btn-lg btn-primary">{{trans('register.add_a_listing')}}</a>
                        <a href="{{ URL::route('register.lister.post')}}?skiped=1&type={{$type}}" class="btn btn-lg btn-primary">{{trans('register.skip')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop