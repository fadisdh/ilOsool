@extends('layouts.site')
@section('scripts')
    @parent
    <script type="text/javascript">
       $(document).ready(function() {
            pe_asset_class = $(".pe-asset-class input");
            re_asset_class = $(".re-asset-class input");
            vc_asset_class = $(".vc-asset-class input");
            
            if (!$(pe_asset_class).is(":checked")){
                $(".pe_asset_class_form input").attr("disabled", "disabled");
                $(".pe_asset_class_form").css("opacity", "0.6");
            }

            if (!$(re_asset_class).is(":checked")){
                $(".re_asset_class_form input").attr("disabled", "disabled");
                $(".re_asset_class_form").css("opacity", "0.6");
            }

            if (!$(vc_asset_class).is(":checked")){
                $(".vc_asset_class_form input").attr("disabled", "disabled");
                $(".vc_asset_class_form").css("opacity", "0.6");
            }

            pe_asset_class.click(function() {
                if ($(this).is(":checked")) {
                    $(".pe_asset_class_form input").removeAttr("disabled");
                    $(".pe_asset_class_form").css("opacity", "1");
                } else {
                    $(".pe_asset_class_form input").attr("disabled", "disabled");
                    $(".pe_asset_class_form").css("opacity", "0.6");
                }
            });

            re_asset_class.click(function() {
                if ($(this).is(":checked")) {
                    $(".re_asset_class_form input").removeAttr("disabled");
                    $(".re_asset_class_form").css("opacity", "1");
                } else {
                    $(".re_asset_class_form input").attr("disabled", "disabled");
                    $(".re_asset_class_form").css("opacity", "0.6");
                }
            });

            vc_asset_class.click(function() {
                if ($(this).is(":checked")) {
                    $(".vc_asset_class_form input").removeAttr("disabled");
                    $(".vc_asset_class_form").css("opacity", "1");
                } else {
                    $(".vc_asset_class_form input").attr("disabled", "disabled");
                    $(".vc_asset_class_form").css("opacity", "0.6");
                }
            });
        }); 
    </script>
@stop
@section('title')
  Deal Seeker Registration
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
                {{ Form::model($user, array('route' => array('register.investor.post', $type), 'class' => 'form-horizontal')) }}
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="page-title">{{trans('register.register_as_deal_seeker')}}</h2>
                    </div>
                    <div class="col-md-6" style="text-align:right; margin-top: 30px;">
                        <a href="{{ URL::route('register.complete.skip', $type)}}" class="btn btn-lg btn-primary">{{trans('register.skip')}}</a>
                    </div>
                </div>
                    <div id="stepper-bar" class="stepper-bar">
                        <div class="bar"></div>
                        <div class="bar-fill" style="width: 15%;"></div>
                        <ul class="points list-unstyled">
                            <li id="1" class="point point1 selected">
                                <span>1</span>
                                <div class="point-title">{{trans('general.pe')}}</div>
                            </li>
                            <li id="2" class="point point2">
                                <span>2</span>
                                <div class="point-title">{{trans('general.vc')}}</div>
                            </li>
                            <li id="3" class="point point3">
                                <span>3</span>
                                <div class="point-title">{{trans('general.re')}}</div>
                            </li>
                            <li id="4" class="point point4">
                                <span>4</span>
                                <div class="point-title">{{trans('general.submit')}}</div>
                            </li>
                        </ul>
                    </div>

                    <div id="stepper" class="stepper">
                        <ul class="list-unstyled stepper-wrapper">
                            <li class="stepper-item">
                                @include('register.complete.pe')
                            </li>
                            <li class="stepper-item">
                                @include('register.complete.vc')
                            </li>
                            <li class="stepper-item">
                                @include('register.complete.re')
                            </li>
                            <li class="stepper-item">
                               @include('register.complete.confirm')
                            </li>
                        </ul>
                    </div>
                {{ Form::token(); }}
            	{{ Form::close() }}
            </div>
        </div>
    </div>
@stop