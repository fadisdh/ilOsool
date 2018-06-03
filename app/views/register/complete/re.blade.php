<div class="form-group">
    <div class="checkbox asset-class re-asset-class col-md-10 col-md-offset-1">
        {{ Form::checkbox('re_interested','re_interested','',array('id' => 're_interested')) }}
        {{ Form::label('re_interested', trans('deal.im_intrested_in') . trans('deal.re')) }}
    </div>
</div>
<div class="re_asset_class_form">
    <div class="form-group {{ $errors->first('re_geo_interests') ? 'has-error' : '' }}">
       {{ Form::label('re_geo_interests[]', trans('deal.geo_interests'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('geo_interests', 're_geo_interests[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('re_geo_interests') }}</div>
        </div>
    </div>

    <div class="form-group {{ $errors->first('re_investment_stage') ? 'has-error' : '' }}">
        {{ Form::label('re_investment_stage[]', trans('deal.investment_stage'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('re_investment_stage', 're_investment_stage[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('re_investment_stage') }}</div>
        </div>
    </div>

    <div class="form-group {{ $errors->first('re_investment_type') ? 'has-error' : '' }}">
        {{ Form::label('re_investment_type[]', trans('deal.investment_type'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('investment_type', 're_investment_type[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('re_investment_type') }}</div>
        </div>
    </div>

    <div class="form-group {{ $errors->first('re_investment_style') ? 'has-error' : '' }}">
        {{ Form::label('re_investment_style[]', trans('deal.investment_style'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('investment_style', 're_investment_style[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('re_investment_style') }}</div>
        </div>
    </div>

    <div class="form-group {{ $errors->first('re_deal_size') ? 'has-error' : '' }}">
        {{ Form::label('re_deal_size[]', trans('deal.deal_size'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('re_deal_size', 're_deal_size[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('re_deal_size') }}</div>
        </div>
    </div>

    <div class="form-group {{ $errors->first('re_sector_interests') ? 'has-error' : '' }}">
       {{ Form::label('re_sector_interests[]', trans('deal.investment_sector'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
        <div class="col-md-9">
            {{ getCheckboxes('re_sector_interests', 're_sector_interests[]', 'col-md-4') }}
        </div>
        <div class="col-md-9 col-md-offset-3">
            <div class="help-block">{{ $errors->first('re_sector_interests') }}</div>
        </div>
    </div>
</div>
<div class="form-group stepper-btns">
    <div class="col-md-12">
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="2"><span class="glyphicon glyphicon-chevron-left"></span> {{trans('general.back')}}</a>
         <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="4">{{trans('general.next')}} <span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>
