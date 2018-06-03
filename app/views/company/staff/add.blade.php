@extends('layouts.site')

@section('title')
  Listing Staff
@stop

@section('content')
    <div class="profile">
        <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
        <div class="container-fluid">
            <div class="profile-container">

                @include('profile.topmenu')
                <div class="container company-edit-form">
                    <h2 class="page-title">{{trans('deal.add_new_staff')}}</h2>
				    {{ Form::open(array('route' => array('staff.add.post',$company_id),
										'class' => 'form-horizontal',
										'files' => true,
										'data-res' => '#requestfiles-res')) }}
					
						<div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
						    {{ Form::label('name', trans('deal.name'), array('class' => 'control-label col-md-2')) }}
						    <div class="col-md-10">
						       {{ Form::text('name', null, array('class' => 'form-control')) }}
						        <div class="help-block">{{ $errors->first('name') }}</div>
						    </div>
						</div>

						<div class="form-group">
						    {{ Form::label('image', trans('deal.image'), array('class' => 'control-label col-md-2')) }}
					        <div class="col-md-10">
					            @if(isset($staff))
					                @if($staff->image)
					                    <img src="{{ asset($staff->getImage()) }}" />
					                @else
					                    <img src="{{ asset(Config::get('ilosool.default_user_image')) }}" />
					                @endif
					            @endif
					            {{ Form::file( 'image', '',null, array('class' => 'form-control')) }}
					        </div>
						</div>

						<div class="form-group {{ $errors->first('position') ? 'has-error' : '' }}">
							{{ Form::label('position', trans('deal.position'), array('class' => 'control-label col-md-2')) }}
						    <div class="col-md-10">
							   {{ Form::text('position', null, array('class' => 'form-control')) }}
						        <div class="help-block">{{ $errors->first('position') }}</div>
						    </div>
						</div>

						<div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
						    {{ Form::label('description', trans('deal.description'), array('class' => 'control-label col-md-2')) }}
						    <div class="col-md-10">
						       {{ Form::textarea('description', null, array('class' => 'form-control editor')) }}
						        <div class="help-block">{{ $errors->first('description') }}</div>
						    </div>
						</div>

						<div class="form-group {{ $errors->first('type') ? 'has-error' : '' }}">
						    {{ Form::label('type', trans('deal.type'), array('class' => 'control-label col-md-2')) }}
						    <div class="col-md-10">
						       {{ Form::text('type', null, array('class' => 'form-control')) }}
						        <div class="help-block">{{ $errors->first('type') }}</div>
						    </div>
						</div>

						<div class="form-group {{ $errors->first('access') ? 'has-error' : '' }}">
						    {{ Form::label('access', trans('deal.access'), array('class' => 'control-label col-md-2')) }}
						    <div class="col-md-10">
						        {{ Form::select('access', Config::get('ilosool.attachments_permissions'), null, array( 'class' => 'form-control' )) }}
						    </div>
						    <div class="help-block">{{ $errors->first('access') }}</div>
						</div>

						<div class="form-group">
						    <div class="col-md-10 col-md-offset-2">
						        {{ Form::submit(trans('general.save'), array('class' => 'btn btn-primary', 'name' => 'save')) }}
						        {{ Form::submit(trans('deal.save_add_staff'), array('class' => 'btn btn-primary', 'name' => 'add_staff')) }}
						        <a href="{{ URL::route('staff', $company_id ) }}" class="btn btn-default">{{trans('general.cancel')}}</a>
						        {{ Form::submit(trans('deal.save_add_attachment'), array('class' => 'btn btn-primary pull-right', 'name' => 'add_attachment')) }}
						    </div>
						</div>
					
					{{ Form::token(); }}
				    {{ Form::close() }}

                </div>
            </div>
        </div>  
    </div>
@stop

