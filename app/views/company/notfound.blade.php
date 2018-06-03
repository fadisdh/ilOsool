@extends('layouts.site')

@section('title')
  Listing Not Found
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
                <h2 class="page-title">Listing Not Found</h2>
                <p>This Listing is no longer exists</p>
            </div>
        </div>
    </div>      
@stop