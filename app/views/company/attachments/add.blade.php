@extends('layouts.site')

@section('title')
  Listing Attachments
@stop

@section('content')
    <div class="profile">
        <div class="page-img"><img src="{{ asset('images/earlyaccess.jpg') }}" /></div>
        <div class="container-fluid">
            <div class="profile-container">

                @include('profile.topmenu')
                <div class="container company-edit-form">
                    <h2 class="page-title">{{trans('deal.add_new_attachment')}}</h2>

				    {{ Form::open(array('route' => array('attachment.add.post', $company_id),
										'class' => 'form-horizontal',
										'files' => true,
										'data-res' => '#requestfiles-res')) }}
					
						<div class="form-group">
							{{ Form::label('name', trans('deal.name'), array('class' => 'control-label col-md-3')) }}
							<div class="col-md-9 {{ $errors->first('name') ? 'has-error' : ''}}">
								{{ Form::text('name', null, array('class' => 'form-control')) }}
								<div class="help-block">{{ $errors->first('name') }}
								</div>
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('access', trans('deal.access'), array('class' => 'control-label col-md-3')) }}
							<div class="col-md-9 {{ $errors->first('access') ? 'has-error' : '' }}">
								{{ Form::select('access', Config::get('ilosool.attachments_permissions'), null, array('class' => 'form-control')) }}
								<div class="help-block">{{ $errors->first('access') }}</div>
							</div>
						</div>
						<div class="form-group">
							{{ Form::label('file', trans('deal.upload'), array('class' => 'control-label col-md-3')) }}
							<div class="col-md-9 {{ $errors->first('file') ? 'has-error' : ''}}">
								{{ Form::file('file', '', null, array('class' => 'form-control')) }}

								<div class="help-block">{{ $errors->first('file') }}</div>
							</div>
						</div>
						
						<div class="form-group">
			                <div class="col-md-9 col-md-offset-3">
			                   {{ Form::submit( trans('general.save'), array('class' => 'btn btn-primary', 'name' => 'save')) }}
						        {{ Form::submit(trans('deal.save_add_attachment'), array('class' => 'btn btn-primary', 'name' => 'add_attachment')) }}
			                   <a href="{{ URL::route('attachments', $company_id ) }}" class="btn btn-default">{{trans('general.cancel')}}</a>
			                   {{ Form::submit(trans('deal.save_add_staff'), array('class' => 'btn btn-primary pull-right', 'name' => 'add_staff')) }}
			                </div>
			            </div>
					{{ Form::token(); }}
				    {{ Form::close() }}
                </div>
            </div>
        </div>  
    </div>
@stop

