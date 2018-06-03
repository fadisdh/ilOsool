@extends('layouts.admin')

@section('title')
  Admin Newsletter Use
@stop

@section('scripts')
    @parent
    {{ HTML::style('js/autocomplete/token-input.css') }}
    {{ HTML::style('js/autocomplete/autocomplete.css') }}
    {{ HTML::script('js/autocomplete/jquery.tokeninput.js') }}

    <script type="text/javascript">
        $(document).ready(function() {
            var $autocomplete = $("#autocomplete");
            $autocomplete.tokenInput("{{ URL::route('admin.users.autocomplete', array('type' => 'email')) }}", {
                theme: "facebook", minChars: 2, resultsLimit: 10});

            $('.token-input-dropdown-facebook').width($autocomplete.width() - 10 );
        });
    </script>
@stop

@section('content')
	@parent
    <div class="container">
    	<ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.newsletters') }}">Newsletters</a></li>
          <li><a href="{{ URL::route('admin.newsletter.view', $newsletter->id) }}">{{ $newsletter->title }}</a></li>
           <li class="active">Use</li>
        </ol>
	   {{ Form::model($newsletter, array('route' => array('admin.newsletter.submit', $newsletter->id), 
                                    'class' => 'form-horizontal',
                                    'files' => true)) }}
            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-1">
                    <div class="radio">
                        {{ Form::radio('option','user', null, array('id'=>'user')) }}
                        {{ Form::label('user','User') }}

                    </div>
                </div>
                <div class="col-md-9">
                    {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'autocomplete')) }}
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-1">
                    <div class="radio">
                        {{ Form::radio('option','rule', null, array('id'=>'rule')) }}
                        {{ Form::label('rule','Rule') }}
                    </div>
                </div>
                <div class="col-md-9">
                    {{ Form::select('rule_id', $rules, null, array( 'class' => 'form-control' )) }}
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <div class="radio">
                        {{ Form::radio('option','subscribed', null, array('id'=>'subscribed')) }}
                        {{ Form::label('subscribed','Subscribed') }}
                    </div>
                </div>
                <div class="col-md-2">
                     <div class="checkbox">
                    {{ Form::checkbox('subscribed_rule[]','3', null, array('id' => 'investor')) }}
                    {{ Form::label('investor', 'Investor') }}
                    </div>
                </div>
                <div class="col-md-2">
                     <div class="checkbox">
                    {{ Form::checkbox('subscribed_rule[]','4', null, array('id' => 'lister')) }}
                    {{ Form::label('lister', 'Lister') }}
                    </div>
                </div>
                <div class="col-md-2">
                     <div class="checkbox">
                    {{ Form::checkbox('subscribed_rule[]','5', null, array('id' => 'both')) }}
                    {{ Form::label('both', 'Both') }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2"></div>
                <div class="col-md-3">
                    <div class="radio">
                        {{ Form::radio('option','all', null, array('id'=>'all')) }}
                        {{ Form::label('all','All') }}
                    </div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('subject') ? 'has-error' : '' }}">
              {{ Form::label('subject', 'Subject', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-10">
                 {{ Form::text('subject', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-3 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('subject') }}</div>
                </div>
            </div>
            <div class="form-group {{ $errors->first('content') ? 'has-error' : '' }}">
              {{ Form::label('content', 'Content', array('class' => 'control-label col-md-2')) }}
                <div class="col-md-10">
                 {{ Form::textarea('content', null, array('class' => 'form-control editor', 'rows' =>"30")) }}
                </div>
                <div class="col-md-3 col-md-offset-2">
                    <div class="help-block">{{ $errors->first('content') }}</div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    {{ Form::submit('Send', array('class' => 'btn btn-primary')) }}
                    <a href="{{ URL::route('admin.newsletters') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>
            {{ Form::token(); }}
        {{ Form::close() }}
    </div>
@stop