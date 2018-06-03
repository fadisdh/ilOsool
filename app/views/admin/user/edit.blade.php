@extends('layouts.admin')

@section('title')
  Admin User Edit
@stop

@section('content')
    @parent
    <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.users') }}">Users</a></li>
          <li><a href="{{ URL::route('admin.user.view', $user->id) }}">{{ $user->firstname . ' ' . $user->lastname }}</a></li>
           <li class="active">Edit</li>
        </ol>
        {{ Form::model($user, array('route' => array('admin.user.edit', $user->id), 
                                    'class' => 'form-horizontal',
                                    'files' => true)) }}
            @include('admin.user.form')
        {{ Form::close() }}
    </div>
@stop
