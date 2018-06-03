@extends('layouts.admin')

@section('title')
  Admin Investemnt Edit
@stop

@section('content')
    @parent
    <div class="container">
        <ol class="breadcrumb">
          <li><a href="{{ URL::route('admin') }}">Admin Panel</a></li>
          <li><a href="{{ URL::route('admin.companies') }}">Companies</a></li>
          <li><a href="{{ URL::route('admin.company.view', $investment->company_id) }}">{{ $company->name }}</a></li>
          <li><a href="{{ URL::route('admin.company.investments', $investment->company_id) }}">Investments</a></li>
          <li><a href="{{ URL::route('admin.company.investment.view', array($investment->company_id, $investment->id)) }}">{{ $investment->id }}</a></li>
           <li class="active">Edit</li>
        </ol>
        {{ Form::model($investment, array('route' => array('admin.company.investment.edit',$investment->company_id, $investment->id), 
                                    'class' => 'form-horizontal', 'files' => true)) }}
            @include('admin.company.investment.form')
        {{ Form::close() }}
    </div>
@stop