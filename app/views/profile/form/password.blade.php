@extends('layouts.user')

@section('title')
  Profile Password Edit
@stop

@section('user_content')
    @parent
    <div class="page-content">
        <h2 class="page-title">{{trans('profile.profile_info.edit_password')}}</h2>
   
        {{ Form::model($user, array('route' => array('profile.password.edit.post'),
                            'files' => true,
                            'class' => 'form-horizontal profile-form')) }}
                            
            <div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
                {{ Form::label('password', trans('profile.profile_info.password'), array('class' => 'control-label col-md-2')) }}
                <div class="col-md-10">
                    {{ Form::password('password', array('class' => 'form-control')) }}
                </div>
                <div class="col-md-10 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('password') }}</div>
                </div>
            </div>

            <div class="form-group {{ $errors->first('password_confirmation') ? 'has-error' : '' }}">
                {{ Form::label('password_confirmation ', trans('profile.profile_info.password_confirm'), array('class' => 'control-label col-md-2')) }}
                <div class="col-md-10">
                    {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
                </div>
                <div class="col-md-10 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('password_confirmation') }}</div>
                </div>
            </div>

            {{ Form::token(); }}
        
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    {{ Form::submit(trans('general.save'), array('class' => 'btn btn-primary')) }}
                    <a href="{{ URL::route('profile') }}" class="btn btn-default">{{trans('general.cancel')}}</a>
                </div>
            </div>

        {{ Form::close() }}
    </div>
@stop