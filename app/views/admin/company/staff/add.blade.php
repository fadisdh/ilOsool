@extends('layouts.admin')

@section('title')
  Admin Staff Add
@stop

@section('content')
    @parent
    
    <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.companies') }}">Companies</a></li>
          <li><a href="{{ URL::route('admin.company.view', $company->id) }}">{{ $company->name }}</a></li>
          <li><a href="{{ URL::route('admin.company.staff', $company->id) }}">Staff</a></li>
          <li class="active">Add New Staff Memeber</li>
        </ol>
    {{ Form::open(array('route' => array('admin.company.staff.add.post', $company->id),'files' => true, 'class' => 'form-horizontal')) }}
         @include('admin.company.staff.form')
    {{ Form::close() }}
    </div>

@stop