@extends('layouts.user')
@section('scripts')
    @parent
    <script type="text/javascript">
       $(document).ready(function() {
            asset_class = $(".asset-class input");
            if (!$(asset_class).is(":checked")){
                $(".asset_class_form input").attr("disabled", "disabled");
                $(".asset_class_form").css("opacity", "0.6");
            }

            asset_class.click(function() {
                if ($(this).is(":checked")) {
                    $(".asset_class_form input").removeAttr("disabled");
                    $(".asset_class_form").css("opacity", "1");
                } else {
                    $(".asset_class_form input").attr("disabled", "disabled");
                    $(".asset_class_form").css("opacity", "0.6");
                }
            });
        }); 
    </script>
@stop
@section('title')
  Profile | Investment Info
@stop

@section('user_content')
    @parent
    <div class="page-content">
        <h2 class="page-title">{{trans('profile.edit_investment_info.edit_investment_info')}}</h2>
        {{ Form::model($user, array('route' => array('profile.vc.investment.edit.post'),
                            'files' => true,
                            'class' => 'form-horizontal profile-form')) }}
            <div class="form-group col-md-12 {{ $errors->first('vc_interested') ? 'has-error' : '' }}">
                <div class="checkbox asset-class">
                    {{ Form::checkbox('vc_interested','vc_interested', null,array('id' => 'vc_interested')) }}
                    {{ Form::label('vc_interested',  trans('profile.edit_investment_info.intrest_vc'), array('class' => 'control-label')) }}
                </div>
                <div class="col-md-12">
                    <div class="help-block">{{ $errors->first('vc_interested') }}</div>
                </div>
            </div>
            <div class="asset_class_form">
                <div class="form-group {{ $errors->first('vc_geo_interests') ? 'has-error' : '' }}">
                    {{ Form::label('vc_geo_interests[]', trans('profile.edit_investment_info.geo_interests'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('geo_interests', 'vc_geo_interests[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('vc_geo_interests') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('vc_sector_interests') ? 'has-error' : '' }}">
                    {{ Form::label('vc_sector_interests[]', trans('profile.edit_investment_info.sector_interests'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('vc_sector_interests', 'vc_sector_interests[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('vc_sector_interests') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('vc_investment_stage') ? 'has-error' : '' }}">
                    {{ Form::label('vc_investment_stage[]', trans('profile.edit_investment_info.investment_stage'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('vc_investment_stage', 'vc_investment_stage[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('vc_investment_stage') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('vc_investment_type') ? 'has-error' : '' }}">
                    {{ Form::label('vc_investment_type[]',  trans('profile.edit_investment_info.investment_type'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('investment_type', 'vc_investment_type[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('vc_investment_type') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('vc_investment_style') ? 'has-error' : '' }}">
                    {{ Form::label('vc_investment_style[]', trans('profile.edit_investment_info.investment_style'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('investment_style', 'vc_investment_style[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('vc_investment_style') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('vc_deal_size') ? 'has-error' : '' }}">
                    {{ Form::label('vc_deal_size[]', trans('profile.edit_investment_info.deal_size'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('vc_deal_size', 'vc_deal_size[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('vc_deal_size') }}</div>
                    </div>
                </div>
            </div>
            {{ Form::token(); }}
            <div class="form-group">
                <div class="col-md-10">
                    {{ Form::submit(trans('general.save'), array('class' => 'btn btn-primary')) }}
                    <a href="{{ URL::route('profile.investment.vc') }}" class="btn btn-default">{{trans('general.cancel')}}</a>
                </div>
            </div>
            
        {{ Form::close() }}
    </div>
@stop
