<div class="form-group {{ $errors->first('title') ? 'has-error' : '' }}">
   {{ Form::label('title', 'Title', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('title', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('title') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('description') ? 'has-error' : '' }}">
    {{ Form::label('description', 'Description', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::textarea('description', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('description') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('brief') ? 'has-error' : '' }}">
  {{ Form::label('brief', 'Brief', array('class' => 'control-label col-md-2')) }}
  <div class="col-md-10">
	   {{ Form::textarea('brief', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('brief') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('img') ? 'has-error' : '' }}">
    {{ Form::label('img', 'Image', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::file( 'img', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('img') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('video') ? 'has-error' : '' }}">
    {{ Form::label('video', 'Video', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text( 'video', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('video') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('type') ? 'has-error' : '' }}">
    {{ Form::label('type[]', 'Type:', array('class' => 'control-label col-md-2')) }}
        <div class="col-md-3">
            <div class="checkbox">
                {{ Form::checkbox('type[]','management', null, array('id' => 'management')) }}
                {{ Form::label('management', 'Management') }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox">
                {{ Form::checkbox('type[]','buyout', null, array('id' => 'buyout')) }}
                {{ Form::label('buyout', 'Buyout') }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox">
                {{ Form::checkbox('type[]','distressed', null, array('id' => 'distressed')) }}
                {{ Form::label('distressed', 'Distressed') }}
            </div>
        </div>
    <div class="col-md-3 col-md-offset-2">
            <div class="checkbox">
                {{ Form::checkbox('type[]','preipo', null, array('id' => 'preipo')) }}
                {{ Form::label('preipo', 'Pre IPO') }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox">
                {{ Form::checkbox('type[]','allstages', null, array('id' => 'allstages')) }}
                {{ Form::label('allstages', 'All Stages') }}
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-10 col-md-offset-2">
            <div class="help-block">{{ $errors->first('type') }}</div>
        </div>
</div>

<div class="form-group {{ $errors->first('birth') ? 'has-error' : '' }}">
    {{ Form::label('startdate', 'Start Date', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::date('startdate', isset($deal->startdate) ? $deal->startdate : Input::old('startdate'), array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('birth') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('duration') ? 'has-error' : '' }}">
    {{ Form::label('duration', 'Duration', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('duration', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('duration') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('target') ? 'has-error' : '' }}">
   {{ Form::label('target', 'Target', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-10">
        {{ Form::text('target', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('target') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('tags') ? 'has-error' : '' }}">
  {{ Form::label('tags', 'Tags', array('class' => 'control-label col-md-2')) }}
  <div class="col-md-10">
       {{ Form::textarea('tags', null, array('class' => 'form-control')) }}
    </div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('tags') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('geo_interest') ? 'has-error' : '' }}">
    {{ Form::label('geo_interest[]', 'Geo interests:', array('class' => 'control-label col-md-2')) }}
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('geo_interest[]','jo', null, array('id' => 'jo')) }}
            {{ Form::label('jo', 'Jordan') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('geo_interest[]','ksa', null, array('id' => 'ksa')) }}
            {{ Form::label('ksa', 'KSA') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('geo_interest[]','uae', null, array('id' => 'uae')) }}
            {{ Form::label('uae', 'UAE') }}
        </div>
    </div>
    <div class="col-md-3 col-md-offset-2">
        <div class="checkbox">
            {{ Form::checkbox('geo_interest[]','all', null, array('id' => 'all')) }}
            {{ Form::label('all', 'All Countries') }}
        </div>
    </div>
    <div class="col-md-9"></div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('geo_interest') }}</div>
    </div>
</div>


<div class="form-group {{ $errors->first('investment_type') ? 'has-error' : '' }}">
    {{ Form::label('investment_type[]', 'Investment Type:', array('class' => 'control-label control-label control-label col-md-2')) }}
        <div class="col-md-3">
            <div class="checkbox">
                {{ Form::checkbox('investment_type[]','minority',null,array('id' => 'minority')) }}
                {{ Form::label('minority', 'Minority') }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox">
                {{ Form::checkbox('investment_type[]','majority',null,array('id' => 'majority')) }}
                {{ Form::label('majority', 'Majority') }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="checkbox">
                {{ Form::checkbox('investment_type[]','passive',null,array('id' => 'passive')) }}
                {{ Form::label('passive', 'Passive') }}
            </div>
        </div>
        <div class="col-md-3 col-md-offset-2">
            <div class="checkbox">
                {{ Form::checkbox('investment_type[]','active',null,array('id' => 'active')) }}
                {{ Form::label('active', 'Active') }}
            </div>
        </div>
        <div class="col-md-9"></div>
        <div class="col-md-10 col-md-offset-2">
            <div class="help-block">{{ $errors->first('investment_type') }}</div>
        </div>
</div>

<div class="form-group {{ $errors->first('deal_size') ? 'has-error' : '' }}">
    {{ Form::label('deal_size[]', 'Deal Size:', array('class' => 'control-label control-label col-md-2')) }}
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('deal_size[]','less1',null,array('id' => 'less1')) }}
            {{ Form::label('less1', 'Less than 1 MUSD') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('deal_size[]','1to2',null,array('id' => '1to2')) }}
            {{ Form::label('1to2', '1 to 2 MUSD') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('deal_size[]','2to5','',array('id' => '2to5')) }}
            {{ Form::label('2to5', '2 to 5 MUSD') }}
        </div>
    </div>
    <div class="col-md-3 col-md-offset-2">
        <div class="checkbox">
            {{ Form::checkbox('deal_size[]','over5',null,array('id' => 'over5')) }}
            {{ Form::label('over5', 'Over 5 MUSD') }}
        </div>
    </div>
    <div class="col-md-9"></div>
    <div class="col-md-10 col-md-offset-2">
        <div class="help-block">{{ $errors->first('deal_size') }}</div>
    </div>
</div>

@if(can('deal.editstatus'))
    <div class="form-group {{ $errors->first('status') ? 'has-error' : '' }}">
        {{ Form::label('status', 'Status', array('class' => 'control-label col-md-2')) }}
        <div class="col-md-10">
            {{ Form::select('status', Config::get('ilosool.deal_status'), null ,array('class' => 'form-control')) }}
        </div>
    </div>
@endif

<div class="form-group">
    <div class="col-md-10 col-md-offset-2">
        {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    </div>
</div>

{{ Form::token(); }}