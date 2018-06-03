@extends('layouts.master')

@section('title')
  Deal Add
@stop

@section('content')
	@parent
    <div class="container">
    {{ Form::open(array('route' => array('deal.add.post', $id), 
                        'class' => 'form-horizontal',
                        'files' => true)) }}
        @include('deal.form')
    {{ Form::close() }}
    </div>
@stop
