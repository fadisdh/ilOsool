<div class="form-group {{ $errors->first('name') ? 'has-error' : '' }}">
    {{ Form::label('name', 'File Name', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
       {{ Form::text('name', null, array('class' => 'form-control')) }}
        <div class="help-block">{{ $errors->first('name') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('file') ? 'has-error' : '' }}">
    {{ Form::label('file', 'File', array('class' => 'control-label col-md-2')) }}
        <div class="col-md-4">
            {{ Form::file( 'file', '', null, array('class' => 'form-control')) }}
        </div>
        @if(isset($attachment->name))
            <div class="col-md-6 text-right"><a href="{{ asset($attachment->getFullPath()) }}" target="_blank" class="label label-default"><span class="glyphicon glyphicon-download"></span> {{ $attachment->name . '.' .$attachment->type }}</a></div>
        @endif
        <div class="help-block">{{ $errors->first('file') }}</div>
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
        <a href="{{ URL::route('admin.company.attachments', isset($attachment->company_id) ? $attachment->company_id : $company_id) }}" class="btn btn-default">Cancel</a>
    </div>
</div>
