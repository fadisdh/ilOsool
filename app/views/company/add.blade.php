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
                
                    <div class="profile-stepper">
                        <div id="stepper-bar" class="stepper-bar">
                            <div class="bar"></div>
                            <div class="bar-fill" style="width: 15%;"></div>
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
                                <li id="4" class="point point4">
                                    <span>4</span>
                                    <div class="point-title">{{trans('deal.investment_info')}}</div>
                                </li>
                            </ul>
                        </div>

                        <div id="stepper" class="stepper">
                            <div class="stepper-wrapper">
                                {{ Form::model($company, array('route' => array('company.add.post', $company->id),
                                'files' => true,
                                'class' => 'form-horizontal')) }}
                                    <div class="stepper-item">
                                        @include('company.form.info')
                                    </div>
                                    <div class="stepper-item">
                                        @include('company.form.detailes')
                                    </div>
                                    <div class="stepper-item">
                                        @include('company.form.financial')
                                    </div>
                                    <div class="stepper-item">
                                        @include('company.form.investment')
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