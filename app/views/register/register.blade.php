@extends('layouts.site')

@section('title')
  Investor Registration
@stop

@section('scripts')
	@parent
	<script type="text/javascript">
		$(function(){
			$('#user_type').change(function(){
				window.location.href = '{{ URL::route('register') }}?type=' + $(this).val();
			});
		});
	</script>
@stop

@section('content')
	@parent

    <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
    @if(Session::has('action'))
        <div class="alert {{ Session::get('result') ? 'alert-success' : 'alert-danger' }}">
            {{ Session::get('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        </div>
    @endif
    <div class="container">
        <div class="page-container registration-page">
            <!-- <div class="hline"></div> -->
            <div class="register-type row">
                <a href="{{ URL::route('register') }}?type=individual" class="col-md-4 {{ ( $type == 'individual' ? 'selected' : '' )}}">{{trans('general.individual')}}</a>
                <a href="{{ URL::route('register') }}?type=company" class="col-md-4 {{ ( $type == 'company' ? 'selected' : '' )}}">{{trans('general.company')}}</a>
                <a href="{{ URL::route('register') }}?type=agent" class="col-md-4 {{ ( $type == 'agent' ? 'selected' : '' )}}">{{trans('general.agent')}}</a>
            </div>
            <div class="page-content">
                <h2 class="page-title">{{trans('general.register_as')}}{{ucfirst(trans('general.'.$type))}}</h2>
                {{ Form::model($user, array('route' => 'register.post', 'class' => 'form-horizontal')) }}
                    <div id="stepper" class="stepper stepper-rtl">
                            <div class="form-group {{ $errors->first('user_type') ? 'has-error' : '' }}">
                            	<label for="user_type" class="control-label col-md-2 col-md-offset-1">{{trans('register.user_type')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.user_type_hint')}}">[?]</a></label>
							    <div class="col-md-8">
							    	@if(getLocale() == 'ar')
							        	{{ Form::select('user_type', Config::get('ilosool.user_type_arabic'), $type, array('class' => 'form-control')) }}
							        @else
							        	{{ Form::select('user_type', Config::get('ilosool.user_type'), $type, array('class' => 'form-control')) }}
							        @endif
							    </div>
							    <div class="col-md-8 col-md-offset-3">
							        <div class="help-block">{{ $errors->first('user_type') }}</div>
							    </div>
							</div>

							@if($type != 'individual' )
								<div class="form-group {{ $errors->first('company_name') ? 'has-error' : '' }}">
									@if($type == 'agent' )
										<label for="company_name" class="control-label col-md-2 col-md-offset-1">{{trans('register.agent_company_name')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.company_name_hint')}}">[?]</a></label>
								    @else
								    	<label for="company_name" class="control-label col-md-2 col-md-offset-1">{{trans('register.company_name')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.company_name_hint')}}">[?]</a></label>
								    @endif
								    <div class="col-md-8">
								        {{ Form::text('company_name', Input::old('company_name'), array('class' => 'form-control')) }}
								    </div>
								    <div class="col-md-8 col-md-offset-3">
								        <div class="help-block">{{ $errors->first('company_name') }}</div>
								    </div>
								</div>
							@endif
							
							<div class="form-group {{ $errors->first('firstname') ? 'has-error' : '' }}">
							    <label for="firstname" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('register.first_name')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.first_name_hint')}}">[?]</a></label>
							    <div class="col-md-8">
							    	{{ Form::text('firstname', Input::old('firstname'), array('class' => 'form-control')) }}
							    </div>
							    
							    <div class="col-md-8 col-md-offset-3">
							        <div class="help-block">{{ $errors->first('firstname') }}</div>
							    </div>
							</div>

							<div class="form-group {{ $errors->first('lastname') ? 'has-error' : '' }}">
								<label for="lastname" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('register.last_name')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.last_name_hint')}}">[?]</a></label>
							    <div class="col-md-8">
							    	{{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control')) }}
							    </div>
							    <div class="col-md-8 col-md-offset-3">
							        <div class="help-block">{{ $errors->first('lastname') }}</div>
							    </div>
							</div>

							<div class="form-group {{ $errors->first('nickname') ? 'has-error' : '' }}">
							    {{ Form::label('nickname', trans('register.nickname'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
							    <div class="col-md-8">
							    	{{ Form::text('nickname', Input::old('nickname'), array('class' => 'form-control')) }}
							    </div>
							    <div class="col-md-8 col-md-offset-3">
							        <div class="help-block">{{ $errors->first('nickname') }}</div>
							    </div>
							</div>

							<div class="form-group {{ $errors->first('email') ? 'has-error' : '' }}">
							    <label for="email" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('register.email_address')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.email_address_hint')}}">[?]</a></label>
							    <div class="col-md-8">
							    	{{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
							    </div>
							    <div class="col-md-8 col-md-offset-3">
							        <div class="help-block">{{ $errors->first('email') }}</div>
							    </div>
							</div>

							<div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
								<label for="password" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('register.password')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.password_hint')}}">[?]</a></label>
							    <div class="col-md-8">
							    	{{ Form::password('password', array('class' => 'form-control')) }}
							    </div>
							    <div class="col-md-8 col-md-offset-3">
							        <div class="help-block">{{ $errors->first('password') }}</div>
							    </div>
							</div>

							<div class="form-group {{ $errors->first('password') ? 'has-error' : '' }}">
							    {{ Form::label('password_confirmation', trans('register.confirm_password'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
							    <div class="col-md-8">
							    	{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
							    </div>
							    <div class="col-md-8 col-md-offset-3">
							        <div class="help-block">{{ $errors->first('password') }}</div>
							    </div>
							</div>

							<div class="form-group {{ $errors->first('country') ? 'has-error' : '' }}">
								<label for="country" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('register.country')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.country_hint')}}">[?]</a></label>
							    <div class="col-md-8">
							        {{ Form::select('country', Config::get('countries'), Input::old('country'), array('class' => 'form-control')) }}
							    </div>
							    <div class="col-md-8 col-md-offset-3">
							        <div class="help-block">{{ $errors->first('country') }}</div>
							    </div>
							</div>

							<div class="form-group {{ $errors->first('city') ? 'has-error' : '' }}">
								<label for="city" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('register.city')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.city_hint')}}">[?]</a></label>
							    <div class="col-md-8">							    	
							    	{{ Form::text('city', Input::old('city'), array('class' => 'form-control')) }}
							    </div>
							    <div class="col-md-8 col-md-offset-3">
							        <div class="help-block">{{ $errors->first('city') }}</div>
							    </div>
							</div>

							<div class="form-group {{ $errors->first('address') ? 'has-error' : '' }}">
								{{ Form::label('address', trans('register.address'), array('class' => 'control-label col-md-2 col-md-offset-1')) }}
							    <div class="col-md-8">
								   {{ Form::textarea('address', Input::old('address'), array('class' => 'form-control')) }}
							    </div>
							    <div class="col-md-8 col-md-offset-3">
							        <div class="help-block">{{ $errors->first('address') }}</div>
							    </div>
							</div>
							
							@if( $type == strtolower(Config::get('ilosool.user_type.agent')) )
								<div class="form-group {{ $errors->first('rbc') ? 'has-error' : '' }}">
									<label for="rbc" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('register.rbc')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.rbc_hint')}}">[?]</a></label>
							    	<div class="col-md-8">
								   	{{ Form::text('rbc', Input::old('rbc'), array('class' => 'form-control')) }}
							    	</div>
							    	<div class="col-md-8 col-md-offset-3">
							        	<div class="help-block">{{ $errors->first('rbc') }}</div>
							    	</div>
								</div>

								<div class="form-group {{ $errors->first('rsc') ? 'has-error' : '' }}">
									<label for="rsc" class="control-label col-md-2 col-md-offset-1"><span class="required">*</span> {{trans('register.rsc')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.rsc_hint')}}">[?]</a></label>
								    <div class="col-md-8">
									   {{ Form::text('rsc', Input::old('rsc'), array('class' => 'form-control')) }}
								    </div>
								    <div class="col-md-8 col-md-offset-3">
								        <div class="help-block">{{ $errors->first('rsc') }}</div>
								    </div>
								</div>
							@endif

							<div class="form-group {{ $errors->first('phone') ? 'has-error' : '' }}">
								<label for="phone" class="control-label col-md-2 col-md-offset-1">{{trans('register.phone_number')}} <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.phone_number_hint')}}">[?]</a></label>
							    <div class="col-md-8">							    	
								   {{ Form::text('phone', Input::old('phone'), array('class' => 'form-control')) }}
							    </div>
							    <div class="col-md-8 col-md-offset-3">
							        <div class="help-block">{{ $errors->first('phone') }}</div>
							    </div>
							</div>

							<div class="complete-reg-container col-md-8 col-md-offset-3">
					        <p class="thank-msg">{{trans('register.info')}}</p>
					        
					        <div class="form-group">
					            <div class="checkbox">
					                {{ Form::checkbox('subscribed', '1', true, array('id' => 'subscribed')) }}
					                {{ Form::label('subscribed', trans('register.subscribe')) }}
					            </div>
					        </div>

					        <div class="form-group {{ $errors->first('agree') ? 'has-error' : '' }}">
					            <div class="checkbox terms-agree">
					                {{ Form::checkbox('agree', '1', null, array('id' => 'agree')) }}
					                <label for="agree" class="control-label">{{trans('register.agree_terms')}}</label>
					                <a id="popover-right" class="hint popover-right" data-container="body" data-toggle="popover" data-placement="right" data-content="{{trans('register.agree_terms_hint')}}">[?]</a>
					                <div class="help-block">{{ $errors->first('agree') }}</div>
					            </div>
					        </div>
					        <button type="submit" class="btn btn-lg btn-primary">{{trans('register.register')}}</button>
					    </div>
                    </div>
                {{ Form::token(); }}
            	{{ Form::close() }}
            </div>
        </div>
    </div>
@stop