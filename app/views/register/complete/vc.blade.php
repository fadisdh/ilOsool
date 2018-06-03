<div class="form-group">
    <div class="checkbox asset-class vc-asset-class col-md-10 col-md-offset-1">
        {{ Form::checkbox('vc_interested','vc_interested','',array('id' => 'vc_interested')) }}
        {{ Form::label('vc_interested', trans('deal.im_intrested_in') . trans('deal.vc')) }}
    </div>
</div>
<div class="vc_asset_class_form">
    <div class="form-group {{ $errors->first('vc_geo_interests') ? 'has-error' : '' }}">
       {{ Form::label('vc_geo_interests[]', trans('deal.geo_interests'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('geo_interests', 'vc_geo_interests[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('vc_geo_interests') }}</div>
        </div>
    </div>

    <div class="form-group {{ $errors->first('vc_sector_interests') ? 'has-error' : '' }}">
        {{ Form::label('vc_sector_interests[]', trans('deal.investment_sector'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('vc_sector_interests', 'vc_sector_interests[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('vc_sector_interests') }}</div>
        </div>
    </div>

    <div class="form-group {{ $errors->first('vc_investment_stage') ? 'has-error' : '' }}">
        {{ Form::label('vc_investment_stage[]', trans('deal.investment_stage'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('vc_investment_stage', 'vc_investment_stage[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('vc_investment_stage') }}</div>
        </div>
    </div>

    <div class="form-group {{ $errors->first('vc_investment_type') ? 'has-error' : '' }}">
        {{ Form::label('investment_type[]', trans('deal.investment_type'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('investment_type', 'vc_investment_type[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('vc_investment_type') }}</div>
        </div>
    </div>

    <div class="form-group {{ $errors->first('vc_investment_style') ? 'has-error' : '' }}">
        {{ Form::label('vc_investment_style[]', trans('deal.investment_style'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('investment_style', 'vc_investment_style[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('vc_investment_style') }}</div>
        </div>
    </div>

    <div class="form-group {{ $errors->first('vc_deal_size') ? 'has-error' : '' }}">
        {{ Form::label('vc_deal_size[]', trans('deal.deal_size'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('vc_deal_size', 'vc_deal_size[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('vc_deal_size') }}</div>
        </div>
    </div>
</div>
<div class="form-group stepper-btns">
    <div class="col-md-12">
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="1"><span class="glyphicon glyphicon-chevron-left"></span> {{trans('general.back')}}</a>
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="3">{{trans('general.next')}} <span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>