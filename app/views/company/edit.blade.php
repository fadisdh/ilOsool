@extends('layouts.site')

@section('title')
  Company Edit
@stop

@section('content')
    @parent
    <div class="page-img">{{ HTML::image('images/earlyaccess.jpg') }}</div>
    <div class="container">
        {{ Form::model($company, array('route' => array('company.edit.post', $company->id),
                            'files' => true,
                            'class' => 'form-horizontal')) }}
            @include('company.form.info')
            @include('company.form.detailes')

            {{ Form::token() }}
        
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
                    <a href="{{ URL::route('companies') }}" class="btn btn-default">Cancel</a>
                </div>
            </div>

        {{ Form::close() }}
    </div>
@stop