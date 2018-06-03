@extends('layouts.admin')

@section('title')
  Admin Post Add
@stop

@section('content')
	@parent
    <div class="container">
    	<ol class="breadcrumb">
			<li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
			<li><a href="{{ URL::route('admin.posts') }}">Posts</a></li>
			<li class="active">Add New Post</li>
        </ol>
        {{ Form::open(array('route' => 'admin.post.add', 
                            'class' => 'form-horizontal',
                            'files' => true)) }}
            @include('admin.post.form')
        {{ Form::close() }}
    </div>
@stop