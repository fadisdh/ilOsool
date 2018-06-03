@extends('layouts.admin')

@section('title')
  Admin Staff Edit
@stop

@section('content')
    @parent
    <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.companies') }}">Companies</a></li>
          <li><a href="{{ URL::route('admin.company.view', $staff->company_id) }}">{{ $company_name }}</a></li>
          <li><a href="{{ URL::route('admin.company.staff', $staff->company_id) }}">staff</a></li>
          <li><a href="{{ URL::route('admin.company.staff.view', array($staff->company_id, $staff->id)) }}">{{ $staff->name }}</a></li>
           <li class="active">Edit</li>
        </ol>
        {{ Form::model($staff, array('route' => array('admin.company.staff.edit',$staff->company_id, $staff->id), 
                                    'class' => 'form-horizontal', 'files' => true)) }}
            @include('admin.company.staff.form')
        {{ Form::close() }}
    </div>
@stop