@extends('layouts.user')

@section('title')
  Profile Info Edit
@stop

@section('user_content')
    @parent
    <div class="page-content">
        <h2 class="page-title">{{trans('profile.profile_info.edit_profile_info')}}</h2>
   
        {{ Form::model($user, array('route' => array('profile.info.edit.post'),
                            'files' => true,
                            'class' => 'form-horizontal profile-form')) }}
                            
            <div class="form-group {{ $errors->first('firstname') ? 'has-error' : '' }}">
               <label for="firstname" class="control-label col-md-2"><span class="required">*</span> {{trans('profile.profile_info.first_name')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.first_name")}}'>[?]</a></label>
                <div class="col-md-8">
                    {{ Form::text('firstname', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-9 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('firstname') }}</div>
                </div>
            </div>

            <div class="form-group {{ $errors->first('lastname') ? 'has-error' : '' }}">
                <label for="lastname" class="control-label col-md-2"><span class="required">*</span> {{trans('profile.profile_info.last_name')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.last_name")}}'>[?]</a></label>
                <div class="col-md-8">
                    {{ Form::text('lastname', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-9 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('lastname') }}</div>
                </div>
            </div>

            <!--  @if($user->user_type == strtolower(Config::get('ilosool.user_type.agent')) || $user->id == 1)
                <div class="form-group  {{ $errors->first('company_name') ? 'has-error' : '' }}">
                {{ Form::label('company_name', trans('profile.profile_info.company_name'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-8">
                        {{ Form::text('company_name', null, array('class' => 'form-control')) }}
                    </div>
                     <div class="col-md-8 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('company_name') }}</div>
                    </div>
                </div>
            @endif -->

            <div class="form-group {{ $errors->first('brief') ? 'has-error' : '' }}">
               <label for="brief" class="control-label col-md-2">{{trans('profile.profile_info.brief')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.brief")}}'>[?]</a></label>
                <div class="col-md-8">
                    {{ Form::textarea('brief', null, array('class' => 'form-control editor')) }}
                </div>
                <div class="col-md-9 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('brief') }}</div>
                </div>
            </div>

            <div class="form-group">
                <label for="hidden_name" class="control-label col-md-2">{{trans('profile.profile_info.hide_name')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.hide_name")}}'>[?]</a></label>
                <div class="col-md-8">
                    {{ Form::checkbox('hidden_name', null, array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                <label for="hidden_contact_info" class="control-label col-md-2">{{trans('profile.profile_info.hide_contact')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.hide_contact")}}'>[?]</a></label>
                <div class="col-md-8">
                    {{ Form::checkbox('hidden_contact_info', null, array('class' => 'form-control')) }}
                </div>
            </div>

            <div class="form-group">
                <label for="subscribed" class="control-label col-md-2">{{trans('profile.profile_info.subscribe')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.subscribe")}}'>[?]</a></label>
                <div class="col-md-8">
                    {{ Form::checkbox('subscribed', null, array('class' => 'form-control')) }}
                </div>
            </div>

            <!-- <div class="form-group {{ $errors->first('nickname') ? 'has-error' : '' }}">
              {{ Form::label('nickname', 'Nickname', array('class' => 'control-label col-md-2')) }}
              <div class="col-md-8">
                   {{ Form::text('nickname', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-2">
                    <div class="toggle toggle-modern" data-target="#hidden_nickname" data-value="{{ Input::old('hidden_nickname') ? Input::old('hidden_nickname') : ($user->id ? $user->hidden_nickname : 1) }}"></div>
                    {{ Form::checkbox('hidden_nickname', 1, Input::old('nickname') ? Input::old('nickname') : ($user->hidden_nickname ? $user->hidden_nickname : null), array('id' => 'hidden_nickname','class' => 'hide')) }}
                </div>
                <div class="col-md-9 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('nickname') }}</div>
                </div>
            </div> -->

            <div class="form-group">
                {{ Form::label('nickname', trans('profile.profile_info.nickname'), array('class' => 'control-label col-md-2')) }}
                <div class="col-md-8 control-label">
                   {{ $user->nickname }}
                </div>
            </div>

            <div class="form-group">
                {{ Form::label('email', trans('profile.profile_info.email'), array('class' => 'control-label col-md-2')) }}
                <div class="col-md-8 control-label">
                   {{ $user->email }}
                </div>
            </div>

            <!-- <div class="form-group {{ $errors->first('birth') ? 'has-error' : '' }}">
                {{ Form::label('birth', 'Date of birth', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-10">
                    {{ Form::date('birth', isset($user->birth) ? $user->birth : Input::old('birth'), array('class' => 'form-control')) }}
                </div>
                <div class="col-md-10 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('birth') }}</div>
                </div>
            </div> -->

            <div class="form-group">
                {{ Form::label('image', trans('profile.profile_info.image'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-3">
                        @if(isset($user))
                            @if($user->image)
                                <img src="{{ asset($user->getImage()) }}" class="img-responsive img-thumbnail" />
                            @else
                                <img src="{{ asset(Config::get('ilosool.default_user_image')) }}" class="img-responsive img-thumbnail"/>
                            @endif
                        @endif
                        {{ Form::file( 'image', '', null, array('class' => 'form-control')) }}
                    </div>
            </div>

            <div class="form-group">
                {{ Form::label('cover', trans('profile.profile_info.cover'), array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-3">
                        @if(isset($user))
                            @if($user->cover)
                                <img src="{{ asset($user->getCover()) }}" class="img-responsive img-thumbnail" />
                            @else
                                <img src="{{ asset(Config::get('ilosool.default_company_image')) }}" class="img-responsive img-thumbnail"/>
                            @endif
                        @endif
                        {{ Form::file('cover', '', null, array('class' => 'form-control')) }}
                    </div>
            </div>

            @if($user->user_type == strtolower(Config::get('ilosool.user_type.agent')))
                <div class="form-group {{ $errors->first('rbc') ? 'has-error' : '' }}">
                    <label for="rbc" class="control-label col-md-2"><span class="required">*</span> {{trans('profile.profile_info.regular_buyer_commission')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.rbc")}}'>[?]</a></label>
                    <div class="col-md-8">
                        {{ Form::text('rbc', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-9 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('rbc') }}</div>
                    </div>
                </div>

                <div class="form-group {{ $errors->first('rsc') ? 'has-error' : '' }}">
                  <label for="rsc" class="control-label col-md-2"><span class="required">*</span> {{trans('profile.profile_info.regular_seller_commission')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.rsc")}}'>[?]</a></label>
                  <div class="col-md-8">
                       {{ Form::text('rsc', null, array('class' => 'form-control')) }}
                    </div>
                    <div class="col-md-9 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('rsc') }}</div>
                    </div>
                </div>
            @endif

            <div class="form-group {{ $errors->first('city') ? 'has-error' : '' }}">
                <label for="city" class="control-label col-md-2"><span class="required">*</span> {{trans('profile.profile_info.city')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.city")}}'>[?]</a></label>
                <div class="col-md-8">
                    {{ Form::text('city', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-9 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('city') }}</div>
                </div>
            </div>

            <div class="form-group {{ $errors->first('country') ? 'has-error' : '' }}">
                 <label for="country" class="control-label col-md-2"><span class="required">*</span> {{trans('profile.profile_info.country')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.country")}}'>[?]</a></label>
                <div class="col-md-8">
                    {{ Form::select('country', Config::get('countries'), null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-9 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('country') }}</div>
                </div>
            </div>

            <div class="form-group {{ $errors->first('address') ? 'has-error' : '' }}">
                <label for="country" class="control-label col-md-2"><span class="required">*</span> {{trans('profile.profile_info.address')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.address")}}'>[?]</a></label>
                <div class="col-md-8">
                    {{ Form::textarea('address', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-9 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('address') }}</div>
                </div>
            </div>

            <div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
                <label for="phone" class="control-label col-md-2"><span class="required">*</span> {{trans('profile.profile_info.phone')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content='{{trans("profile.hint.phone")}}'>[?]</a></label>
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
                    {{ Form::submit(trans('general.save'), array('class' => 'btn btn-primary')) }}
                    <a href="{{ URL::route('profile') }}" class="btn btn-default">{{trans('general.cancel')}}</a>
                </div>
            </div>

        {{ Form::close() }}
    </div>
@stop