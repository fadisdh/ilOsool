<div class="form-group {{ $errors->first('interests') ? 'has-error' : '' }}">
	{{ Form::label('interests[]', 'I am interested in:', array('class' => 'control-label col-md-2  col-md-offset-1')) }}
    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('interests[]','pe','',array('id' => 'pe')) }}
            {{ Form::label('pe', 'Private Equity') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('interests[]','vc','',array('id' => 'vc')) }}
            {{ Form::label('vc', 'Venture Capital') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('interests[]','re','',array('id' => 're')) }}
            {{ Form::label('re', 'Real Estate') }}
        </div>
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('interests') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('geo_interests') ? 'has-error' : '' }}">
   {{ Form::label('geo_interests[]', 'I am interested in investment in:', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('geo_interests[]','jo','',array('id' => 'jo')) }}
            {{ Form::label('jo', 'Jordan') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('geo_interests[]','ksa','',array('id' => 'ksa')) }}
            {{ Form::label('ksa', 'KSA') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('geo_interests[]','uae','',array('id' => 'uae')) }}
            {{ Form::label('uae', 'UAE') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('geo_interests[]','all','',array('id' => 'all')) }}
            {{ Form::label('all', 'All Countries') }}
        </div>
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('geo_interests') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('sector_interests') ? 'has-error' : '' }}">
   {{ Form::label('sector_interests[]', 'I am interested in investment in:', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('sector_interests[]','ict','',array('id' => 'ict')) }}
            {{ Form::label('ict', 'Information & Comm. Tecnology') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('sector_interests[]','health','',array('id' => 'health')) }}
            {{ Form::label('health', 'Health Sector') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('sector_interests[]','finance','',array('id' => 'finance')) }}
            {{ Form::label('finance', 'Finance Sector') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('sector_interests[]','hotels','',array('id' => 'hotels')) }}
            {{ Form::label('hotels', 'Hotels') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('sector_interests[]','housing','',array('id' => 'housing')) }}
            {{ Form::label('housing', 'Housing') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('sector_interests[]','construction','',array('id' => 'construction')) }}
            {{ Form::label('construction', 'Constructions') }}
        </div>
    </div>

    <div class="col-md-8 col-md-offset-3">
        <div class="checkbox">
            {{ Form::checkbox('sector_interests[]','allsec','',array('id' => 'allsec')) }}
        	{{ Form::label('allsec', 'All Sectors') }}
        </div>
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('sector_interests') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('investment_stage') ? 'has-error' : '' }}">
	{{ Form::label('investment_stage[]', 'Targeted Investment Stage:', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('investment_stage[]','management', null,array('id' => 'management')) }}
            {{ Form::label('management', 'Management') }}
        </div>
    </div>

    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('investment_stage[]','buyout', null,array('id' => 'buyout')) }}
            {{ Form::label('buyout', 'Buyout') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('investment_stage[]','distressed', null,array('id' => 'distressed')) }}
            {{ Form::label('distressed', 'Distressed') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('investment_stage[]','preipo', null,array('id' => 'preipo')) }}
            {{ Form::label('preipo', 'Pre IPO') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('investment_stage[]','allstages', null,array('id' => 'allstages')) }}
            {{ Form::label('allstages', 'All Stages') }}
        </div>
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('investment_stage') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('investment_type') ? 'has-error' : '' }}">
	{{ Form::label('investment_type[]', 'Targeted Investment Type:', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('investment_type[]','minority','',array('id' => 'minority')) }}
            {{ Form::label('minority', 'Minority') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
        	{{ Form::checkbox('investment_type[]','majority','',array('id' => 'majority')) }}
            {{ Form::label('majority', 'Majority') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('investment_type[]','passive','',array('id' => 'passive')) }}
            {{ Form::label('passive', 'Passive') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('investment_type[]','active','',array('id' => 'active')) }}
            {{ Form::label('active', 'Active') }}
        </div>
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('investment_type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('deal_size') ? 'has-error' : '' }}">
	{{ Form::label('deal_size[]', 'Targeted Deal Size:', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('deal_size[]','less1','',array('id' => 'less1')) }}
            {{ Form::label('less1', 'Less than 1 MUSD') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('deal_size[]','1to2','',array('id' => '1to2')) }}
            {{ Form::label('1to2', '1 to 2 MUSD') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="checkbox">
            {{ Form::checkbox('deal_size[]','2to5','',array('id' => '2to5')) }}
            {{ Form::label('2to5', '2 to 5 MUSD') }}
        </div>
    </div>
    <div class="col-md-3 col-md-offset-3">
        <div class="checkbox">
        	{{ Form::checkbox('deal_size[]','over5','',array('id' => 'over5')) }}
            {{ Form::label('over5', 'Over 5 MUSD') }}
        </div>
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('deal_size') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('investor_type') ? 'has-error' : '' }}">
    {{ Form::label('investor_type','Do you want to register as:', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-3">
        <div class="radio">
            {{ Form::radio('investor_type','Individual','',array('id'=>'individual')) }}
            {{ Form::label('individual','Individual') }}
        </div>
    </div>
    <div class="col-md-3">
        <div class="radio">
            {{ Form::radio('investor_type','Company','',array('id'=>'company')) }}
            {{ Form::label('company','Company') }}
        </div>
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('investor_type') }}</div>
    </div>
</div>

<div class="form-group {{ $errors->first('company_name') ? 'has-error' : '' }}">
    {{ Form::label('company_name', 'Company Legal Name', array('class' => 'control-label col-md-2 col-md-offset-1')) }}
    <div class="col-md-8">
        {{ Form::text('company_name', Input::old('company_name'), array('class' => 'form-control')) }}
    </div>
    <div class="col-md-8 col-md-offset-3">
        <div class="help-block">{{ $errors->first('company_name') }}</div>
    </div>
</div>

<div class="form-group stepper-btns">
    <div class="col-md-12">
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="2"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
        <a href="#" class="btn btn-lg btn-primary stepper-control" data-goto="4">Next <span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>
</div>