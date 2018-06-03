<div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
    {{ Form::label('name', 'Staff Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::text('name', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('name') }}</div>
    </div>
</div>

<div class="form-group">
    {{ Form::label('image', 'Image', array('class' => 'control-label col-md-2')) }}
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
	{{ Form::label('position', 'Position', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
	   {{ Form::text('position', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('position') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
    {{ Form::label('description', 'Description', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::textarea('description', null, array('class' => 'form-control editor')) }}
        <div class="help-block">{{ $errors->first('description') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('type') ? 'has-error' : '' }}">
    {{ Form::label('type', 'Type', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::text('type', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('access') ? 'has-error' : '' }}">
    {{ Form::label('access', 'Access', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::select('access', Config::get('ilosool.attachments_permissions'), null, array( 'class' => 'form-control' )) }}
    </div>
    <div class="help-block">{{ $errors->first('access') }}</div>
</div>

{{ Form::token(); }}

<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::route('admin.company.staff', isset($staff->company_id) ? $staff->company_id : $company->id) }}" class="btn btn-default">Cancel</a>
    </div>
</div>