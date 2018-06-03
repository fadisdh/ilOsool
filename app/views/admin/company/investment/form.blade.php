
<div class="form-group {{ $errors->first('user_id') ? 'has-error' : '' }}">
    {{ Form::label('user_id', 'Investor ID', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::text('user_id', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('user_id') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('amount') ? 'has-error' : '' }}">
    {{ Form::label('amount', 'Amount', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::text('amount', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('amount') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('value') ? 'has-error' : '' }}">
	{{ Form::label('value', 'Value', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
	   {{ Form::text('value', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('value') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('status') ? 'has-error' : '' }}">
    {{ Form::label('status', 'Status', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::select('status', Config::get('ilosool.investment_status'), null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('status') }}</div>
    </div>
</div>

{{ Form::token(); }}

<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::route('admin.company.investments', isset($investment->company_id) ? $investment->company_id : $company->id) }}" class="btn btn-default">Cancel</a>
    </div>
</div>