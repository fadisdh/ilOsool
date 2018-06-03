@extends('layouts.admin')

@section('title')
  Admin User Add
@stop

@section('content')
    @parent
    <div class="container">
    	<ol class="breadcrumb">
        <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
        <li><a href="{{ URL::route('admin.users') }}">Users</a></li>
        <li class="active">Add New User</li>
      </ol>
      {{ Form::open(array('route' => 'admin.user.add', 
                    	 	  'class' => 'form-horizontal',
                          'files' => true)) }}
          {{ Form::hidden('agree', '1') }}
          @include('admin.user.form')
      {{ Form::close() }}
    </div>
@stop
