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
        {{ Form::model($user, array('route' => array('profile.re.investment.edit.post'),
                            'files' => true,
                            'class' => 'form-horizontal profile-form')) }}
            <div class="form-group col-md-12 {{ $errors->first('re_interested') ? 'has-error' : '' }}">
                <div class="checkbox asset-class">
                    {{ Form::checkbox('re_interested','re_interested', null,array('id' => 're_interested')) }}
                    {{ Form::label('re_interested', trans('profile.edit_investment_info.intrest_re'), array('class' => 'control-label')) }}
                </div>
                <div class="col-md-12">
                    <div class="help-block">{{ $errors->first('re_interested') }}</div>
                </div>
            </div>
            <div class="asset_class_form">
                <div class="form-group {{ $errors->first('re_geo_interests') ? 'has-error' : '' }}">
                    {{ Form::label('re_geo_interests[]', trans('profile.edit_investment_info.geo_interests'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('geo_interests', 're_geo_interests[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('re_geo_interests') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('re_sector_interests') ? 'has-error' : '' }}">
                   {{ Form::label('re_sector_interests[]',  trans('profile.edit_investment_info.sector_interests'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('re_sector_interests', 're_sector_interests[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('re_sector_interests') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('re_investment_stage') ? 'has-error' : '' }}">
                    {{ Form::label('re_investment_stage[]', trans('profile.edit_investment_info.investment_stage'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('re_investment_stage', 're_investment_stage[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('re_investment_stage') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('re_investment_type') ? 'has-error' : '' }}">
                    {{ Form::label('re_investment_type[]', trans('profile.edit_investment_info.investment_type'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('investment_type', 're_investment_type[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('re_investment_type') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('re_investment_style') ? 'has-error' : '' }}">
                    {{ Form::label('re_investment_style[]', trans('profile.edit_investment_info.investment_style'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('investment_style', 're_investment_style[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('re_investment_style') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('re_deal_size') ? 'has-error' : '' }}">
                    {{ Form::label('re_deal_size[]', trans('profile.edit_investment_info.deal_size'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('re_deal_size', 're_deal_size[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('re_deal_size') }}</div>
                    </div>
                </div>
            </div>
            {{ Form::token(); }}
            <div class="form-group">
                <div class="col-md-10">
                    {{ Form::submit(trans('general.save'), array('class' => 'btn btn-primary')) }}
                    <a href="{{ URL::route('profile.investment.re') }}" class="btn btn-default">{{trans('general.cancel')}}</a>
                </div>
            </div>
            
        {{ Form::close() }}
	</div>
@stop
