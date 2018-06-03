@extends('layouts.admin')

@section('title')
  Admin investment Add
@stop

@section('content')
    @parent
    
    <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.companies') }}">Companies</a></li>
          <li><a href="{{ URL::route('admin.company.view', $company->id) }}">{{ $company->name }}</a></li>
          <li><a href="{{ URL::route('admin.company.investments', $company->id) }}">Investments</a></li>
          <li class="active">Add New Investment</li>
        </ol>
    {{ Form::open(array('route' => array('admin.company.investment.add.post', $company->id), 'class' => 'form-horizontal')) }}
         @include('admin.company.investment.form')
    {{ Form::close() }}
    </div>

@stop