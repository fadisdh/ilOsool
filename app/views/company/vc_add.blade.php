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
        @include('profile.topmenu')
        <div class="container">
            @if ($company->id == 0)
                <div class="page-title">{{trans('deal.add_new_listing_type')}} {{trans('deal.venture_capital')}}</div>
            @else 
                <div class="page-title">{{sprintf(trans('deal.deal_edit_form'), $company->deal_name)}}</div>
            @endif
        </div>
        <div class="container-fluid">
            <div class="profile-container">
                    <div class="profile-stepper">
                        <div id="stepper-bar" class="stepper-bar stepper-bar-3">
                            <div class="bar"></div>
                            <div class="bar-fill" style="width: 25%;"></div>
                            <ul class="points list-unstyled">
                                <li id="1" class="point point1 selected">
                                    <span>1</span>
                                    <div class="point-title">{{trans('deal.listing_info')}}</div>
                                </li>
                                <li id="2" class="point point2">
                                    <span>2</span>
                                    <div class="point-title">{{trans('deal.listing_details')}}</div>
                                </li>
                                <li id="3" class="point point3">
                                    <span>3</span>
                                    <div class="point-title">{{trans('deal.financial_info')}}</div>
                                </li>
                            </ul>
                        </div>

                        <div id="stepper" class="stepper">
                            <div class="stepper-wrapper">
                                {{ Form::model($company, array('route' => array('company.vc.add.post', $company->id),
                                'files' => true,
                                'class' => 'form-horizontal')) }}
                                    <div class="stepper-item">
                                        @include('company.form.info')
                                    </div>
                                    <div class="stepper-item">
                                        @include('company.form.detailes')
                                    </div>
                                    <div class="stepper-item">
                                        @include('company.form.vc_investment')
                                    </div>
                                {{ Form::token() }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
            </div>
        </div>  
    </div>
@stop