@extends('layouts.site')

@section('title')
  Company Registration
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
            <!-- <div class="hline"></div> -->
            <div class="register-type row">
                <a href="{{ URL::route('register.individual') }}" class="col-md-4">Register as an Investor</a>
                <a href="{{ URL::route('register.company') }}" class="col-md-4 selected">Register as Lister</a>
                <a href="{{ URL::route('register.both') }}" class="col-md-4">Register as Investor & Lister</a>
            </div>
            <div class="page-content">
                <h2 class="page-title">Register as a Lister</h2>
                {{ Form::model($user, array('route' => 'register.company.post', 'class' => 'form-horizontal')) }}
                    <div id="stepper-bar" class="stepper-bar stepper-bar-3">
                        <div class="bar"></div>
                        <div class="bar-fill" style="width:25%;"></div>
                        <ul class="points list-unstyled">
                            <li id="1" class="point point1 selected">
                                <span>1</span>
                                <div class="point-title">General Info</div>
                            </li>
                            <li id="2" class="point point2">
                                <span>2</span>
                                <div class="point-title">Contact Info</div>
                            </li>
                            <li id="3" class="point point3">
                                <span>3</span>
                                <div class="point-title">Confirm Registration</div>
                            </li>
                        </ul>
                    </div>

                    <div id="stepper" class="stepper">
                        <ul class="list-unstyled stepper-wrapper">
                            <li class="stepper-item">
                                @include('register.form.info')
                            </li>
                            <li class="stepper-item">
                                @include('register.form.contact')
                            </li>
                            <li class="stepper-item">
                                @include('register.form.confirm')
                            </li> 
                        </ul>
                    </div>
                {{ Form::token(); }}
            	{{ Form::close() }}
            </div>
        </div>
    </div>
@stop