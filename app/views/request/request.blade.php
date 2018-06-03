@extends('layouts.site')

@section('title')
  Request Deal
@stop

@section('content')
    <div class="profile">
        <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
        <div class="container-fluid">
            <div class="profile-container">
                @include('profile.topmenu')
                <div class="row company-type clearfix">
                    <div class="type-boxes">
                        <h3>{{trans('request.select_asset_class')}}</h3>
                        <div class="col-md-4">
                            <a href="{{ URL::route('request.deal.add', 'pe')}}" class="yellow-bg">
                                <h1>PE</h1>
                                <h3>{{trans('general.pe')}}</h3>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::route('request.deal.add', 'vc')}}" class="green-bg">
                                <h1>VC</h1>
                                <h3>{{trans('general.vc')}}</h3>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::route('request.deal.add', 're')}}" class="blue-bg">
                                <h1>RE</h1>
                                <h3>{{trans('general.re')}}</h3>
                            </a>
                        </div>
                    </div>
                </div><!---category-container end here-->
            </div>
        </div>  
    </div>
@stop