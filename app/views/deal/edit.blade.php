@extends('layouts.master')

@section('title')
  Deal Edit
@stop

@section('content')
	@parent
    <div class="container">
    {{ Form::model($deal, array('route' => array('deal.edit.post', $company->id, $deal->id), 
                                'class' => 'form-horizontal',
                                'files' => true)) }}
        @include('deal.form')
    {{ Form::close() }}
    </div>
@stop
