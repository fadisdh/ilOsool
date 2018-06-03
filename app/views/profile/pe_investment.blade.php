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
        {{ Form::model($user, array('route' => array('profile.pe.investment.edit.post'),
                            'files' => true,
                            'class' => 'form-horizontal profile-form')) }}
            <div class="form-group col-md-12 {{ $errors->first('pe_interested') ? 'has-error' : '' }}">
                <div class="checkbox asset-class">
                    {{ Form::checkbox('pe_interested','pe_interested', null,array('id' => 'pe_interested')) }}
                    {{ Form::label('pe_interested', trans('profile.edit_investment_info.intrest_pe'), array('class' => 'control-label')) }}
                </div>
                <div class="col-md-12">
                    <div class="help-block">{{ $errors->first('pe_interested') }}</div>
                </div>
            </div>
            <div class="asset_class_form">
                <div class="form-group {{ $errors->first('pe_geo_interests') ? 'has-error' : '' }}">
                    {{ Form::label('pe_geo_interests[]', trans('profile.edit_investment_info.geo_interests'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('geo_interests', 'pe_geo_interests[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('pe_geo_interests') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('pe_sector_interests') ? 'has-error' : '' }}">
                    {{ Form::label('pe_sector_interests[]', trans('profile.edit_investment_info.sector_interests'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('pe_sector_interests', 'pe_sector_interests[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('pe_sector_interests') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('pe_investment_stage') ? 'has-error' : '' }}">
                    {{ Form::label('pe_investment_stage[]', trans('profile.edit_investment_info.investment_stage'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('pe_investment_stage', 'pe_investment_stage[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('pe_investment_stage') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('pe_investment_type') ? 'has-error' : '' }}">
                    {{ Form::label('pe_investment_type[]', trans('profile.edit_investment_info.investment_type'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('investment_type', 'pe_investment_type[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('pe_investment_type') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('pe_investment_style') ? 'has-error' : '' }}">
                    {{ Form::label('pe_investment_style[]', trans('profile.edit_investment_info.investment_style'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('investment_style', 'pe_investment_style[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('pe_investment_style') }}</div>
                    </div>
                </div>

    	        <div class="form-group {{ $errors->first('pe_deal_size') ? 'has-error' : '' }}">
    	            {{ Form::label('pe_deal_size[]', trans('profile.edit_investment_info.deal_size'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-10">
                        {{ getCheckboxes('pe_deal_size', 'pe_deal_size[]', 'col-md-4') }}
                    </div>
                    <div class="col-md-10 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('pe_deal_size') }}</div>
                    </div>
    	        </div>
            </div>
            {{ Form::token(); }}
            <div class="form-group">
                <div class="col-md-10">
                    {{ Form::submit(trans('general.save'), array('class' => 'btn btn-primary')) }}
                    <a href="{{ URL::route('profile.investment.pe') }}" class="btn btn-default">{{trans('general.cancel')}}</a>
                </div>
            </div>
        {{ Form::close() }}
	</div>
@stop
