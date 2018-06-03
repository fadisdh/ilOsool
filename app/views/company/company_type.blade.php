@extends('layouts.site')

@section('title')
    @if($company->id == 0)
        Add Listing
    @else
        Edit Listing
    @endif
@stop

@section('content')
    <div class="profile">
        <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
        <div class="container-fluid">
            <div class="profile-container">
                @include('profile.topmenu')
                <div class="row company-type clearfix">
                    <div class="type-boxes">
                        <h3>{{trans('deal.select_asset_class')}}</h3>
                        <div class="col-md-4">
                            <a href="{{ URL::route('company.pe.add') }}" class="yellow-bg">
                                <h1>PE</h1>
                                <h3>{{trans('general.pe')}}</h3>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::route('company.vc.add') }}" class="green-bg">
                                <h1>VC</h1>
                                <h3>{{trans('general.vc')}}</h3>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="{{ URL::route('company.re.add') }}" class="blue-bg">
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