@extends('layouts.user')

@section('title')
  Profile Contact Edit
@stop

@section('user_content')
    @parent
    <div class="page-content">
        <h2 class="page-title">Edit Contact Info</h2>
        {{ Form::model($user, array('route' => array('profile.contact.edit.post'),
                            'files' => true,
                            'class' => 'form-horizontal profile-form')) }}
                            
            <div class="form-group {{ $errors->first('city') ? 'has-error' : '' }}">
                <label for="city" class="control-label col-md-2"><span class="required">*</span> City <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="Please enter your current city of residence">[?]</a></label>
                <div class="col-md-8">
                    {{ Form::text('city', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-9 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('city') }}</div>
                </div>
            </div>

            <div class="form-group {{ $errors->first('country') ? 'has-error' : '' }}">
                 <label for="country" class="control-label col-md-2"><span class="required">*</span> Country <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="Please select your current country or territory of residence from the drop-down list">[?]</a></label>
                <div class="col-md-8">
                    {{ Form::select('country', Config::get('countries'), null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-9 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('country') }}</div>
                </div>
            </div>

            <div class="form-group {{ $errors->first('address') ? 'has-error' : '' }}">
                {{ Form::label('address', 'Address', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-8">
                    {{ Form::textarea('address', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-9 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('address') }}</div>
                </div>
            </div>

            <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
                <label for="phone" class="control-label col-md-2">Phone <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="Please Enter your phone number (It must be in phone format, at least 8 – 15 numbers)">[?]</a></label>
                <div class="col-md-8">
                    {{ Form::text('phone', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-9 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('phone') }}</div>
                </div>
            </div>

            {{ Form::token(); }}
        
            <div class="form-group">
                <div class="col-md-9 col-md-offset-2">
                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                    <a href="{{ URL::route('profile.contact') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>

        {{ Form::close() }}
    </div>
@stop