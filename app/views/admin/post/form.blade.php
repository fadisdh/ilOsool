<div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
	{{ Form::label('title', 'Title', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
	   {{ Form::text('title', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-3 col-md-offset-2">
        <div class="help-block">{{ $errors->first('title') }}</div>
    </div>
</div>
<div class="form-group {{ $errors->first('content') ? 'has-error' : '' }}">
	{{ Form::label('content', 'Content', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
	   {{ Form::textarea('content', null, array('class' => 'form-control editor')) }}
    </div>
    <div class="col-md-3 col-md-offset-2">
        <div class="help-block">{{ $errors->first('content') }}</div>
    </div>
</div>
<div class="form-group">
    {{ Form::label('image', 'Image', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::file( 'image','',Input::old('image'), array('class' => 'form-control')) }}
    </div>
</div>
<div class="form-group {{ $errors->first('type') ? 'has-error' : '' }}">
	{{ Form::label('type', 'Type', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::select('type', Config::get('ilosool.post_types'), null, array('class' => 'form-control'))}}
    </div>
    <div class="col-md-3 col-md-offset-2">
        <div class="help-block">{{ $errors->first('type') }}</div>
    </div>
</div>
<div class="form-group">
	{{ Form::label('tags', 'Tags', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
	   {{ Form::textarea('tags', null, array('class' => 'form-control')) }}
    </div>
</div>

<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
        <a href="{{ URL::route('admin.posts') }}" class="btn btn-default">Cancel</a>
    </div>
</div>

{{ Form::token(); }}