@extends('layouts.admin')

@section('title')
  Admin Post Edit
@stop

@section('content')
	@parent
    <div class="container">
    	<ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.posts') }}">Posts</a></li>
          <li><a href="{{ URL::route('admin.post.view', $post->id) }}">{{ $post->title }}</a></li>
           <li class="active">Edit</li>
        </ol>
	   {{ Form::model($post, array('route' => array('admin.post.edit', $post->id), 
                                    'class' => 'form-horizontal',
                                    'files' => true)) }}
            @include('admin.post.form')
        {{ Form::close() }}
    </div>
@stop