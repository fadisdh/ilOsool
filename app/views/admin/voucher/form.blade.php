<div class="form-group {{ $errors->first('user') ? 'has-error' : '' }}">
    {{ Form::label('user', 'User', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        @if(isset($voucher))
            {{ Form::text('user', null, array('class' => 'form-control', 'id' => 'user_autocomplete', 'data-id' => $voucher->user_id, 'data-name' => $voucher->user->firstname . ' ' . $voucher->user->lastname . " '" . $voucher->user->email . "'" )) }}
        @else
            {{ Form::text('user', null, array('class' => 'form-control', 'id' => 'user_autocomplete')) }}
        @endif
        <div class="help-block">{{ $errors->first('user') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('company') ? 'has-error' : '' }}">
    {{ Form::label('company', 'Company', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        @if(isset($voucher))
            {{ Form::text('company', null, array('class' => 'form-control', 'id' => 'company_autocomplete', 'data-id' => $voucher->company_id, 'data-name' => $voucher->company->name )) }}
        @else
            {{ Form::text('company', null, array('class' => 'form-control', 'id' => 'company_autocomplete')) }}
        @endif
        <div class="help-block">{{ $errors->first('company') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('type') ? 'has-error' : '' }}">
    {{ Form::label('type', 'Type', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::select('type', Config::get('ilosool.voucher_type'), null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-3 col-md-offset-2">
        <div class="help-block">{{ $errors->first('type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('data') ? 'has-error' : '' }}">
    {{ Form::label('data', 'Data', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::textarea('data', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-3 col-md-offset-2">
        <div class="help-block">{{ $errors->first('data') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('price') ? 'has-error' : '' }}">
    {{ Form::label('price', 'Price', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('price', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-3 col-md-offset-2">
        <div class="help-block">{{ $errors->first('price') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('start_date') ? 'has-error' : '' }}">
    {{ Form::label('start_date', 'Start Date', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::datetime('start_date', isset($voucher->start_date) ? $voucher->start_date : Input::old('start_date'), array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('start_date') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('end_date') ? 'has-error' : '' }}">
    {{ Form::label('end_date', 'End Date', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::datetime('end_date', isset($voucher->end_date) ? $voucher->end_date : Input::old('end_date'), array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('end_date') }}</div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::route('admin.pages') }}" class="btn btn-default">Cancel</a>
    </div>
</div>

{{ Form::token(); }}