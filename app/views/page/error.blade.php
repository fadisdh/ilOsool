@extends('layouts.site')

@section('title')
  Error
@stop

@section('content')
    @parent
    <div class="page-img">
        <img src="{{ asset('images/default-page-img.jpg') }}" />
    </div>
    <div class="container">
        <div class="page-container">
            <div class="hline"></div>
            <div class="page-content page-notfound">
                <h2 class="page-title">{{trans('general.messages.page_not_found')}}</h2>
                <p>{{trans('general.messages.page_not_found')}}!</p>
            </div>
        </div>
    </div>      
@stop