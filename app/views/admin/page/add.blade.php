@extends('layouts.admin')

@section('title')
  Admin Page Add
@stop

@section('content')
	@parent
    <div class="container">
    	<ol class="breadcrumb">
        	<li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
        	<li><a href="{{ URL::route('admin.pages') }}">Pages</a></li>
        	<li class="active">Add New Page</li>
        </ol>
        {{ Form::open(array('route' => 'admin.page.add', 
                            'class' => 'form-horizontal',
                            'files' => true)) }}
            @include('admin.page.form')
        {{ Form::close() }}
    </div>
@stop