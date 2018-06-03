<div class="form-group {{ $errors->first('user_type') ? 'has-error' : '' }}">
    {{ Form::label('user_type', 'User Type', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::select('user_type', Config::get('ilosool.user_type'), null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('user_type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('company_name') ? 'has-error' : '' }}">
    {{ Form::label('company_name', 'Company Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('company_name', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('company_name') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('firstname') ? 'has-error' : '' }}">
   {{ Form::label('firstname', 'First Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('firstname', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('firstname') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('lastname') ? 'has-error' : '' }}">
    {{ Form::label('lastname', 'Last Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('lastname', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('lastname') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('nickname') ? 'has-error' : '' }}">
  {{ Form::label('nickname', 'Nickname', array('class' => 'control-label col-md-2')) }}
  <div class="col-md-10">
       {{ Form::text('nickname', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('nickname') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
    {{ Form::label('email', 'Email', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::email('email', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('email') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
    {{ Form::label('password', 'Password', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::password('password', array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('password') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('password_confirmation') ? 'has-error' : '' }}">
    {{ Form::label('password_confirmation ', 'Password Confirm', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('password_confirmation') }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('image', 'Image', array('class' => 'control-label col-md-2')) }}
        <div class="col-md-10">
            @if(isset($user))
                @if($user->image)
                    <img src="{{ asset($user->getImage()) }}" class="adminview-image" />
                @else
                    <img src="{{ asset(Config::get('ilosool.default_user_image')) }}" />
                @endif
            @endif
            {{ Form::file( 'image', '',null, array('class' => 'form-control')) }}
        </div>
</div>

<div class="form-group {{ $errors->first('city') ? 'has-error' : '' }}">
    {{ Form::label('city', 'City', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('city', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('city') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('country') ? 'has-error' : '' }}">
    {{ Form::label('country', 'Country', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::select('country', Config::get('countries'), null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('country') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('address') ? 'has-error' : '' }}">
    {{ Form::label('address', 'Address', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::textarea('address', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('address') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('rbc') ? 'has-error' : '' }}">
    {{ Form::label('rbc', 'Regular Buyer Commission', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('rbc', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('rbc') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('rsc') ? 'has-error' : '' }}">
    {{ Form::label('rsc', 'Regular Seller Commission', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('rsc', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('rsc') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
    {{ Form::label('phone', 'Phone', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('phone', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('phone') }}</div>
    </div>
</div>

@if(can('user.editstatus'))
    <div class="form-group">
        {{ Form::label('status', 'Status', array('class' => 'control-label col-md-2')) }}
        <div class="col-md-10">
            {{ Form::select('status', Config::get('ilosool.user_status'), null, array('class' => 'form-control')) }}
        </div>
    </div>
@endif

<div class="form-group">
    {{ Form::label('interests', 'Interests:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        <div class="col-md-4">
            <div class="checkbox">
                {{ Form::checkbox('pe_interested','pe', null, array('id' => 'pe')) }}
                {{ Form::label('pe', 'Private Equity') }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="checkbox">
                {{ Form::checkbox('vc_interested','vc', null, array('id' => 'vc')) }}
                {{ Form::label('vc', 'Venture Capital') }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="checkbox">
                {{ Form::checkbox('re_interested','re', null, array('id' => 're')) }}
                {{ Form::label('re', 'Real Estate') }}
            </div>
        </div>
    </div>
</div>

<div class="form-group {{ $errors->first('pe_geo_interests') ? 'has-error' : '' }}">
    {{ Form::label('pe_geo_interests[]', 'PE Geo interests:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('geo_interests', 'pe_geo_interests[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('pe_geo_interests') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('pe_sector_interests') ? 'has-error' : '' }}">
   {{ Form::label('pe_sector_interests[]', 'PE Investment Sector:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('pe_sector_interests', 'pe_sector_interests[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('pe_sector_interests') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('pe_investment_stage') ? 'has-error' : '' }}">
    {{ Form::label('pe_investment_stage[]', 'PE Investment Stage:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('pe_investment_stage', 'pe_investment_stage[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('pe_investment_stage') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('pe_investment_type') ? 'has-error' : '' }}">
    {{ Form::label('pe_investment_type[]', 'PE Investment Type:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('investment_type', 'pe_investment_type[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('pe_investment_type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('pe_investment_style') ? 'has-error' : '' }}">
    {{ Form::label('pe_investment_style[]', 'PE Investment Style:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('investment_style', 'pe_investment_style[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('pe_investment_style') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('pe_deal_size') ? 'has-error' : '' }}">
    {{ Form::label('pe_deal_size[]', 'PE Deal Size:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('pe_deal_size', 'pe_deal_size[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('pe_deal_size') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('vc_geo_interests') ? 'has-error' : '' }}">
   {{ Form::label('vc_geo_interests[]', 'VC Geo Interests:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('geo_interests', 'vc_geo_interests[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('vc_geo_interests') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('vc_sector_interests') ? 'has-error' : '' }}">
   {{ Form::label('vc_sector_interests[]', 'VC Investment Sector:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('vc_sector_interests', 'vc_sector_interests[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('vc_sector_interests') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('vc_investment_stage') ? 'has-error' : '' }}">
    {{ Form::label('vc_investment_stage[]', 'VC Investment Stage:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('vc_investment_stage', 'vc_investment_stage[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('vc_investment_stage') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('vc_investment_type') ? 'has-error' : '' }}">
    {{ Form::label('investment_type[]', 'VC Investment Type:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('investment_type', 'vc_investment_type[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('vc_investment_type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('vc_investment_style') ? 'has-error' : '' }}">
    {{ Form::label('vc_investment_style[]', 'VC Investment Style:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('investment_style', 'vc_investment_style[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('vc_investment_style') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('vc_deal_size') ? 'has-error' : '' }}">
    {{ Form::label('vc_deal_size[]', 'VC Deal Size:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('vc_deal_size', 'vc_deal_size[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('vc_deal_size') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('re_geo_interests') ? 'has-error' : '' }}">
   {{ Form::label('re_geo_interests[]', 'RE Geo Interests:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('geo_interests', 're_geo_interests[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('re_geo_interests') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('re_investment_stage') ? 'has-error' : '' }}">
    {{ Form::label('re_investment_stage[]', 'RE Investment Stage:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('re_investment_stage', 're_investment_stage[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('re_investment_stage') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('re_investment_type') ? 'has-error' : '' }}">
    {{ Form::label('re_investment_type[]', 'RE Investment Type:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('investment_type', 're_investment_type[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('re_investment_type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('re_investment_style') ? 'has-error' : '' }}">
    {{ Form::label('re_investment_style[]', 'RE Investment Style:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('investment_style', 're_investment_style[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('re_investment_style') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('re_deal_size') ? 'has-error' : '' }}">
    {{ Form::label('re_deal_size[]', 'RE Deal Size:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('re_deal_size', 're_deal_size[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('re_deal_size') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('re_sector_interests') ? 'has-error' : '' }}">
   {{ Form::label('re_sector_interests[]', 'RE Investment Sector', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ getCheckboxes('re_sector_interests', 're_sector_interests[]', 'col-md-4') }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('re_sector_interests') }}</div>
    </div>
</div>

@if(can('user.editrule'))
    <div class="form-group {{ $errors->first('rule_id') ? 'has-error' : '' }}">
        {{ Form::label('rule_id', 'Rule', array('class' => 'control-label col-md-2')) }}
        <div class="col-md-10">
            {{ Form::select('rule_id', $rules, null, array( 'class' => 'form-control' )) }}
        </div>
    </div>
     <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('rule_id') }}</div>
    </div>
@endif

<div class="form-group {{ $errors->first('confirmed') ? 'has-error' : '' }}">
    {{ Form::label('confirmed', 'Confirmed', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        @if(isset($user))
            @if($user->confirmed == 1)
                {{ Form::select('confirmed', Config::get('ilosool.confirmed', '1'), null, array('class' => 'form-control')) }}
            @else
                {{ Form::select('confirmed', Config::get('ilosool.confirmed', '0'), null, array('class' => 'form-control')) }}
            @endif
        @else
            {{ Form::select('confirmed', Config::get('ilosool.confirmed', '0'), null, array('class' => 'form-control')) }}
        @endif
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('confirmed') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('subscribed') ? 'has-error' : '' }}">
    {{ Form::label('subscribed', 'Subscribed', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">

        {{ Form::select('subscribed', Config::get('ilosool.subscribed'), null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('subscribed') }}</div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::route('admin.users') }}" class="btn btn-default">Cancel</a>
    </div>
</div>

{{ Form::token(); }}