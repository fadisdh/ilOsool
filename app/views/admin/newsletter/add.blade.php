@extends('layouts.admin')

@section('title')
  Admin Newsletter Add
@stop

@section('content')
	@parent
    <div class="container">
    	<ol class="breadcrumb">
			<li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
			<li><a href="{{ URL::route('admin.newsletters') }}">Newsletters</a></li>
			<li class="active">Add New Newsletter</li>
        </ol>
        {{ Form::open(array('route' => 'admin.newsletter.add', 
                            'class' => 'form-horizontal',
                            'files' => true)) }}
            @include('admin.newsletter.form')
        {{ Form::close() }}
    </div>
@stop