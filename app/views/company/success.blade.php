@extends('layouts.site')

@section('title')
    Listing Success
@stop

@section('content')
    <div class="profile">
        <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
        <div class="container-fluid">
            <div class="profile-container">
                @include('profile.topmenu')

                <div class="container">
                    <h3 class="page-title">{{trans('deal.new_deal_success')}}</h3>
                    <div class="page-text">{{trans('deal.new_deal_info')}}</div>
                    <div class="row iconboxes clearfix">
                        <div class="iconboxes-wrapper">
                            <a class="col-md-4 iconbox anim" href="{{ URL::route('staff', $company_id) }}">
                                <img class="iconboxes-img" src="{{ asset('images/add-staff.png') }}" />
                                <div class="iconboxes-button anim">{{trans('deal.add_staff')}}</div> 
                            </a>                
                            <a class="col-md-4 iconbox anim" href="{{ URL::route('attachments', $company_id) }}">
                                <img class="iconboxes-img" src="{{ asset('images/add-atachment.png') }}" />
                                <button class="iconboxes-button anim">{{trans('deal.add_attachments')}}</button> 
                            </a>
                            <a class="col-md-4 iconbox anim" href="{{ URL::route('profile.companies') }}">
                                <img class="iconboxes-img" src="{{ asset('images/add-skip.png') }}" />
                                <button class="iconboxes-button anim">{{trans('deal.skip_step')}}</button> 
                            </a>
                        </div><!-- .iconboxes-wrapper-->
                    </div><!-- .iconboxes -->
                </div><!-- .container -->
            </div>
        </div>  
    </div>
@stop