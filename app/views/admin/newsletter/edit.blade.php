@extends('layouts.admin')

@section('title')
  Admin Newsletter Edit
@stop

@section('content')
	@parent
    <div class="container">
    	<ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.newsletters') }}">Newsletters</a></li>
          <li><a href="{{ URL::route('admin.newsletter.view', $newsletter->id) }}">{{ $newsletter->title }}</a></li>
           <li class="active">Edit</li>
        </ol>
	   {{ Form::model($newsletter, array('route' => array('admin.newsletter.edit', $newsletter->id), 
                                    'class' => 'form-horizontal',
                                    'files' => true)) }}
            @include('admin.newsletter.form')
        {{ Form::close() }}
    </div>
@stop