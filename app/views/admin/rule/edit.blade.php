@extends('layouts.admin')

@section('title')
  Admin Rule Edit
@stop

@section('content')
	@parent
    <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.rules') }}">Rules</a></li>
          <li><a href="{{ URL::route('admin.rule.view', $rule->id) }}">{{ $rule->name }}</a></li>
           <li class="active">Edit</li>
        </ol>
        {{ Form::model($rule, array('route' => array('admin.rule.edit', $rule->id), 
                                    'class' => 'form-horizontal')) }}
            @include('admin.rule.form')
        {{ Form::close() }}
    </div>
@stop