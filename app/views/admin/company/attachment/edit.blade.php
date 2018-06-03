@extends('layouts.admin')

@section('title')
  Admin Attachment Edit
@stop

@section('content')
    @parent
    <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.companies') }}">Companies</a></li>
          <li><a href="{{ URL::route('admin.company.view', $attachment->company_id) }}">{{ $company_name }}</a></li>
          <li><a href="{{ URL::route('admin.company.attachments', $attachment->company_id) }}">Attachments</a></li>
          <li class="active">{{ $attachment->name }}</li>
          <li class="active">Edit</li>
        </ol>
        {{ Form::model($attachment, array('route' => array('admin.company.attachment.edit.post',$attachment->company_id, $attachment->id), 
                                    'class' => 'form-horizontal', 'files' => true)) }}
            @include('admin.company.attachment.form')
        {{ Form::close() }}
    </div>
@stop