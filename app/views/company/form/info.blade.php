<div class="form-group {{ $errors->first('deal_name') ? 'has-error' : '' }}">
    <label for="deal_name" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.deal_name')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.deal_name')}}">[?]</a></label>    
    <div class="col-md-7">
        @if($company->id)
            {{ Form::text('deal_name', null, array('class' => 'form-control', 'disabled' => 'disabled')) }}
            {{ Form::hidden('deal_name', null) }}
        @else
            {{ Form::text('deal_name', null, array('class' => 'form-control')) }}
        @endif
        <div class="help-block">{{ $errors->first('deal_name') }}</div>
    </div>
    @if($company->id != 0)
        <div class="col-md-1">
            <a href="javascript:void(0);" data-href="{{URL::route('listing.request.popup', array($company->id, 'edit'))}}" class="btn btn-default popup" data-title="{{trans('deal.request_edit')}}"><span class="glyphicon glyphicon-info-sign"></span> {{trans('deal.request_edit')}}</a>
        </div>
    @endif
</div>

<div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
    <label for="name" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.listing_name')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.name')}}">[?]</a></label>    

    <div class="col-md-7">
        @if($company->id)
           {{ Form::text('name', null, array('class' => 'form-control', 'disabled' => 'disabled')) }} 
           {{ Form::hidden('name', null) }}
        @else
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        @endif
       
        <div class="help-block">{{ $errors->first('name') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#name_hidden" data-value="{{ Input::old('name') ? Input::old('name_hidden') : ($company->id ? $companyHidden->name : 1) }}"></div>
        {{ Form::checkbox('name_hidden', 1, Input::old('name') ? Input::old('name_hidden') : ($companyHidden->name ? $companyHidden->name : null), array('id' => 'name_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('name_arabic') ? 'has-error' : '' }}">
    <label for="name_arabic" class="control-label col-md-2 col-md-offset-1">{{trans('deal.arabic_listing_name')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.name_arabic')}}">[?]</a></label>    

    <div class="col-md-7">
        @if($company->id)
           {{ Form::text('name_arabic', null, array('class' => 'form-control', 'disabled' => 'disabled')) }} 
           {{ Form::hidden('name_arabic', null) }}
        @else
            {{ Form::text('name_arabic', null, array('class' => 'form-control')) }}
        @endif
        <div class="help-block">{{ $errors->first('name_arabic') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#name_arabic_hidden" data-value="{{ Input::old('name_arabic') ? Input::old('name_arabic_hidden') : ($company->id ? $companyHidden->name_arabic : 1) }}"></div>
        {{ Form::checkbox('name_arabic_hidden', 1, Input::old('name_arabic') ? Input::old('name_arabic_hidden') : ($companyHidden->name_arabic ? $companyHidden->name_arabic : null), array('id' => 'name_arabic_hidden','class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('started') ? 'has-error' : '' }}">
    <label for="started" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.founded_year')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.started')}}">[?]</a></label>
    <div class="col-md-7">
       {{ Form::text('started', isset($company->started) ? $company->started : Input::old('started'), array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('started', 'The founding year must be a valid year.') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#started_hidden" data-value="{{ Input::old('started') ? Input::old('started_hidden') : ($company->id ? $companyHidden->started : 1) }}"></div>
        {{Form::checkbox('started_hidden', 1, Input::old('started') ? Input::old('started_hidden') : ($companyHidden->started ? $companyHidden->started : null), array('id' => 'started_hidden' ,'class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
    <label for="email" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.email_address')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.email')}}">[?]</a></label>
    <div class="col-md-7">
       {{ Form::email('email',null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('email') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#email_hidden" data-value="{{ Input::old('email') ? Input::old('email_hidden') : ($company->id ? $companyHidden->email : 1) }}"></div>
        {{Form::checkbox('email_hidden', 1, Input::old('email') ? Input::old('email_hidden') : ($companyHidden->email ? $companyHidden->email : null), array('id' => 'email_hidden' ,'class' => 'hide')) }}
    </div>
</div>

<div class="form-group">
    <label for="website" class="control-label col-md-2 col-md-offset-1">{{trans('deal.website')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.website')}}">[?]</a></label>

    <div class="col-md-7">
        {{ Form::text('website', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#website_hidden" data-value="{{ Input::old('website') ? Input::old('website_hidden') : ($company->id ? $companyHidden->website : 1) }}"></div>
        {{Form::checkbox('website_hidden', 1, Input::old('website') ? Input::old('website_hidden') : ($companyHidden->website ? $companyHidden->website : null), array('id' => 'website_hidden' ,'class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('country') ? 'has-error' : '' }}">
     <label for="country" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.country')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.country')}}">[?]</a></label>
    <div class="col-md-7">
        {{ Form::select('country', Config::get('countries'), null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('country') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('city') ? 'has-error' : '' }}">
    <label for="city" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.city')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.city')}}">[?]</a></label>
    <div class="col-md-7">
       {{ Form::text('city', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('city') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('address') ? 'has-error' : '' }}">
    <label for="address" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.address')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.address')}}">[?]</a></label>
    <div class="col-md-7">
       {{ Form::textarea('address', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('address') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#address_hidden" data-value="{{ Input::old('address') ? Input::old('address_hidden') : ($company->id ? $companyHidden->address : 1) }}"></div>
        {{Form::checkbox('address_hidden', 1, Input::old('address') ? Input::old('address_hidden') : ($companyHidden->address ? $companyHidden->address : null), array('id' => 'address_hidden' ,'class' => 'hide')) }}
    </div>
</div>

<div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
    <label for="phone" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('deal.phone_number')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('deal.hints.phone')}}">[?]</a></label>
    <div class="col-md-7">
        {{ Form::text('phone', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('phone') }}</div>
    </div>
    <div class="col-md-1">
        <div class="toggle toggle-modern" data-target="#phone_hidden" data-value="{{ Input::old('phone') ? Input::old('phone_hidden') : ($company->id ? $companyHidden->phone : 1) }}"></div>
        {{ Form::checkbox('phone_hidden', 1, Input::old('phone') ? Input::old('phone_hidden') : ($companyHidden->phone ? $companyHidden->phone : null), array('id' => 'phone_hidden' ,'class' => 'hide')) }}
    </div>
</div>

<div class="form-group stepper-btns">
    <div class="col-md-12">
        <a href="#" class="btn btn-lg btn-primary disabled"><span class="glyphicon glyphicon-chevron-left"></span> {{trans('general.back')}}</a>
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="2">{{trans('general.next')}} <span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>