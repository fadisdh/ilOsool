@extends('layouts.admin')

@section('title')
  Admin Attachment Add
@stop

@section('content')
    @parent
    
    <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.companies') }}">Companies</a></li>
          <li><a href="{{ URL::route('admin.company.view', $company_id) }}">{{ $company_name }}</a></li>
          <li><a href="{{ URL::route('admin.company.attachments', $company_id) }}">attachments</a></li>
          <li class="active">Add New Attachment</li>
        </ol>
    {{ Form::open(array('route' => array('admin.company.attachment.add.post', $company_id),'files' => true, 'class' => 'form-horizontal')) }}
         @include('admin.company.attachment.form')
    {{ Form::close() }}
    </div>

@stop