<div class="form-group {{ $errors->first('geo_interests') ? 'has-error' : '' }}">
    <label for="geo_interests[]" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.operation_locations')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.geo_interests')}}">[?]</a></label> 
    <div class="col-md-7">
        {{ getCheckboxes('geo_interests', 'geo_interests[]', 'col-md-4') }}
    </div>
    <div class="col-md-7 col-md-offset-3">
        <div class="help-block">{{ $errors->first('geo_interests') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('investment_stage') ? 'has-error' : '' }}">
    <label for="investment_stage" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.investment_stage')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.investment_stage')}}">[?]</a></label> 
    <div class="col-md-7">
        {{ getSelect('re_investment_stage', 'investment_stage') }}
    </div>
    <div class="col-md-6 col-md-offset-3">
        <div class="help-block">{{ $errors->first('investment_stage') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('investment_type') ? 'has-error' : '' }}">
    <label for="investment_type" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.investment_type')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.investment_type')}}">[?]</a></label> 
    <div class="col-md-7">
        {{ getSelect('investment_type', 'investment_type') }}
    </div>
    <div class="col-md-7 col-md-offset-3">
        <div class="help-block">{{ $errors->first('investment_type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('investment_style') ? 'has-error' : '' }}">
    <label for="investment_style" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.investment_style')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.investment_style')}}">[?]</a></label> 
    <div class="col-md-7">
        {{ getSelect('investment_style', 'investment_style') }}
    </div>
    <div class="col-md-7 col-md-offset-3">
        <div class="help-block">{{ $errors->first('investment_style') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('deal_size') ? 'has-error' : '' }}">
    <label for="deal_size" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.deal_size')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.deal_size')}}">[?]</a></label> 
    <div class="col-md-7">
        {{ getSelect('re_deal_size', 'deal_size') }}
    </div>
    <div class="col-md-7 col-md-offset-3">
        <div class="help-block">{{ $errors->first('deal_size') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('sector') ? 'has-error' : '' }}">
    <label for="sector" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.investment_sector')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.sector')}}">[?]</a></label> 
    <div class="col-md-7">
        {{ getSelect('re_sector_interests', 'sector') }}
    </div>
    <div class="col-md-7 col-md-offset-3">
        <div class="help-block">{{ $errors->first('sector') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('leverage_ratio') ? 'has-error' : '' }}">
    <label for="leverage_ratio" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.leverage_ratio')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.leverage_ratio')}}">[?]</a></label>
    <div class="input-group col-md-7">
        {{ Form::text('leverage_ratio', null, array('class' => 'form-control')) }}
        <span class="input-group-addon">%</span>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#leverage_ratio_hidden" data-value="{{ Input::old('leverage_ratio') ? Input::old('leverage_ratio_hidden') : ($company->id ? $companyHidden->leverage_ratio : 1) }}"></div>
        {{ Form::checkbox('leverage_ratio_hidden', 1, Input::old('leverage_ratio') ? Input::old('leverage_ratio_hidden') : ($companyHidden->leverage_ratio ? $companyHidden->leverage_ratio : null), array('id' => 'leverage_ratio_hidden','class' => 'hide')) }}
    </div>
    <div class="col-md-7 col-md-offset-3">
        <div class="help-block">{{ $errors->first('leverage_ratio') }}</div>
    </div>
</div>

@if( Auth::user()->user_type == strtolower(Config::get('ilosool.user_type.agent')) || Auth::user()->rule_id == 1)
    <div class="form-group {{ $errors->first('cfb') ? 'has-error' : '' }}">
        <label for="cfb" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.commission_from_buyer')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.cfb')}}">[?]</a></label>
        <div class="input-group col-md-7">
            {{ Form::text('cfb', null, array('class' => 'form-control')) }}
            <span class="input-group-addon">%</span>
        </div>
        <div class="col-md-7 col-md-offset-3">
            <div class="help-block">{{ $errors->first('cfb') }}</div>
        </div>
    </div>
@endif

<div class="form-group {{ $errors->first('number_sqf') ? 'has-error' : '' }}">
    <label for="number_sqf" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.built_up_area')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.number_sqf')}}">[?]</a></label> 
    <div class="input-group input-group-select col-md-7">
        {{ Form::text('number_sqf', null, array('class' => 'form-control')) }}
        {{ Form::area('number_sqf_suffix', $company->number_sqf_suffix ? $company->number_sqf_suffix : null) }}
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#number_sqf_hidden" data-value="{{ Input::old('number_sqf') ? Input::old('number_sqf_hidden') : ($company->id ? $companyHidden->number_sqf : 1) }}"></div>
        {{ Form::checkbox('number_sqf_hidden', 1, Input::old('number_sqf') ? Input::old('number_sqf_hidden') : ($companyHidden->number_sqf ? $companyHidden->number_sqf : null), array('id' => 'number_sqf_hidden','class' => 'hide')) }}
    </div>
    <div class="col-md-7 col-md-offset-3">
        <div class="help-block">{{ $errors->first('number_sqf') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('price_sqf') ? 'has-error' : '' }}">
    <label for="price_sqf" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.price_per_area_unit')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.price_sqf')}}">[?]</a></label> 
    <div class="input-group input-group-select col-md-7">
        {{ Form::text('price_sqf', null, array('class' => 'form-control')) }}
        {{ Form::currency('price_sqf_suffix', $company->price_sqf_suffix ? $company->price_sqf_suffix : null) }}
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#price_sqf_hidden" data-value="{{ Input::old('price_sqf') ? Input::old('price_sqf_hidden') : ($company->id ? $companyHidden->price_sqf : 1) }}"></div>
        {{ Form::checkbox('price_sqf_hidden', 1, Input::old('price_sqf') ? Input::old('price_sqf_hidden') : ($companyHidden->price_sqf ? $companyHidden->price_sqf : null), array('id' => 'price_sqf_hidden','class' => 'hide')) }}
    </div>
    <div class="col-md-6 col-md-offset-3">
        <div class="help-block">{{ $errors->first('price_sqf') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('yield') ? 'has-error' : '' }}">
    <label for="yield" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.yield')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.yield')}}">[?]</a></label> 
    <div class="input-group col-md-7">
        {{ Form::text('yield', null, array('class' => 'form-control')) }}
        <span class="input-group-addon">%</span>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#yield_hidden" data-value="{{ Input::old('yield') ? Input::old('yield_hidden') : ($company->id ? $companyHidden->yield : 1) }}"></div>
        {{ Form::checkbox('yield_hidden', 1, Input::old('yield') ? Input::old('yield_hidden') : ($companyHidden->yield ? $companyHidden->yield : null), array('id' => 'yield_hidden','class' => 'hide')) }}
    </div>
    <div class="col-md-7 col-md-offset-3">
        <div class="help-block">{{ $errors->first('yield') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('startdate') ? 'has-error' : '' }}">
    <label for="startdate" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.investment_start_date')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.startdate')}}">[?]</a></label> 
    <div class="col-md-7">
        <?php $date = date('Y-m-d'); ?>
        {{ Form::date('startdate', isset($company->startdate) ? $company->startdate : ( Input::old('startdate') ? Input::old('startdate') : $date ), array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('startdate') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#startdate_hidden" data-value="{{ Input::old('startdate') ? Input::old('startdate_hidden') : ($company->id ? $companyHidden->startdate : 1) }}"></div>
        {{ Form::checkbox('startdate_hidden', 1, Input::old('startdate') ? Input::old('startdate_hidden') : ($companyHidden->startdate ? $companyHidden->startdate : null), array('id' => 'startdate_hidden','class' => 'hide')) }}
    </div>
</div>

<!-- <div class="form-group {{ $errors->first('enddate') ? 'has-error' : '' }}">
    <label for="enddate" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> Investment End Date <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="Please provide date to end the listing">[?]</a></label> 
    <div class="col-md-7">
       {{ Form::date('enddate', isset($company->enddate) ? $company->enddate : Input::old('enddate'), array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('enddate') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#enddate_hidden" data-value="{{ Input::old('enddate') ? Input::old('enddate_hidden') : ($company->id ? $companyHidden->enddate : 1) }}"></div>
        {{ Form::checkbox('enddate_hidden', 1, Input::old('enddate') ? Input::old('enddate_hidden') : ($companyHidden->enddate ? $companyHidden->enddate : null), array('id' => 'enddate_hidden','class' => 'hide')) }}
    </div>
</div> -->

<div class="form-group {{ $errors->first('target') ? 'has-error' : '' }}">
    <label for="target" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.investment_target')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.target')}}">[?]</a></label> 
    <div class="input-group input-group-select  col-md-7">
        {{ Form::text('target', null, array('class' => 'form-control')) }}
        {{ Form::currency('target_suffix', $company->target_suffix ? $company->target_suffix : null) }}
        <div class="help-block">{{ $errors->first('target') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#target_hidden" data-value="{{ Input::old('target') ? Input::old('target_hidden') : ($company->id ? $companyHidden->target : 1) }}"></div>
        {{ Form::checkbox('target_hidden', 1, Input::old('target') ? Input::old('target_hidden') : ($companyHidden->target ? $companyHidden->target : null), array('id' => 'target_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('min_investment') ? 'has-error' : '' }}">
    <label for="min_investment" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.minimum_investment')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.min_investment')}}">[?]</a></label> 
    <div class="input-group input-group-select col-md-7">
        {{ Form::text('min_investment', null, array('class' => 'form-control')) }}
        {{ Form::currency('min_investment_suffix', $company->min_investment_suffix ? $company->min_investment_suffix : null) }}
        <div class="help-block">{{ $errors->first('min_investment') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#min_investment_hidden" data-value="{{ Input::old('min_investment') ? Input::old('min_investment_hidden') : ($company->id ?  $companyHidden->min_investment : 1) }}"></div>
        {{ Form::checkbox('min_investment_hidden', 1, Input::old('min_investment') ? Input::old('min_investment_hidden') : ($companyHidden->min_investment ? $companyHidden->min_investment : null), array('id' => 'min_investment_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group stepper-btns">
    <div class="col-md-12">
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="2"><span class="glyphicon glyphicon-chevron-left"></span> {{trans('general.back')}}</a>
        <button type="submit" class="btn btn-lg btn-primary">{{trans('general.save')}}</button>
    </div>
</div>