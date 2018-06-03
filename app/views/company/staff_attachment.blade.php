@extends('layouts.site')

@section('title')
    Staff & Attachments
@stop

@section('content')
    <div class="profile">
        <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
        <div class="container-fluid">
            <div class="profile-container">
                @include('profile.topmenu')

                <div class="container">
                    <h3 class="page-title">Your Deal Has Been Added Successfully</h3>
                    <div class="page-text">Thank you for adding a new deal, it will appear to public after addministartion approval, do you want to add:</div>
                    <div class="row iconboxes clearfix">
                        <div class="iconboxes-wrapper">
                            <a class="col-md-4">
                            
                                    <img class="iconboxes-img" src="{{ asset('images/add-staff.png') }}" />
                                    
                                
                            </a>
                            <div class="col-md-4">
                            </div>
                            <!--<div class="col-md-4">
                                
                                    <img class="iconboxes-img" src="{{ asset('images/add-atachment.png') }}" />
                                    <a href="#" class="iconboxes-button anim">Add Attachments</a>
                                
                            </div>
                            <div class="col-md-4">
                                
                                    <img class="iconboxes-img" src="{{ asset('images/add-skip.png') }}" />
                                    <a href="#" class="iconboxes-button anim">Skip this step now</a>
                                
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
@stop