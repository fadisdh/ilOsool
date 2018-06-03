@extends('layouts.admin')

@section('title')
  Admin Rule Add
@stop

@section('content')
	@parent
    <div class="container">
    	<ol class="breadcrumb">
			<li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
			<li><a href="{{ URL::route('admin.rules') }}">Rules</a></li>
			<li class="active">Add New Rule</li>
        </ol>
        {{ Form::open(array('route' => 'admin.rule.add', 
                            'class' => 'form-horizontal')) }}
            @include('admin.rule.form')        	
    	{{ Form::close() }}
    </div>
@stop