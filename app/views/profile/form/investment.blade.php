@extends('layouts.user')

@section('title')
  Profile Investment Edit
@stop

@section('user_content')
    @parent
    <div class="page-content">
        <h2 class="page-title">{{trans('profile.edit_investment_info.edit_investment_info')}}</h2>
        {{ Form::model($user, array('route' => array('profile.investment.edit.post'),
                            'files' => true,
                            'class' => 'form-horizontal profile-form')) }}
                            
            <div class="form-group {{ $errors->first('interests') ? 'has-error' : '' }}">
                {{ Form::label('interests', 'Interests:', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-3">
                    <div class="checkbox">
                        {{ Form::checkbox('interests[]','pe', null, array('id' => 'pe')) }}
                        {{ Form::label('pe', 'Private Equity') }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox">
                        {{ Form::checkbox('interests[]','vc', null, array('id' => 'vc')) }}
                        {{ Form::label('vc', 'Venture Capital') }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox">
                        {{ Form::checkbox('interests[]','re', null, array('id' => 're')) }}
                        {{ Form::label('re', 'Real Estate') }}
                    </div>
                </div>
                <div class="col-md-9"></div>
                <div class="col-md-10 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('interests') }}</div> 
                </div>
            </div>

            <div class="form-group {{ $errors->first('geo_interests') ? 'has-error' : '' }}">
                {{ Form::label('geo_interests[]', 'Geo interests:', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-3">
                    <div class="checkbox">
                        {{ Form::checkbox('geo_interests[]','jo', null, array('id' => 'jo')) }}
                        {{ Form::label('jo', 'Jordan') }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox">
                        {{ Form::checkbox('geo_interests[]','ksa', null, array('id' => 'ksa')) }}
                        {{ Form::label('ksa', 'KSA') }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="checkbox">
                        {{ Form::checkbox('geo_interests[]','uae', null, array('id' => 'uae')) }}
                        {{ Form::label('uae', 'UAE') }}
                    </div>
                </div>
                <div class="col-md-3 col-md-offset-2">
                    <div class="checkbox">
                        {{ Form::checkbox('geo_interests[]','all', null, array('id' => 'all')) }}
                        {{ Form::label('all', 'All Countries') }}
                    </div>
                </div>
                <div class="col-md-9"></div>
                <div class="col-md-10 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('geo_interests') }}</div>
                </div>
            </div>

            <div class="form-group {{ $errors->first('sector_interests') ? 'has-error' : '' }}">
                {{ Form::label('sector_interests[]', 'Sector interests:', array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('sector_interests[]','ict', null, array('id' => 'ict')) }}
                            {{ Form::label('ict', 'Information & Comm. Tecnology') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('sector_interests[]','health', null, array('id' => 'health')) }}
                            {{ Form::label('health', 'Health Sector') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('sector_interests[]','finance', null, array('id' => 'finance')) }}
                            {{ Form::label('finance', 'Finance Sector') }}
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-2">
                        <div class="checkbox">
                            {{ Form::checkbox('sector_interests[]','hotels', null, array('id' => 'hotels')) }}
                            {{ Form::label('hotels', 'Hotels') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('sector_interests[]','housing', null, array('id' => 'housing')) }}
                            {{ Form::label('housing', 'Housing') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('sector_interests[]','construction', null, array('id' => 'construction')) }}
                            {{ Form::label('construction', 'Constructions') }}
                        </div>
                    </div>
                    <div class="col-md-3 col-md-offset-2">
                        <div class="checkbox">
                            {{ Form::checkbox('sector_interests[]','allsec', null, array('id' => 'allsec')) }}
                            {{ Form::label('allsec', 'All Sectors') }}
                        </div>
                    </div>
                    <div class="col-md-9"></div>
                    <div class="col-md-3 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('sector_interests') }}</div>
                    </div>
            </div>

            <div class="form-group {{ $errors->first('investment_stage') ? 'has-error' : '' }}">
                {{ Form::label('investment_stage[]', 'Targeted Investment Stage:', array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('investment_stage[]','management', null, array('id' => 'management')) }}
                            {{ Form::label('management', 'Management') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('investment_stage[]','buyout', null, array('id' => 'buyout')) }}
                            {{ Form::label('buyout', 'Buyout') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('investment_stage[]','distressed', null, array('id' => 'distressed')) }}
                            {{ Form::label('distressed', 'Distressed') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('investment_stage[]','preipo', null, array('id' => 'preipo')) }}
                            {{ Form::label('preipo', 'Pre IPO') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('investment_stage[]','allstages', null, array('id' => 'allstages')) }}
                            {{ Form::label('allstages', 'All Stages') }}
                        </div>
                    </div>
                    <div class="col-md-9"></div>
                    <div class="col-md-3 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('investment_stage') }}</div>
                    </div>
            </div>

            <div class="form-group {{ $errors->first('investment_type') ? 'has-error' : '' }}">
                {{ Form::label('investment_type[]', 'Targeted Investment Type:', array('class' => 'control-label col-md-2')) }}
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('investment_type[]','minority', null, array('id' => 'minority')) }}
                            {{ Form::label('minority', 'Minority') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('investment_type[]','majority', null, array('id' => 'majority')) }}
                            {{ Form::label('majority', 'Majority') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('investment_type[]','passive', null, array('id' => 'passive')) }}
                            {{ Form::label('passive', 'Passive') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="checkbox">
                            {{ Form::checkbox('investment_type[]','active', null, array('id' => 'active')) }}
                            {{ Form::label('active', 'Active') }}
                        </div>
                    </div>
                    <div class="col-md-9"></div>
                    <div class="col-md-3 col-md-offset-2">
                        <div class="help-block">{{ $errors->first('investment_type') }}</div>
                    </div>
            </div>

        <div class="form-group {{ $errors->first('deal_size') ? 'has-error' : '' }}">
            {{ Form::label('deal_size[]', 'Targeted Deal Size:', array('class' => 'control-label col-md-2')) }}
            <div class="col-md-3">
                <div class="checkbox">
                    {{ Form::checkbox('deal_size[]','less1', null, array('id' => 'less1')) }}
                    {{ Form::label('less1', 'Less than 1 MUSD') }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox">
                    {{ Form::checkbox('deal_size[]','1to2', null, array('id' => '1to2')) }}
                    {{ Form::label('1to2', '1 to 2 MUSD') }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="checkbox">
                    {{ Form::checkbox('deal_size[]','2to5', null, array('id' => '2to5')) }}
                    {{ Form::label('2to5', '2 to 5 MUSD') }}
                </div>
            </div>
            <div class="col-md-3 col-md-offset-2">
                <div class="checkbox">
                    {{ Form::checkbox('deal_size[]','over5', null, array('id' => 'over5')) }}
                    {{ Form::label('over5', 'Over 5 MUSD') }}
                </div>
            </div>
            <div class="col-md-9"></div>
            <div class="col-md-10 col-md-offset-2">
                <div class="help-block">{{ $errors->first('deal_size') }}</div>
            </div>
        </div>

        <div class="form-group {{ $errors->first('investor_type') ? 'has-error' : '' }}">
            {{ Form::label('investor_type','Investor Type:', array('class' => 'control-label col-md-2')) }}
            <div class="col-md-3">
                <div class="radio">
                    {{ Form::radio('investor_type','individual', null, array('id'=>'individual')) }}
                    {{ Form::label('individual','Individual') }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="radio">
                    {{ Form::radio('investor_type','company', null, array('id'=>'company')) }}
                    {{ Form::label('company','Company') }}
                </div>
            </div>
            <div class="col-md-9"></div>
            <div class="col-md-10 col-md-offset-2">
                <div class="help-block">{{ $errors->first('investor_type') }}</div>
            </div>
        </div>

        <div class="form-group  {{ $errors->first('company_name') ? 'has-error' : '' }}">
            {{ Form::label('company_name', 'Company Name', array('class' => 'control-label col-md-2')) }}
            <div class="col-md-10">
                {{ Form::text('company_name', null, array('class' => 'form-control')) }}
            </div>
             <div class="col-md-10 col-md-offset-2">
                <div class="help-block">{{ $errors->first('company_name') }}</div>
            </div>
        </div>
    
            {{ Form::token(); }}
        
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                    <a href="{{ URL::route('profile.investment') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>

        {{ Form::close() }}
    </div>
@stop