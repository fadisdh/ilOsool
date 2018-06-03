@extends('layouts.admin')

@section('title')
  Admin Page Edit
@stop

@section('content')
	@parent
    <div class="container">
    	<ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.pages') }}">Pages</a></li>
          <li><a href="{{ URL::route('admin.page.view', $page->id) }}">{{ $page->title }}</a></li>
           <li class="active">Edit</li>
        </ol>
        {{ Form::model($page, array('route' => array('admin.page.edit', $page->id), 
                                    'class' => 'form-horizontal',
                                    'files' => true)) }}
            @include('admin.page.form')
        {{ Form::close() }}
    </div>
@stop